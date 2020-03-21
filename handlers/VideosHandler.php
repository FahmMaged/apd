<?php
require_once('../helpers/VideosHelper.php');

if(isset($_POST['operation']))
{
	$videosHelper = new VideosHelper();
	switch ($_POST['operation']) {
		case 'add':
			echo $videosHelper->AddItem();
			break;

		case 'getAll':
			echo $videosHelper->GetItems();
			break;

		case 'edit':
			echo $videosHelper->EditItem();
			break;

		case 'get':
			echo $videosHelper->GetItem();
			break;
        case 'delete':
            echo $videosHelper->DeleteItem();
            break;

        case 'getMedia':
            echo $videosHelper->GetMedia2();
            break;
		default:
			# code...
			break;
	}
}
?>