<?php
require_once('../helpers/PdfsHelper.php');

if(isset($_POST['operation']))
{
	$pdfsHelper = new PdfsHelper();
	switch ($_POST['operation']) {
		case 'add':
			echo $pdfsHelper->AddItem();
			break;

		case 'getAll':
			echo $pdfsHelper->GetItems();
			break;

		case 'edit':
			echo $pdfsHelper->EditItem();
			break;

		case 'get':
			echo $pdfsHelper->GetItem();
			break;
        case 'delete':
            echo $pdfsHelper->DeleteItem();
            break;

        case 'getAllPdfsFront':
            echo $pdfsHelper->GetAllPdfsFront();
            break;
		default:
			# code...
			break;
	}
}
?>