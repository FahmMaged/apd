<?php
require_once('../helpers/QuestionsHelper.php');

if(isset($_POST['operation']))
{
	$questionsHelper = new QuestionsHelper();
	switch ($_POST['operation']) {
		case 'add':
			echo $questionsHelper->AddItem();
			break;

		case 'getAll':
			echo $questionsHelper->GetItems();
			break;

		case 'edit':
			echo $questionsHelper->EditItem();
			break;

		case 'get':
			echo $questionsHelper->GetItem();
			break;

        case 'delete':
            echo $questionsHelper->DeleteItem();
            break;

        case 'sendQuestionMail':
            echo $questionsHelper->SendQuestionMail();
            break;
		default:
			# code...
			break;
	}
}
?>