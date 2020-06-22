<?php
if (!isset($_SESSION)) session_start();
require_once('AdminUsersHelper.php');
require_once('PasswordHelper.php');
require_once('URLHelper.php');
use PHPMailer\PHPMailer\PHPMailer;
require_once "vendor/vendor/autoload.php";
require_once "vendor/vendor/phpmailer/phpmailer/src/PHPMailer.php";
//PHPMailer Object
$mail = new PHPMailer;
class MembersHelper extends BaseHelper
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

        $item = $xpdo->newObject('Members');
        // $xpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if ($_POST['password'] !== $_POST['confirmPassword'])
        return json_encode(array('saved' => 3 ));

        $checkUserExistence = $xpdo->getCount('Members', array('Email' => $_POST['email']));
        if (!empty($checkUserExistence))
            return json_encode(array('saved' => 2 ));

        // check categories
        if(isset($_POST['categoryIDs'])){
            
            $categoryIDs = $_POST['categoryIDs'];
            
            if(sizeof($categoryIDs) == 1){
                $categories = ",".$categoryIDs[0];
            } else{
                $categories = implode(',',$categoryIDs);
            }
        }

        $fields['FirstName']     = $_POST['first_name'];
        $fields['LastName']      = $_POST['last_name'];
        $fields['Email']         = $_POST['email'];
        $fields['Phone']         = $_POST['phone'];
        $fields['Bio']           = $_POST['bio'];
        $fields['Position']      = $_POST['position'];
        $fields['Degree']        = $_POST['degree'];
        $fields['Password']      = password_hash($_POST['password'], PASSWORD_BCRYPT);;
        $fields['City']          = $_POST['cityName'];
        $fields['LocationName']  = $_POST['locationName'];
        $fields['CategoryIDs']   = $categories;
        $fields['LocationID']    = $_POST['locationID'];
        $fields['CityID']        = $_POST['cityID'];
        $fields['IsActive']      = 0;
        $fields['Instructor']      = 0;
        if(isset($_POST['FacebookLink'])){
            $fields['FacebookLink']  = $_POST['FacebookLink'];
        }
        if(isset($_POST['TwitterLink'])){
            $fields['TwitterLink']   = $_POST['TwitterLink'];
        }
        if(isset($_POST['InstagramLink'])){
            $fields['InstagramLink'] = $_POST['InstagramLink'];
        }
        if(isset($_POST['LinkedinLink'])){
            $fields['LinkedinLink']  = $_POST['LinkedinLink'];
        }
        $fields['CreatedOn']     = $createdOn;

        if(isset($_FILES['image']) && $_FILES['image']['size'] > 0)
        {
             $response = $this->UploadFile($_FILES['image'],'/../uploads/members/', $x = 1920);
             $response = json_decode($response);

             if($response->res == 0)
             {
                  return UtilityHelper::Response('error',$response->message);
             }
             else
                 $fields['File'] = $response->message;
        }

        $item->fromArray($fields);

        // if ($item->save()) {
        //     $categoryIDs		=	(isset($_POST['categoryIDs']))? $_POST['categoryIDs'] : 0;
        //         if($categoryIDs != 0){
        //             foreach($categoryIDs as $id){
        //                 $memberCategory =	 $xpdo->newObject('MembersCategories');
        //                 $memberCategory	->fromArray(array('MemberID' =>	$item->get('ID') ,	'CategoryID' =>	$id));
        //                 $memberCategory	->save();
        //             }
        //         }
        // }

        // return $item->save();
        return json_encode(array('saved' => $item->save() ));
    }

    public function GetItems()
    {
        global $xpdo;

          $query = $xpdo->newQuery('Members');
          $query->sortby('CreatedOn', 'DESC');

          $categoriesCount = $xpdo->getCount('Members', $query);
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

          $allObj = $xpdo->getCollection('Members' ,$query);

          $output = '';

          if (empty($allObj)) {
              $output .= new LoadChunk('no-data','admin/master', array(), '../');
          }

          foreach($allObj as $currObj)
          {
              $output .= new LoadChunk('member', 'admin/members', array(
                                                'totalPages'     =>  $totalpages,
                                                'name_en'        =>  $currObj->Get('FirstName')." ".$currObj->Get('LastName'),
                                                'description_en' =>  $currObj->Get('JobTitle_ar'),
                                                'image'          =>  $currObj->Get('File'),
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
        $item = $xpdo->getObject('Members', array('ID' => $itemID));
        $itemObj = json_encode($item->toArray());

        if(!empty($item->get('CategoryIDs'))){
            $categories = $item->get('CategoryIDs');
            $categoriesIDs = (explode(",",$categories));
            $categoriesNames = '';
            if(!empty($categoriesIDs)){
                foreach($categoriesIDs as $id){
                    $datename = $xpdo->getObject('MemberCategories', array('ID' => $id));
                    $dname = "Not available";
                    if(!empty($datename)){
                        $dname = $datename->get('Title_en');
                    }
                    
                    $categoriesNames .= ' '. $dname .',';
                }
            }
            $items = $categoriesNames;
        }
        $result =  json_encode(array('all' => $itemObj, 'names' => $items));
        return $result;
    }
    public function GetMember()
    {
        global $xpdo;
        if (isset($_POST['id'])) 
        {
            $itemID = $_POST['id'];
        }
        $members = $xpdo->getObject('Members', array('ID' => $itemID));
        $itemObj = json_encode($members->toArray());
        $hideF = !empty($members->get('FacebookLink')) ? '' : 'hidden';
            $hideT = !empty($members->get('TwitterLink')) ? '' : 'hidden';
            $hideI = !empty($members->get('InstagramLink')) ? '' : 'hidden';
            $hideL = !empty($members->get('LinkedinLink')) ? '' : 'hidden';

        $name = $members->get('FirstName')." ".$members->get('LastName');

          $membersModal =  new LoadChunk('modal','front/members',array(
                                                    'email'  =>  $members->get('Email'),
                                                    'position'=>  $members->get('Position'),
                                                    'degree'  =>  $members->get('Degree'),
                                                    'name'   =>  $name,
                                                    'hideF'   =>  $hideF,
                                                    'hideT'   =>  $hideT,
                                                    'hideI'   =>  $hideI,
                                                    'hideL'   =>  $hideL,
                                                    'phone'  =>  $members->get('Phone'),
                                                    'image'  =>  $members->get('File'),
                                                    'FacebookLink'  =>  $members->get('FacebookLink'),
                                                    'TwitterLink'   =>  $members->get('TwitterLink'),
                                                    'InstagramLink' =>  $members->get('InstagramLink'),
                                                    'LinkedinLink'  =>  $members->get('LinkedinLink'),
                                                    'id'     =>  $members->get('ID'),
                                                    // 'lang'   =>  $lang,
                                            ),'../');
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
        $item = $xpdo->getObject('Members', array('ID' => $itemID));
        
        if (!empty($_POST['password'])) {
            if (empty($_POST['confirmPassword'])
                || $_POST['password'] !== $_POST['confirmPassword']) {
                return 0;
                    // return UtilityHelper::Response('error', 'Password confirmation is missing or does not match the entered password.');
            }

            if (!password_verify($_POST['password'], $item->get('Password')))
                $fields['Password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
        }
        
            if (isset($_POST['isActive'])) {
                $isActive = 1;
                if ($isActive != $item->get('IsActive'))
                    $fields['IsActive'] = $isActive;
            }
            else {
                $isActive = 0;
                if ($isActive != $item->get('IsActive'))
                    $fields['IsActive'] = $isActive;
            }

            if (isset($_POST['Instructor'])) {
                $Instructor = 1;
                if ($Instructor != $item->get('Instructor'))
                    $fields['Instructor'] = $Instructor;
            }
            else {
                $Instructor = 0;
                if ($Instructor != $item->get('Instructor'))
                    $fields['Instructor'] = $Instructor;
            }
        $fields['FirstName']     = $_POST['first_name'];
        $fields['LastName']      = $_POST['last_name'];
        $fields['Email']         = $_POST['email'];
        $fields['Phone']         = $_POST['phone'];
        $fields['Bio']           = $_POST['bio'];
        $fields['Position']      = $_POST['position'];
        $fields['Degree']        = $_POST['degree'];
        $fields['City']          = $_POST['city'];
        $fields['LocationName']  = $_POST['location'];
        if(isset($_POST['FacebookLink'])){
            $fields['FacebookLink']  = $_POST['FacebookLink'];
        }
        if(isset($_POST['TwitterLink'])){
            $fields['TwitterLink']   = $_POST['TwitterLink'];
        }
        if(isset($_POST['InstagramLink'])){
            $fields['InstagramLink'] = $_POST['InstagramLink'];
        }
        if(isset($_POST['LinkedinLink'])){
            $fields['LinkedinLink']  = $_POST['LinkedinLink'];
        }

        if(isset($_FILES['picture']) && $_FILES['picture']['size'] > 0){
        
            $response = $this->UploadFile($_FILES['picture'],'/../uploads/members/', $x = 500);
            $response = json_decode($response);

            if($response->res == 0)
            {
             return UtilityHelper::Response('error',$response->message);
            }
            else{
               if (!empty($item->get('File')) ) {
                 unlink('../'.$item->get('File'));
               }
              $fields['File'] = $response->message;
            }
       }

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
        $item = $xpdo->getObject('Members', array('ID' => $itemID));
        if (!empty($item->get('File'))) {
          unlink("../".$item->get('File'));
        }
        
        return $item->remove();
    }

    public function Login()
    {
        global $xpdo;

        // Redirect to homepage if admin is already logged in
        // if (self::IsLoggedIn())
        //     UtilityHelper::RedirectTo('index.php');
        $email    = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email)) {
            return json_encode(array('res' => 0, 'message_en' => 'Email is required.', 'message_ar' => 'البريد الالكتروني مطلوب' ));
        }

        if (empty($password)) {
            // return UtilityHelper::Response('error', 'Password is required.');
            return json_encode(array('res' => 0,
             'message_en' => 'Password is required',
             'message_ar' => 'لابد من ادخال كلمة المرور' ));
        }

        $user = $xpdo->getObject('Members', array('Email' => $email));

        if (empty($user)) {
            // return UtilityHelper::Response('error', 'This user does not exist.');
            return json_encode(array('res' => 0,
             'message_en' => 'This user does not exist',
             'message_ar' => 'هذا المستخدم غير موجود' ));
        }

        if ($user->get('IsActive') == 0) {
            // return UtilityHelper::Response('error', 'This user is currently disabled.');
            return json_encode(array('res' => 0,
             'message_en' => 'This user is currently disabled',
             'message_ar' => 'هذا المستخدم غير مفعل' ));
        }

        $hash = $user->get('Password');

        if (password_verify($password, $hash)) {
            $_SESSION['User'] = $user->toArray();
            return UtilityHelper::Response('success', 'User logged in successfully.');
        } else {
            return json_encode(array('res' => 0,
             'message_en' => 'Password is incorrect or email and password do not match',
             'message_ar' => 'خطأفي البريد الالكتروني او كلمة السر' ));
            // return UtilityHelper::Response('error', 'Password is incorrect or email and password do not match.');
        }
    }

    public static function Logout()
    {
        if (self::IsLoggedIn()) {
            unset($_SESSION['User']);
            return true;
        }

        return false;
    }

    public static function IsLoggedIn()
    {
        return isset($_SESSION['User']);
    }

    public static function ForgetPassword() {
        $email    = $_POST['email'];

        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$email) {
            return json_encode(array('res' => 0, 'message_en' => 'Invalid Email.', 'message_ar' => 'البريد الالكتروني غير صالح' ));
        } else{
            
            global $xpdo;
            date_default_timezone_set('Africa/Cairo');
            $exist = $xpdo->getObject("Members", array("Email" => $email));
            if($exist){
                $expFormat = mktime(
                    date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
                    );
                $expDate = date("Y-m-d H:i:s",$expFormat);
                $key = md5(2418*2+$email);
                $addKey = substr(md5(uniqid(rand(),1)),3,10);
                $key = $key . $addKey;
                $item = $xpdo->newObject('PasswordResetTemp');
                $fields['email']    = $email;
                $fields['key']      = $key;
                $fields['expDate']  = $expDate;
                
                $item->fromArray($fields);
                // print_r($item->fromArray($fields));
                // exit;
                $item->save();

                $output='<p>Dear user,</p>';
                $output.='<p>Please click on the following link to reset your password.</p>';
                $output.='<p>-------------------------------------------------------------</p>';
                $output.='<p><a href="https://apdegypt.com/reset-password.php?key='.$key.'&email='.$email.'&action=reset" target="_blank">
                https://apdegypt.com/reset-password.php?key='.$key.'&email='.$email.'&action=reset</a></p>';		
                $output.='<p>-------------------------------------------------------------</p>';
                $output.='<p>Please be sure to copy the entire link into your browser.
                The link will expire after 1 day for security reason.</p>';
                $output.='<p>If you did not request this forgotten password email, no action 
                is needed, your password will not be reset. However, you may want to log into 
                your account and change your security password as someone may have guessed it.</p>';   	
                $output.='<p>Thanks,</p>';
                $output.='<p>apdegypt Team</p>';
                $body = $output; 
                $subject = "Password Recovery - apdegypt.com";

                $mail = new PHPMailer;
                $mail->CharSet = 'UTF-8';
                $mail->SMTPDebug = 0;                           
                // $mail->isSMTP();        
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'apdegypt.noreply@gmail.com';                 // SMTP username
                $mail->Password = 'apdegypt@2020';                           // SMTP password
                $mail->SMTPSecure = 'tls';                    
                $mail->Port = 587;                    
                $mail->From = "apdegypt.noreply@gmail.com";
                $mail->FromName = "APD Egypt";
                $mail->addAddress("$email", "APD Egypt");
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body = $body;
                if($mail->send()){
                    return json_encode(array('res' => 1,
                     'message_en' => 'An email has been sent to you with instructions on how to reset your password.',
                     'message_ar' => 'تم إرسال بريد إلكتروني إليك مع تعليمات حول كيفية إعادة تعيين كلمة المرور الخاصة بك.'));
                }
            } else{
                return json_encode(array('res' => 0, 'message_en' => 'Email not exist', 'message_ar' => 'البريد الالكتروني غير موجود' ));
            }
        }
    }

    // Front Functions
    public function GetAllMembersFront()
    {
      global $xpdo;
      date_default_timezone_set('Africa/Cairo');
      $currentDate = date("Y-m-d");
      $onclickFn   = 'fnGetMembers';
      $membersChunk   = '';
      $lang        = (isset($_POST['lang'])) ? $_POST['lang'] : 'ar';
      $langFile    = json_decode(file_get_contents('../lang/members.json'), true);

      // $news = $xpdo->getCollection('News');
      $query = $xpdo->newQuery('Members');
      $query->where(array(
        'IsActive'       => 1,
      ));
      if(!empty($_POST['city'])){
        $query->where(array(
            'CityID' => $_POST['city'],
          ));
      }

      if(!empty($_POST['categoryID']) ){
        $query->where(array(
            'CategoryIDs:LIKE' => '%'.$_POST['categoryID'].',%',
            'OR:CategoryIDs:LIKE' => '%,'.$_POST['categoryID'].'%'
          ));
      }

      if(!empty($_POST['location'])){
        $query->where(array(
            'LocationID' => $_POST['location'],
          ));
      }
      
      $members = $xpdo->getCollection('Members', $query);
      $numrows      = count($members);

      $pagination='';
      $rowsperpage = 9;
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

      $query = $xpdo->newQuery('Members');
      $query->where(array(
        'IsActive' => 1,
      ));
      if(!empty($_POST['city'])){
        $query->where(array(
            'CityID' => $_POST['city'],
          ));
      }

      if(!empty($_POST['categoryID']) ){
        $query->where(array(
            'CategoryIDs:LIKE' => '%'.$_POST['categoryID'].',%',
            'OR:CategoryIDs:LIKE' => '%,'.$_POST['categoryID'].'%'
          ));
      }

      if(!empty($_POST['location'])){
        $query->where(array(
            'LocationID' => $_POST['location'],
          ));
      }
      // $query->sortby('Sort', 'ASC');
      $query->sortby('CreatedOn', 'DESC');
      $query->limit($rowsperpage,$offset);
      $allMembers = $xpdo->getCollection('Members', $query);
    //   print_r($allMembers);
    //     exit;
      if ($allMembers) {
        foreach($allMembers as $members)
        {
            $hideF = !empty($members->get('FacebookLink')) ? '' : 'hidden';
            $hideT = !empty($members->get('TwitterLink')) ? '' : 'hidden';
            $hideI = !empty($members->get('InstagramLink')) ? '' : 'hidden';
            $hideL = !empty($members->get('LinkedinLink')) ? '' : 'hidden';

        $name = $members->get('FirstName')." ".$members->get('LastName');

          $membersChunk .=  new LoadChunk('member','front/members',array(
                                                    'email'  =>  $members->get('Email'),
                                                    'position'=>  $members->get('Position'),
                                                    'degree'  =>  $members->get('Degree'),
                                                    'name'   =>  $name,
                                                    'hideF'   =>  $hideF,
                                                    'hideT'   =>  $hideT,
                                                    'hideI'   =>  $hideI,
                                                    'hideL'   =>  $hideL,
                                                    'phone'  =>  $members->get('Phone'),
                                                    'image'  =>  $members->get('File'),
                                                    'FacebookLink'  =>  $members->get('FacebookLink'),
                                                    'TwitterLink'   =>  $members->get('TwitterLink'),
                                                    'InstagramLink' =>  $members->get('InstagramLink'),
                                                    'LinkedinLink'  =>  $members->get('LinkedinLink'),
                                                    'id'     =>  $members->get('ID'),
                                                    // 'lang'   =>  $lang,
                                            ),'../');

        }
      }

      // Build up the Pagination
      if ($totalpages > 1) {
        $pagination .= '<ul class="pagination">';

        if ($currentpage > 1) {
            $pagination .= '<li class="waves-effect"><a href="javascript:void(0)" onclick="'.$onclickFn.'(' . ($currentpage - 1) .')"> <i class="fa fa-chevron-right"></i></a></li>';
        }

        for ($i = 1; $i <= $totalpages; $i++) {
            if ($i <= $currentpage + 3 && $i >= $currentpage - 2) {
                if ($i == $currentpage) {
                    $pagination.= '<li class="active"><a href="javascript:void(0)">' . $i . '</a></li>';
                } else {
                    $pagination.= '<li class="waves-effect"><a href="javascript:void(0)" onclick="'.$onclickFn.'(' . $i .')">' . $i . '</a></li>';
                }
            }
        }
        if ($currentpage != $totalpages) {
            $pagination .= '<li class="waves-effect"><a href="javascript:void(0)" onclick="'.$onclickFn.'(' . ($currentpage + 1) .')"><i class="fa fa-chevron-left"></i></a></li>';

            // $pagination .= '<li class="waves-effect waves-dark"><a onclick="'.$onclickFn.'(' . $totalpages . ','.$parentID.')">...</a></li>';
        }

        $pagination .= '</ul>';
        }

      return json_encode(array('output' => $this->urlHelper->changeToAlias($membersChunk),
       'pagination' => $this->urlHelper->changeToAlias($pagination)
     ));

    

    }
	
}