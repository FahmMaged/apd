<?php
error_reporting(0);
require_once('../helpers/AdminUsersHelper.php');

if (isset($_POST['operation'])) {
    $helperObject = new AdminUsersHelper();

    switch ($_POST['operation']) {
        case 'login':
            echo $helperObject->Login();
            break;
        case 'logout':
            echo $helperObject->Logout();
            break;
        case 'create':
            echo $helperObject->CreateAdminUser();
            break;
        case 'edit':
            echo $helperObject->EditAdminUser();
            break;
        case 'delete':
            echo $helperObject->DeleteAdminUser();
            break;
        case 'createRole':
            echo $helperObject->CreateRole();
            break;
        case 'editRole':
            echo $helperObject->EditRole();
            break;
        case 'deleteRole':
            echo $helperObject->DeleteRole();
            break;
        case 'getAll':
            echo $helperObject->GetAll();
            break;
        case 'getUser':
            echo $helperObject->GetUser();
            break;
        case 'getAllRoles':
            echo $helperObject->GetAllRoles();
            break;
        case 'getAllRolesJSON':
            echo $helperObject->GetAllRolesJSON();
            break;
        case 'getRole':
            echo $helperObject->GetRole();
            break;
        case 'creatPass':
            echo $helperObject->CreatPass();
            break;
    }
} else {
    header('HTTP/1.1 400 Request Error');
    exit('No operation was provided to the handler.');
}
