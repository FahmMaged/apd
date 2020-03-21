<?php
require_once('../helpers/AboutHelper.php');

if (isset($_POST['operation'])) {
    $aboutHelper = new AboutHelper();
    switch ($_POST['operation']) {
        case 'get':
            echo $aboutHelper->Get();
            break;
        case 'edit':
            echo $aboutHelper->Edit();
            break;
// Alternatives
        case 'getAlter':
            echo $aboutHelper->GetAlter();
            break;
        case 'editAlter':
            echo $aboutHelper->EditAlter();
            break;
// Your Project
        case 'getPage':
            echo $aboutHelper->GetPage();
            break;
        case 'editPage':
            echo $aboutHelper->EditPage();
            break;
// Members
        case 'addMember':
            echo $aboutHelper->AddMember();
            break;
        case 'editMember':
            echo $aboutHelper->EditMember();
            break;
        case 'getMember':
            echo $aboutHelper->GetMember();
            break;
        case 'getAllMembers':
            echo $aboutHelper->GetAllMembers();
            break;
        case 'deleteMember':
            echo $aboutHelper->DeleteMember();
            break;
// Parteners
        case 'addPartener':
            echo $aboutHelper->AddPartener();
            break;
        case 'editPartener':
            echo $aboutHelper->EditPartener();
            break;
        case 'getPartener':
            echo $aboutHelper->GetPartener();
            break;
        case 'getAllParteners':
            echo $aboutHelper->GetAllParteners();
            break;
        case 'deletePartener':
            echo $aboutHelper->DeletePartener();
            break;       
        default:
            # code...
            break;
    }
}