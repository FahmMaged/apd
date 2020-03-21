<?php
require_once('../helpers/ServicesHelper.php');

if(isset($_POST['operation']))
{
	$servicesHelper = new ServicesHelper();
	switch ($_POST['operation']) {
		case 'add':
			echo $servicesHelper->AddItem();
			break;

		case 'getAll':
			echo $servicesHelper->GetItems();
			break;

		case 'edit':
			echo $servicesHelper->EditItem();
			break;

		case 'get':
			echo $servicesHelper->GetItem();
			break;
        case 'delete':
            echo $servicesHelper->DeleteItem();
            break;
		default:
			# code...
			break;
	}
}
?>