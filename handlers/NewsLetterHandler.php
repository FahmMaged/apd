<?php
require_once('../helpers/NewsLetterHelper.php');

if (isset($_POST['operation'])) {
    $newsLetterHelper = new NewsLetterHelper();
    switch ($_POST['operation']) {
        case 'add':
            echo $newsLetterHelper->AddItem();
            break;

        case 'getAll':
            echo $newsLetterHelper->GetItems();
            break;

        case 'edit':
            echo $newsLetterHelper->EditItem();
            break;

        case 'get':
            echo $newsLetterHelper->GetItem();
            break;
        case 'delete':
            echo $newsLetterHelper->DeleteItem();
            break;
        case 'addMail':
            echo $newsLetterHelper->AddMail();
            break;
        case 'sendNewsLetter':
            echo $newsLetterHelper->SendNewsLetter();
            break;
        case 'getPageContent':
            echo $newsLetterHelper->GetPageContent();
            break;
        case 'apply':
            echo $newsLetterHelper->Apply();
            break;
        default:
            # code...
            break;
    }
}
