<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once('AdminUsersHelper.php');
require_once('URLHelper.php');
use PHPMailer\PHPMailer\PHPMailer;
require_once "vendor/vendor/autoload.php";
require_once "vendor/vendor/phpmailer/phpmailer/src/PHPMailer.php";
require_once('../libs/PHPExcel.php');

class BooksHelper extends BaseHelper
{

    public function __construct()
    {
        parent::__construct();
        $this->urlHelper       = new URLHelper();
    }

    public function AddBook()
    {

        global $xpdo;

        date_default_timezone_set('Africa/Cairo'); 
        $createdOn      = date("Y-m-d H:i:s");

        $item = $xpdo->newObject('Books');
      
        $fields['Title_en']       = $_POST['title_en'];
        $fields['Title_ar']       = $_POST['title_ar'];
        $fields['Sort']           = $_POST['sort'];
        $fields['UpdatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['CreatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['CreatedOn']      = $createdOn;

        if(isset($_FILES['picture']) && $_FILES['picture']['size'] > 0){
             $response = $this->UploadFile($_FILES['picture'],'/../uploads/booksImages/', $x = 500);
             $response = json_decode($response);

             if($response->res == 0)
             {
              return UtilityHelper::Response('error',$response->message);
             }
             else
               $fields['Image'] = $response->message;
        }

        $item->fromArray($fields);
       
        return $item->save();
    }

    public function GetAllBooks()
    {
        global $xpdo;

          $query = $xpdo->newQuery('Books');
          $query->sortby('CreatedOn', 'DESC');

          $categoriesCount = $xpdo->getCount('Books', $query);
          $limit = 20;
          $totalpages  = ceil($categoriesCount / $limit);

          if (isset($_POST['currentpage']) && is_numeric($_POST['currentpage'])) {
            $currentpage = (int) $_POST['currentpage'];
          } else {
                  $currentpage = 1;
          }

          if ($currentpage > $totalpages) {
                  $currentpage = $totalpages;
          }

              if ($currentpage < 1) {
                  $currentpage = 1;
          }

          $offset = ($currentpage - 1) * $limit;

          $query->limit($limit, $offset);

          $allObj = $xpdo->getCollection('Books' ,$query);

          $output = '';

          if (empty($allObj)) {
              $output .= new LoadChunk('no-data','admin/master', array(), '../');
          }

          foreach($allObj as $currObj)
          {
              $output .= new LoadChunk('book', 'admin/books', array(
                                                'totalPages'     =>  $totalpages,
                                                'name_en'        =>  $currObj->Get('Title_ar'),
                                                'image'          =>  $currObj->Get('Image'),
                                                'currID'         =>  $currObj->Get('ID')
                                            ),'../');
          }
          return $output;
    }

    public function GetBook()
    {
        global $xpdo;
        if (isset($_POST['itemID'])) 
        {
            $itemID = $_POST['itemID'];
        }
        $item = $xpdo->getObject('Books', array('ID' => $itemID));
        $itemObj = json_encode($item->toArray());
        return $itemObj;
    }

    public function EditBook()
    {
        global $xpdo;
        date_default_timezone_set('Africa/Cairo'); 
        $updatedOn      = date("Y-m-d H:i:s");

        if (isset($_POST['itemID'])) 
        {
            $itemID = $_POST['itemID'];
        }
        $item = $xpdo->getObject('Books', array('ID' => $itemID));
        
        $fields['Title_en']       = $_POST['edit_title_en'];
        $fields['Title_ar']       = $_POST['edit_title_ar'];
        $fields['Sort']           = $_POST['edit_sort'];
        $fields['UpdatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['UpdatedOn']      = $updatedOn;

        if(isset($_FILES['edit_picture']) && $_FILES['edit_picture']['size'] > 0){
             $response = $this->UploadFile($_FILES['edit_picture'],'/../uploads/booksImages/', $x = 500);
             $response = json_decode($response);

             if($response->res == 0)
             {
              return UtilityHelper::Response('error',$response->message);
             }
             else{
                if (!empty($item->get('Image')) && $item->get('Image') != '/uploads/booksImages/default-image.png') {
                      unlink('../'.$item->get('Image'));
                    }
               $fields['Image'] = $response->message;
             }
        }

        $item->fromArray($fields);
        return $item->save();

    }

    public function DeleteBook()
    {
        global $xpdo;
        if (isset($_POST['itemID'])) 
        {
            $itemID = $_POST['itemID'];
        }
        $item = $xpdo->getObject('Books', array('ID' => $itemID));
        if (!empty($item->get('Image')) && $item->get('Image') != '/uploads/booksImages/default-image.png') {
          unlink('../'.$item->get('Image'));
        }
        return $item->remove();
    }

    public function Upload()
    {
        global $xpdo;
        $objReader   = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load($_FILES['booksFile']['tmp_name']);
        
        $objPHPExcel->setActiveSheetIndex(0);
        
        $rows = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
        
        $rows = array_filter($rows, function ($array) {
            return !strlen(implode($array)) == 0;
        });
        // Remove Header Row
        unset($rows[1]);

        // print_r($rows[1]);
        foreach ($rows as $index => $row) {
          date_default_timezone_set('Africa/Cairo'); 
          $createdOn          = date("Y-m-d H:i:s");

          $fields['Title_ar']    = addslashes($row['B']);
          $fields['Title_en']    = addslashes($row['B']);
          $fields['Image']       = '/uploads/booksImages/default-image.png';
          $fields['Sort']        = 0;
          $fields['CreatedOn']   = $createdOn;
          $fields['UpdatedBy']   = $_SESSION['AdminUser']['Name'];
          $fields['CreatedBy']   = $_SESSION['AdminUser']['Name'];
          $obj = $xpdo->newObject('Books');
          $obj->fromArray($fields);
          $obj->save();
          // exit();
        }
    }
    // Front Functions

    public function GetAllBooksFront()
    {
      global $xpdo;
      $onclickFn  = 'fnGetBooks';
      $booksChunk = '';
      $lang       = (isset($_POST['lang'])) ? $_POST['lang'] : 'ar';
      $langFile   = json_decode(file_get_contents('../lang/books.json'), true);

      $books = $xpdo->getCollection('Books');
      $numrows      = count($books);

      $pagination='';
      $rowsperpage = 20;
      $totalpages  = ceil($numrows / $rowsperpage);

      if (isset($_POST['currentpage']) && is_numeric($_POST['currentpage'])) {
        $currentpage = (int) $_POST['currentpage'];
      } else {
        $currentpage = 1;
      }

      if ($currentpage > $totalpages) {
        $currentpage = $totalpages;
      }

      if ($currentpage < 1) {
        $currentpage = 1;
      }

      $offset = ($currentpage - 1) * $rowsperpage;

      $query = $xpdo->newQuery('Books');
      $query->limit($rowsperpage,$offset);
      $allBooks = $xpdo->getCollection('Books', $query);
      if ($allBooks) {
        foreach($allBooks as $book)
        { 
          $booksChunk .=  new LoadChunk('book','front/books',array(
                                                                    'title'  =>  $book->get('Title_'.$lang),
                                                                    'image'  =>  $book->get('Image'),
                                                                    'ID'     =>  $book->get('ID')
                                                            ),'../');

        }
      }

      // Build up the Pagination
      if ($totalpages > 1) {
          $pagination .= '<div class="pagination">';

          if ($currentpage > 1) {
              $pagination .= '<a href="javascript:void(0)" onclick="'.$onclickFn.'(' . ($currentpage - 1) .')"> '. $langFile['previous'][$lang]. '</a>';
          }

          for ($i = 1; $i <= $totalpages; $i++) {
              if ($i <= $currentpage + 3 && $i >= $currentpage - 2) {
                  if ($i == $currentpage) {
                      $pagination.= '<a href="javascript:void(0)" class="active">' . $i . '</a>';
                  } else {
                      $pagination.= '<a href="javascript:void(0)" onclick="'.$onclickFn.'(' . $i .')">' . $i . '</a>';
                  }
              }
          }
          if ($currentpage != $totalpages) {
              $pagination .= '<a href="javascript:void(0)" onclick="'.$onclickFn.'(' . ($currentpage + 1) .')">'. $langFile['next'][$lang]. '</a>';

              // $pagination .= '<li class="waves-effect waves-dark"><a onclick="'.$onclickFn.'(' . $totalpages . ','.$parentID.')">...</a></li>';
          }

          $pagination .= '</div>';
      }

      return json_encode(array('output' => $this->urlHelper->changeToAlias($booksChunk), 'pagination' => $this->urlHelper->changeToAlias($pagination) ));

    }

    public function SendBooksMail()
    {
      //Send an email to the customer service email listing
    
      $name      = $_POST['first_name']." ".$_POST['family_name'];
      $email     = $_POST['email'];
      $phone     = $_POST['phone'];
      // $subject   = trim($_POST['subject']);
      $message   = trim($_POST['message']);

      $emailBody = new LoadChunk('mailBody', 'front/master', array(
                                'name'      => $name,
                                'email' => $email,
                                'phone' => $phone,
                                // 'subject'     => $subject,
                                'message'     => $message,
                              ), '../');
            $mail = new PHPMailer;
            $mail->SMTPDebug = true;                           
            $mail->isSMTP();        
            $mail->Host = "smtp-mail.outlook.com";
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'nccpimwebsite@outlook.com';                 // SMTP username
            $mail->Password = 'NoRep@2018';                           // SMTP password
            $mail->SMTPSecure = 'tls';                    
            $mail->Port = 587;                    
            $mail->From = "nccpimwebsite@outlook.com";
            $mail->FromName = "NCCPIM Books";
            $mail->addAddress("fahmy.maged@kijamii.com", "noreply");
            $mail->isHTML(true);
            $mail->Subject = "NCCPIM Website | Books";
            $mail->Body = "Hello, <br> ". $emailBody;
      if(!$mail->send())
      {
      // echo "Mailer Error: " . $mail->ErrorInfo;
      return json_encode(array('res' => 0, 'message' => "Mailer Error: " . $mail->ErrorInfo));
      }
      else
      {
      return json_encode(array('res' => 1, 'message' => 'Message has been submitted successfully.'));
      }
    }
}
