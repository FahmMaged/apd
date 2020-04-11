<?php
require_once('../helpers/EventsLocationsHelper.php');

if(isset($_POST['operation']))
{
	$eventsLocationsHelper = new EventsLocationsHelper();
	switch ($_POST['operation']) {
		case 'add':
			echo $eventsLocationsHelper->AddItem();
			break;

		case 'getAll':
			echo $eventsLocationsHelper->GetItems();
			break;

		case 'edit':
			echo $eventsLocationsHelper->EditItem();
			break;

		case 'get':
			echo $eventsLocationsHelper->GetItem();
			break;
        case 'delete':
            echo $eventsLocationsHelper->DeleteItem();
            break;
		default:
			# code...
			break;
	}
}
?>