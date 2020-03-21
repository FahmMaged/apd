<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once('AdminUsersHelper.php');
use PHPMailer\PHPMailer\PHPMailer;
require_once "vendor/vendor/autoload.php";
require_once "vendor/vendor/phpmailer/phpmailer/src/PHPMailer.php";
/**
*
*/
class ContactHelper extends BaseHelper
{
    // Contact Functions
    public function GetAll()
    {
        global $xpdo;
        
        $submissions = $xpdo->getCollection('ContactUsSubmission');
        $allApplications = '';
        if (!empty($submissions)) {
            // <td>Actions</td>
            $allApplications .="<table class='responsive-table'><thead><tr>
					<td>Name</td>
                    <td>Phone</td>
                    <td>Email</td>
					<td>Message</td>
                    <td>Delete</td>
					

                    

                    </tr></thead><tbody>";

            foreach ($submissions as $submission) {
                $allApplications .= new LoadChunk('submission', 'admin/contactSubmissions', array(
                                                             'ID'               => $submission->get('ID'),
                                                             'name'             => $submission->get('Name'),
                                                             'phone'            => $submission->get('Phone'),
                                                             'email'            => $submission->get('Email'),
                                                             'message'          => $submission->get('Message')
                                                             ), '../');
            }

            $allApplications .="</tbody></table>";
        }else{
            $allApplications .= new LoadChunk('no-data', 'admin/master', array(), '../');
        }
        
        

        return $allApplications;
    }

    public function AddSubmission()
    {
        global $xpdo;
        $name      = $_POST['name'];
        $email     = $_POST['email'];
        $phone     = $_POST['phone'];
        $message   = trim($_POST['message']);
        date_default_timezone_set('Africa/Cairo'); 
        $createdOn      = date("Y-m-d H:i:s");

        $fields['Name']        = $name;
        $fields['Email']       = $email;
        $fields['Phone']       = $phone;
        $fields['Message']     = $message;
        $fields['CreatedOn']   = $createdOn;
        $submission = $xpdo->newObject('ContactUsSubmission');
        $submission->fromArray($fields);
        echo $submission->save();

         $emailBody = new LoadChunk('mailBody', 'front/master', array(
                                    'name'     => $name,
                                    'email'    => $email,
                                    'phone'    => $phone,
                                    'message'  => $message,
                                  ), '../');

            $mail = new PHPMailer;
            $mail->SMTPDebug = 0;                           
            $mail->isSMTP();        
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'nccpimandtip@gmail.com';                 // SMTP username
            $mail->Password = 'NoRep@2020';                           // SMTP password
            $mail->SMTPSecure = 'tls';                    
            $mail->Port = 587;                    
            $mail->From = "nccpimandtip@gmail.com";
            $mail->FromName = "NCCPIM Contact Us";
            $mail->addAddress("nccpim@gmail.com", "NCCPIM");
            $mail->isHTML(true);
            $mail->Subject = "Contact Us";
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

    public function DeleteSubmission()
    {
        global $xpdo;
        if (isset($_POST['itemID'])) {
            $submission = $xpdo->getObject('ContactUsSubmission', array('ID' => $_POST['itemID']));
        
            return $submission->remove();
        }
    }

    // Books Contact Functions
    public function GetAllBooksSubmissions()
    {
        global $xpdo;
        
        $submissions = $xpdo->getCollection('BooksSubmissions');
        $allApplications = '';
        if (!empty($submissions)) {
            // <td>Actions</td>
            $allApplications .="<table class='responsive-table'><thead><tr>
                    <td>First Name</td>
                    <td>Last Name</td>
                    <td>Phone</td>
                    <td>Email</td>
                    <td>Message</td>
                    <td>Delete</td>
                    

                    

                    </tr></thead><tbody>";

            foreach ($submissions as $submission) {
                $allApplications .= new LoadChunk('submission', 'admin/booksSubmissions', array(
                                                             'ID'               => $submission->get('ID'),
                                                             'firstName'        => $submission->get('FirstName'),
                                                             'lastName'         => $submission->get('LastName'),
                                                             'phone'            => $submission->get('Phone'),
                                                             'email'            => $submission->get('Email'),
                                                             'message'          => $submission->get('Message')
                                                             ), '../');
            }

            $allApplications .="</tbody></table>";
        }else{
            $allApplications .= new LoadChunk('no-data', 'admin/master', array(), '../');
        }
        
        

        return $allApplications;
    }

    public function AddBookSubmission()
    {
        global $xpdo;
        $firstName = $_POST['first_name'];
        $lastName  = $_POST['family_name'];
        $email     = $_POST['email'];
        $phone     = $_POST['phone'];
        $message   = trim($_POST['message']);
        date_default_timezone_set('Africa/Cairo'); 
        $createdOn      = date("Y-m-d H:i:s");

        $fields['FirstName']   = $firstName;
        $fields['LastName']    = $lastName;
        $fields['Email']       = $email;
        $fields['Phone']       = $phone;
        $fields['Message']     = $message;
        $fields['CreatedOn']   = $createdOn;
        $submission = $xpdo->newObject('BooksSubmissions');
        $submission->fromArray($fields);
        echo $submission->save();

         $emailBody = new LoadChunk('mailBody', 'front/master', array(
                                    'name'     => $firstName ." ".$lastName,
                                    'email'    => $email,
                                    'phone'    => $phone,
                                    'message'  => $message,
                                  ), '../');
          $mail = new PHPMailer;
          $mail->SMTPDebug = 0;                           
          $mail->isSMTP();        
          $mail->Host = "smtp.gmail.com";
          $mail->SMTPAuth = true;                               // Enable SMTP authentication
          $mail->Username = 'nccpimandtip@gmail.com';                 // SMTP username
          $mail->Password = 'NoRep@2020';                           // SMTP password
          $mail->SMTPSecure = 'tls';                    
          $mail->Port = 587;                    
          $mail->From = "nccpim@gmail.com";
          $mail->FromName = "NCCPIM Borrow Book";
          $mail->addAddress("nccpim@gmail.com", "noreply");
          $mail->isHTML(true);
          $mail->Subject = "Borrow Book";
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

    public function DeleteBookSubmission()
    {
        global $xpdo;
        if (isset($_POST['itemID'])) {
            $submission = $xpdo->getObject('BooksSubmissions', array('ID' => $_POST['itemID']));
        
            return $submission->remove();
        }
    }
}
