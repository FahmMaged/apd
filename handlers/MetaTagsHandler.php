<?php
require_once('../helpers/MetaTagsHelper.php');

if (isset($_POST['operation'])) {
    $metaTagsHelper = new MetaTagsHelper();
    switch ($_POST['operation']) {
        case 'get':
            echo $metaTagsHelper->Get();
            break;
        case 'edit':
            echo $metaTagsHelper->Edit();
            break;
        default:
            # code...
            break;
    }
}
