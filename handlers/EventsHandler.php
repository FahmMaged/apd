<?php
require_once('../helpers/EventsHelper.php');

if(isset($_POST['operation']))
{
	$eventsHelper = new EventsHelper();
	switch ($_POST['operation']) {
		case 'getAll':
			echo $eventsHelper->GetAll();
			break;
		case 'add':
			echo $eventsHelper->Add();
			break;

		case 'upload':
			echo $eventsHelper->Upload();
			break;

		case 'get':
			echo $eventsHelper->Get();
			break;

		case 'edit':
			echo $eventsHelper->Edit();
			break;

		case 'delete':
			echo $eventsHelper->Delete();
			break;

		case 'getAllNews':
			echo $eventsHelper->GetAll();
			break;

		case 'set':
			echo $eventsHelper->setPageStatus();
			break;
		case 'editPage':
            echo $eventsHelper->EditPageContent();
            break;
        case 'getPageContent':
            echo $eventsHelper->GetPageContent();
            break;
        case 'getAllEventsFront':
            echo $eventsHelper->GetAllEventsFront();
            break;
		
		default:
			# code...
			break;
	}
}
?>