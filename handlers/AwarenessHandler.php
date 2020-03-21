<?php
require_once('../helpers/AwarenessHelper.php');

if (isset($_POST['operation'])) {
    $awarenessHelper = new AwarenessHelper();
    switch ($_POST['operation']) {
        case 'add':
            echo $awarenessHelper->AddItem();
            break;

        case 'getAll':
            echo $awarenessHelper->GetItems();
            break;

        case 'edit':
            echo $awarenessHelper->EditItem();
            break;

        case 'get':
            echo $awarenessHelper->GetItem();
            break;

        case 'delete':
            echo $awarenessHelper->DeleteItem();
            break;
            
        case 'uploadFiles':
            echo $awarenessHelper->UploadFiles();
        break;

        case 'getItemPhotos':
            echo $awarenessHelper->GetItemfiles();
        break;

        case 'deleteFile':
            echo $awarenessHelper->DeleteFile();
        break;
        default:
            # code...
            break;
    }
}
