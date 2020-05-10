<?php
require_once('../helpers/MemberCategoriesHelper.php');

if(isset($_POST['operation']))
{
	
	$memberCategories = new MemberCategoriesHelper();

	switch ($_POST['operation']) {
		case 'add':

			echo $memberCategories->AddItem();
			break;

		case 'getAll':
			echo $memberCategories->GetItems();
			break;

		case 'edit':
			echo $memberCategories->EditItem();
			break;

		case 'get':
			echo $memberCategories->GetItem();
			break;

        case 'delete':
            echo $memberCategories->DeleteItem();
            break;
		default:
			# code...
			break;
	}
}
?>