<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once('AdminUsersHelper.php');
require_once('LoadChunk.php');
use PHPMailer\PHPMailer\PHPMailer;
require_once "vendor/vendor/autoload.php";
require_once "vendor/vendor/phpmailer/phpmailer/src/PHPMailer.php";

//PHPMailer Object
$mail = new PHPMailer;

class NewsLetterHelper extends BaseHelper
{
    public function AddItem()
    {
        global $xpdo;

        date_default_timezone_set('Africa/Cairo');
        $createdOn      = date("Y-m-d H:i:s");

        $item = $xpdo->newObject('NewsLetterItems');

        $fields['Title']       = $_POST['title'];
        $fields['Description'] = $_POST['description'];
        $fields['UpdatedBy']   = $_SESSION['AdminUser']['FirstName'];
        $fields['CreatedBy']   = $_SESSION['AdminUser']['FirstName'];
        $fields['CreatedOn']   = $createdOn;


        $item->fromArray($fields);
        return $item->save();
    }

    public function GetItems()
    {
        global $xpdo;

        $query = $xpdo->newQuery('NewsLetterItems');
        $query->sortby('CreatedOn', 'DESC');

        $categoriesCount = $xpdo->getCount('NewsLetterItems', $query);
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

        $allObj = $xpdo->getCollection('NewsLetterItems', $query);

        $output = '';

        if (empty($allObj)) {
            $output .= new LoadChunk('no-data', 'admin/master', array(), '../');
        } else {
            foreach ($allObj as $currObj) {
                $output .= new LoadChunk('item', 'admin/newsLetter', array(
                                                  'totalPages'     =>  $totalpages,
                                                  'name_en'        =>  $currObj->Get('Title'),
                                                  'description_en' =>  $currObj->Get('Description'),
                                                  'currID'         =>  $currObj->Get('ID')
                                              ), '../');
            }
        }

        return $output;
    }

    public function GetItem()
    {
        global $xpdo;
        if (isset($_POST['itemID'])) {
            $itemID = $_POST['itemID'];
        }
        $item = $xpdo->getObject('NewsLetterItems', array('ID' => $itemID));
        $itemObj = json_encode($item->toArray());
        return $itemObj;
    }

    public function EditItem()
    {
        global $xpdo;
        date_default_timezone_set('Africa/Cairo');
        $updatedOn      = date("Y-m-d H:i:s");

        if (isset($_POST['itemID'])) {
            $itemID = $_POST['itemID'];
        }
        $item = $xpdo->getObject('NewsLetterItems', array('ID' => $itemID));
        
        $fields['Title']       = $_POST['edit_title'];
        $fields['Description'] = $_POST['edit_description'];
        $fields['UpdatedBy']   = $_SESSION['AdminUser']['FirstName'];
        $fields['UpdatedOn']   = $updatedOn;

        
        $item->fromArray($fields);
        return $item->save();
    }

    public function DeleteItem()
    {
        global $xpdo;
        if (isset($_POST['itemID'])) {
            $itemID = $_POST['itemID'];
        }
        $item = $xpdo->getObject('NewsLetterItems', array('ID' => $itemID));
        return $item->remove();
    }

    public function AddMail()
    {
        global $xpdo;

        $checkMail = $xpdo->getObject('NewsLetterMails', array('Mail' => $_POST['mail']));
        
        if (!empty($checkMail)) {
            return 0;
        }
        date_default_timezone_set('Africa/Cairo');
        $createdOn      = date("Y-m-d H:i:s");

        $item = $xpdo->newObject('NewsLetterMails');

        $fields['Mail']        = $_POST['mail'];
        $fields['CreatedOn']   = $createdOn;


        $item->fromArray($fields);
        return $item->save();
    }

    public function SendNewsLetter()
    {
        global $xpdo;
        if (isset($_POST['itemID'])) {
            $itemID = $_POST['itemID'];
        }
        $item  = $xpdo->getObject('NewsLetterItems', array('ID' => $itemID));
        $mails = $xpdo->getCollection('NewsLetterMails');


        //Send an email to the customer service email listing
        $title     = $item->get('Title');
        $message   = $item->get('Description');

        $emailBody = new LoadChunk('newsLetterBody', 'front/master', array(
                                                            'title'     => $title,
                                                            'message'   => $message,
                                                        ), '../');
        $mail = new PHPMailer;
        $mail->SMTPDebug = true;                           
        $mail->isSMTP();        
        $mail->Host = "smtp-mail.outlook.com";
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'travcogroup@outlook.com';                 // SMTP username
        $mail->Password = 'NoRep@2018';                           // SMTP password
        $mail->SMTPSecure = 'tls';                    
        $mail->Port = 587;                    
        $mail->From = "travcogroup@outlook.com";
        $mail->FromName = "Travco NewsLetter";
        foreach ($mails as $obj) {
            $mail->addAddress($obj->get('Mail'), "test");
        }
        $mail->isHTML(true);
        $mail->Subject = "Travco Website | NewsLetter";
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
