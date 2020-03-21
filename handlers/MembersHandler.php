<?php
require_once('../helpers/MembersHelper.php');

if(isset($_POST['operation']))
{
	$membersHelper = new MembersHelper();
	switch ($_POST['operation']) {
		case 'add':
			echo $membersHelper->AddItem();
			break;

		case 'getAll':
			echo $membersHelper->GetItems();
			break;

		case 'edit':
			echo $membersHelper->EditItem();
			break;

		case 'get':
			echo $membersHelper->GetItem();
			break;

        case 'delete':
            echo $membersHelper->DeleteItem();
            break;
		default:
			# code...
			break;
	}
}
?>