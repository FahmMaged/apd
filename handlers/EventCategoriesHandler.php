<?php
require_once('../helpers/EventCategoriesHelper.php');

if(isset($_POST['operation']))
{
	
	$eventCategories = new EventCategoriesHelper();

	switch ($_POST['operation']) {
		case 'add':

			echo $eventCategories->AddItem();
			break;

		case 'getAll':
			echo $eventCategories->GetItems();
			break;

		case 'edit':
			echo $eventCategories->EditItem();
			break;

		case 'get':
			echo $eventCategories->GetItem();
			break;

        case 'delete':
            echo $eventCategories->DeleteItem();
            break;
		default:
			# code...
			break;
	}
}
?>