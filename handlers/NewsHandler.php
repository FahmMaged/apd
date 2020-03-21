<?php
require_once('../helpers/NewsHelper.php');

if(isset($_POST['operation']))
{
	$newsHelper = new NewsHelper();
	switch ($_POST['operation']) {
		case 'getAll':
			echo $newsHelper->GetAll();
			break;
		case 'add':
			echo $newsHelper->Add();
			break;

		case 'upload':
			echo $newsHelper->Upload();
			break;

		case 'get':
			echo $newsHelper->GetNews();
			break;

		case 'edit':
			echo $newsHelper->EditNews();
			break;

		case 'delete':
			echo $newsHelper->DeleteNews();
			break;

		case 'getAllNews':
			echo $newsHelper->GetAllNews();
			break;

		case 'set':
			echo $newsHelper->setPageStatus();
			break;
		case 'editPage':
            echo $newsHelper->EditPageContent();
            break;
        case 'getPageContent':
            echo $newsHelper->GetPageContent();
            break;
        case 'getAllNewsFront':
            echo $newsHelper->GetAllNewsFront();
            break;
		
		default:
			# code...
			break;
	}
}
?>