<?php
error_reporting(0);
require_once('BaseHelper.php');
require_once('PasswordHelper.php');

class AdminUsersHelper extends BaseHelper
{
    protected $table      = 'Admins';
    protected $rolesTable = 'Roles';

    public static function IsLoggedIn()
    {
        return isset($_SESSION['AdminUser']);
    }

    public function IsSuperAdmin()
    {
        global $xpdo;

        if ($this->IsLoggedIn() === 1) {
            if (isset($_SESSION['AdminUser'])) {
                $admin = $xpdo->getObject('Admins', array('ID' => $_SESSION['AdminUser']['ID']));

                return $admin->get('IsSuperAdmin') == 1;
            }
        }

        return FALSE;
    }

    public static function Logout()
    {
        if (self::IsLoggedIn()) {
            unset($_SESSION['AdminUser']);
            return true;
        }

        return false;
    }

    public function Login()
    {
        global $xpdo;

        // Redirect to homepage if admin is already logged in
        if (self::IsLoggedIn())
            UtilityHelper::RedirectTo('index.php');

        $email    = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email)) {
            return UtilityHelper::Response('error', 'Email is required.');
        }

        if (empty($password)) {
            return UtilityHelper::Response('error', 'Password is required.');
        }

        $user = $xpdo->getObject('Admins', array('Email' => $email));

        if (empty($user)) {
            return UtilityHelper::Response('error', 'This user does not exist.');
        }

        if ($user->get('IsActive') == 0) {
            return UtilityHelper::Response('error', 'This user is currently disabled.');
        }

        $hash = $user->get('Password');

        if (password_verify($password, $hash)) {
            $_SESSION['AdminUser'] = $user->toArray();
            return UtilityHelper::Response('success', 'User logged in successfully.');
        } else {
            return UtilityHelper::Response('error', 'Password is incorrect or email and password do not match.');
        }
    }

    public function CreateAdminUser()
    {
        global $xpdo;
        // $xpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        date_default_timezone_set('Africa/Cairo'); 
        $createdOn          = date("Y-m-d H:i:s");
        $fields = array();
        // Validations
        if (!self::IsLoggedIn())
            return UtilityHelper::Response('error', 'Unauthorized request. Please login and try again.');

        if (empty($_POST['firstName']))
            return UtilityHelper::Response('error', 'First name is required.');

        if (empty($_POST['lastName']))
            return UtilityHelper::Response('error', 'Last name is required.');

        if (empty($_POST['email']))
            return UtilityHelper::Response('error', 'Email is required.');

        if (empty($_POST['password']))
            return UtilityHelper::Response('error', 'Password is required.');

        if (empty($_POST['confirmPassword']))
            return UtilityHelper::Response('error', 'Password confirmation is required.');

        if ($_POST['password'] !== $_POST['confirmPassword'])
            return UtilityHelper::Response('error', 'Password and password confirmation do not match.');

        $checkUserExistence = $xpdo->getCount($this->table, array('Email' => $_POST['email']));

        if (!empty($checkUserExistence))
            return UtilityHelper::Response('error', 'This email already exists.');

        
        $fields['FirstName'] = trim($_POST['firstName']);
        $fields['LastName']  = trim($_POST['lastName']);
        $fields['Email']     = trim($_POST['email']);
        $fields['Password']  = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $fields['IsActive']  = (isset($_POST['isActive'])) ? 1 : 0;

        $adminUser = $xpdo->newObject($this->table);

        // $fields =      array(
        //                     'FirstName' => trim($_POST['firstName']),
        //                     'LastName'  => trim($_POST['lastName']),
        //                     'Email'     => trim($_POST['email']),
        //                     'Password'  => password_hash($_POST['password'], PASSWORD_BCRYPT),
        //                     'IsActive'  => (isset($_POST['isActive'])) ? 1 : 0,
        //                     // 'CreatedOn' => $createdOn
        //                 );
        
        $adminUser->fromArray($fields);
        if ($adminUser->save()) {
            return UtilityHelper::Response('success', 'Admin user has been added successfully.');
        } else {
            return UtilityHelper::Response('error', 'Something went wrong while adding new admin.');
        }
    }

    public function EditAdminUser()
    {
        global $xpdo;
        $fields = array();

        // Validations
        if (!self::IsLoggedIn())
            return UtilityHelper::Response('error', 'Unauthorized request. Please login and try again.');

        if (empty($_POST['userID']))
            return UtilityHelper::Response('error', 'User ID is required.');

        $adminUser = $xpdo->getObject($this->table, array('ID' => $_POST['userID']));

        if (empty($adminUser))
            return UtilityHelper::Response('error', 'This admin user does not exist.');

        if (empty($_POST['firstName']))
            return UtilityHelper::Response('error', 'First name is required.');

        if (empty($_POST['lastName']))
            return UtilityHelper::Response('error', 'Last name is required.');

        if (empty($_POST['email']))
            return UtilityHelper::Response('error', 'Email is required.');

        // Set New Values
        if ($adminUser->get('FirstName') != trim($_POST['firstName']))
            $fields['FirstName'] = trim($_POST['firstName']);

        if ($adminUser->get('LastName') != trim($_POST['lastName']))
            $fields['LastName'] = trim($_POST['lastName']);

        if ($adminUser->get('Email') != trim($_POST['email'])) {
            // Check User Existence
            $checkUserExistence = $xpdo->getCount($this->table, array('Email' => trim($_POST['email'])));

            if (!empty($checkUserExistence))
                return UtilityHelper::Response('error', 'This email already exists.');

            $fields['Email'] = trim($_POST['email']);
        }

        if (!empty($_POST['password'])) {
            if (empty($_POST['confirmPassword'])
                || $_POST['password'] !== $_POST['confirmPassword']) {
                return UtilityHelper::Response('error', 'Password confirmation is missing or does not match the entered password.');
            }

            if (!password_verify($_POST['password'], $adminUser->get('Password')))
                $fields['Password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
        }
            if (isset($_POST['isActive'])) {
                $isActive = 1;

                if ($isActive != $adminUser->get('IsActive'))
                    $fields['IsActive'] = $isActive;
            }
            else {
                $isActive = 0;
                if ($isActive != $adminUser->get('IsActive'))
                    $fields['IsActive'] = $isActive;
            }

        $adminUser->fromArray($fields);

        if ($adminUser->save()) {
            return UtilityHelper::Response('success', 'Admin user has been updated successfully.');
        } else {
            return UtilityHelper::Response('error', 'Could not update this admin user\'s info.');
        }
    }

    public function DeleteAdminUser()
    {
        global $xpdo;

        // Validations
        if (!self::IsLoggedIn())
            return UtilityHelper::Response('error', 'Unauthorized request. Please login and try again.');

        if (empty($_POST['userID']))
            return UtilityHelper::Response('error', 'User ID is required.');

        $adminUser = $xpdo->getObject($this->table, array('ID' => $_POST['userID']));

        if (empty($adminUser))
            return UtilityHelper::Response('error', 'This admin user does not exist.');

        if ($adminUser->remove())
            return UtilityHelper::Response('success', 'Admin user has been successfully deleted.');
        else
            return UtilityHelper::Response('error', 'Something went wrong while attempting to delete this admin user.');
    }

    public function GetAll()
    {
        global $xpdo;

        // Validations
        if (!self::IsLoggedIn())
            return UtilityHelper::Response('error', 'Unauthorized request. Please login and try again.');

        // Admin Users Query
        $adminUsersQuery = $xpdo->newQuery($this->table);

        // Roles Filter
        if (!empty($_POST['roleFilter']))
        {
            $adminUsersQuery->where(array('RoleID' => $_POST['roleFilter']));
        }

        // User Status Filter
        if (isset($_POST['userStatus']))
        {
            $adminUsersQuery->where(array('IsActive' => $_POST['userStatus']));
        }

        // Search by Name or Email Filter
        if (!empty($_POST['userSearch']))
        {
            $userSearch = trim($_POST['userSearch']);

            $adminUsersQuery->where(array(
                                    array('FirstName:LIKE'   => "%$userSearch%"),
                                    array('OR:LastName:LIKE' => "%$userSearch%"),
                                    array('OR:Email:LIKE'    => "%$userSearch%")
                                ));
        }

        $numrows     = $xpdo->getCount($this->table, $adminUsersQuery);
        $rowsperpage = 10;
        $totalpages  = ceil($numrows / $rowsperpage);

        if (isset($_POST['currentpage']) && is_numeric($_POST['currentpage']))
        {
            $currentpage             = (int) $_POST['currentpage'];
            $_SESSION['currentpage'] = $_POST['currentpage'];
        }
        else if (isset($_SESSION['currentpage']))
        {
            $currentpage = (int) $_SESSION['currentpage'];
        }
        else
        {
           $currentpage = 1;
        }

        if ($currentpage > $totalpages)
        {
           $currentpage = $totalpages;
        }

        if ($currentpage < 1)
        {
           $currentpage = 1;
        }

        $offset = ($currentpage - 1) * $rowsperpage;

        $adminUsersQuery->limit($rowsperpage, $offset);
        $users = $xpdo->getCollection($this->table, $adminUsersQuery);

        $allUsersWidgets = '';

        if (empty($users))
        {
            $allUsersWidgets .= '<p>No admin users were found.</p>';
        }
        else
        {
            foreach ($users as $user)
            {
                $userFullName = $user->get('FirstName') . ' ' . $user->get('LastName');

                $editAdminUserBtn = new LoadChunk('editAdminUserBtn', 'admin/adminUsers', array(
                                                                'userID' => $user->get('ID')
                                                            ), '../');

                $allUsersWidgets .= new LoadChunk('singleUserWidget', 'admin/adminUsers', array(
                                                                'userID'           => $user->get('ID'),
                                                                'userFullName'     => $userFullName,
                                                                'userEmail'        => $user->get('Email'),
                                                                'editAdminUserBtn' => $editAdminUserBtn,
                                                                'totalPages'       => $totalpages,
                                                                'userStatus'       => ''
                                                            ), '../');
            }
        }

        return $allUsersWidgets;
    }

    public function GetUser()
    {
        global $xpdo;

        // Validations
        if (!self::IsLoggedIn())
            return UtilityHelper::Response('error', 'Unauthorized request. Please login and try again.');

        if (empty($_POST['userID']))
            return UtilityHelper::Response('error', 'User ID cannot be empty.');

        $user = $xpdo->getObject($this->table, array('ID' => $_POST['userID']));

        if (empty($user))
            return UtilityHelper::Response('error', 'This user does not exist.');

        return UtilityHelper::Response('success', $user->toArray());
    }

}
