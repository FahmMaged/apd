<?php
require_once('../helpers/ImagesHelper.php');

if(isset($_POST['operation']))
{
	$imagesHelper = new ImagesHelper();
	switch ($_POST['operation']) {
		case 'add':
			echo $imagesHelper->AddItem();
			break;

		case 'getAll':
			echo $imagesHelper->GetItems();
			break;

		case 'edit':
			echo $imagesHelper->EditItem();
			break;

		case 'get':
			echo $imagesHelper->GetItem();
			break;
        case 'delete':
            echo $imagesHelper->DeleteItem();
            break;
        case 'uploadAlbumPhotos':
            echo $imagesHelper->UploadAlbumPhotos();
            break;
		default:
			# code...
			break;
	}
}
?>