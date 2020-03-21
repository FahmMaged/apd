<?php
require_once('../helpers/OurWorkHelper.php');

if(isset($_POST['operation']))
{
	$ourWorkHelper = new OurWorkHelper();
	switch ($_POST['operation']) {
		case 'add':
			echo $ourWorkHelper->AddItem();
			break;

		case 'getAll':
			echo $ourWorkHelper->GetItems();
			break;

		case 'edit':
			echo $ourWorkHelper->EditItem();
			break;

		case 'get':
			echo $ourWorkHelper->GetItem();
			break;
        case 'delete':
            echo $ourWorkHelper->DeleteItem();
            break;
		default:
			# code...
			break;
	}
}
?>