<?php
if (!isset($_SESSION)) session_start();
require_once('AdminUsersHelper.php');
require_once('URLHelper.php');
use PHPMailer\PHPMailer\PHPMailer;
require_once "vendor/vendor/autoload.php";
require_once "vendor/vendor/phpmailer/phpmailer/src/PHPMailer.php";

class QuestionsHelper extends BaseHelper
{

  public function __construct()
    {
        parent::__construct();
        $this->urlHelper       = new URLHelper();
    }

    public function AddItem()
    {

        global $xpdo;

        date_default_timezone_set('Africa/Cairo'); 
        $createdOn      = date("Y-m-d H:i:s");

        $item = $xpdo->newObject('Questions');


        $fields['Title_en']       = $_POST['title_en'];
        $fields['Title_ar']       = $_POST['title_ar'];
        $fields['Description_en'] = $_POST['description_en'];
        $fields['Description_ar'] = $_POST['description_ar'];
        $fields['Sort']           = $_POST['sort'];
        $fields['UpdatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['CreatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['CreatedOn']      = $createdOn;

        $item->fromArray($fields);
        $item->save();
    }

    public function GetItems()
    {
        global $xpdo;

          $query = $xpdo->newQuery('Questions');
          $query->sortby('CreatedOn', 'DESC');

          $categoriesCount = $xpdo->getCount('Questions', $query);
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

          $allObj = $xpdo->getCollection('Questions' ,$query);

          $output = '';

          if (empty($allObj)) {
              $output .= new LoadChunk('no-data','admin/master', array(), '../');
          }

          foreach($allObj as $currObj)
          {
              $output .= new LoadChunk('sliderItem', 'admin/slider', array(
                                                'totalPages'     =>  $totalpages,
                                                'name_en'        =>  $currObj->Get('Title_ar'),
                                                'description_en' =>  $currObj->Get('Description_ar'),
                                                'currID'         =>  $currObj->Get('ID')
                                            ),'../');
          }
          return $output;
    }

    public function GetItem()
    {
        global $xpdo;
        if (isset($_POST['itemID'])) 
        {
            $itemID = $_POST['itemID'];
        }
        $item = $xpdo->getObject('Questions', array('ID' => $itemID));
        $itemObj = json_encode($item->toArray());
        return $itemObj;
    }

    public function EditItem()
    {
        global $xpdo;
        date_default_timezone_set('Africa/Cairo'); 
        $updatedOn      = date("Y-m-d H:i:s");

        if (isset($_POST['itemID'])) 
        {
            $itemID = $_POST['itemID'];
        }
        $item = $xpdo->getObject('Questions', array('ID' => $itemID));
        
        $fields['Title_en']       = $_POST['edit_title_en'];
        $fields['Description_en'] = $_POST['edit_description_en'];
        $fields['Title_ar']       = $_POST['edit_title_ar'];
        $fields['Description_ar'] = $_POST['edit_description_ar'];
        $fields['Sort']           = $_POST['edit_sort'];
        $fields['UpdatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['UpdatedOn']      = $updatedOn;

        $item->fromArray($fields);
        return $item->save();

    }

    public function DeleteItem()
    {
        global $xpdo;
        if (isset($_POST['itemID'])) 
        {
            $itemID = $_POST['itemID'];
        }
        $item = $xpdo->getObject('Questions', array('ID' => $itemID));
        
        return $item->remove();
    }


    // Send Mail
    public function SendQuestionMail()
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
      $mail->SMTPDebug = 4;                           
      $mail->isSMTP();        
      $mail->Host = "smtp.gmail.com";
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = 'sandra.seif@kijamii.com';                 // SMTP username
      $mail->Password = 'sandra771990';                           // SMTP password
      $mail->SMTPSecure = 'tls';                    
      $mail->Port = 587;                    
      $mail->From = "fahmy.maged@kijamii.com";
      $mail->FromName = "NCCPIM Questions Form";
      $mail->addAddress("fahmy.maged@kijamii.com", "fahmy maged");
      $mail->isHTML(true);
      $mail->Subject = "";
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