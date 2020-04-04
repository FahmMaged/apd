<?php
require_once('../helpers/EventsSubmissionsHelper.php');

if(isset($_POST['operation']))
{
	$eventsSubmissionsHelper = new EventsSubmissionsHelper();
	switch ($_POST['operation']) {
		case 'add':
			echo $eventsSubmissionsHelper->AddSubmission();
			break;

		case 'getAll':
			echo $eventsSubmissionsHelper->GetAll();
			break;
			
        case 'delete':
            echo $eventsSubmissionsHelper->DeleteSubmission();
            break;
		default:
			# code...
			break;
	}
}
?>