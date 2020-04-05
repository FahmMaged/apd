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
class EventsSubmissionsHelper extends BaseHelper
{
    // Events Functions
    public function GetAll()
    {
        global $xpdo;
        
        $submissions = $xpdo->getCollection('EventsSubmissions');
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
                $allApplications .= new LoadChunk('submission', 'admin/eventsSubmissions', array(
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
        $submission = $xpdo->newObject('EventsSubmissions');
        $submission->fromArray($fields);
        return $submission->save();

        //  $emailBody = new LoadChunk('mailBody', 'front/master', array(
        //                             'name'     => $name,
        //                             'email'    => $email,
        //                             'phone'    => $phone,
        //                             'message'  => $message,
        //                           ), '../');

        //     $mail = new PHPMailer;
        //     $mail->SMTPDebug = 0;                           
        //     $mail->isSMTP();        
        //     $mail->Host = "smtp.gmail.com";
        //     $mail->SMTPAuth = true;                               // Enable SMTP authentication
        //     $mail->Username = 'test@gmail.com';                 // SMTP username
        //     $mail->Password = 'NoRep@2020';                           // SMTP password
        //     $mail->SMTPSecure = 'tls';                    
        //     $mail->Port = 587;                    
        //     $mail->From = "test@gmail.com";
        //     $mail->FromName = "NCCPIM Events Us";
        //     $mail->addAddress("test.email", "NCCPIM");
        //     $mail->isHTML(true);
        //     $mail->Subject = "Events";
        //     $mail->Body = "Hello, <br> ". $emailBody;
        //   if(!$mail->send())
        //   {
        //   // echo "Mailer Error: " . $mail->ErrorInfo;
        //   return json_encode(array('res' => 0, 'message' => "Mailer Error: " . $mail->ErrorInfo));
        //   }
        //   else
        //   {
        //   return json_encode(array('res' => 1, 'message' => 'Message has been submitted successfully.'));
        //   }
    }

    public function DeleteSubmission()
    {
        global $xpdo;
        if (isset($_POST['itemID'])) {
            $submission = $xpdo->getObject('EventsSubmissions', array('ID' => $_POST['itemID']));
        
            return $submission->remove();
        }
    }
}
