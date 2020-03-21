<?php
require_once('../helpers/MainImagesHelper.php');

if (isset($_POST['operation'])) {
    $mainImagesHelper = new MainImagesHelper();
    switch ($_POST['operation']) {
        case 'get':
            echo $mainImagesHelper->Get();
            break;
        case 'edit':
            echo $mainImagesHelper->Edit();
            break;
        
        default:
            # code...
            break;
    }
}
