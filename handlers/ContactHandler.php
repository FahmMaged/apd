<?php
require_once('../helpers/ContactHelper.php');

if (isset($_POST['operation'])) {
    $contactHelper = new ContactHelper();
    switch ($_POST['operation']) {
        case 'sendContactMail':
            echo $contactHelper->AddSubmission();
            break;

        case 'getAll':
            echo $contactHelper->GetAll();
            break;
		case 'delete':
			echo $contactHelper->DeleteSubmission();
		break;

        case 'sendBooksMail':
            echo $contactHelper->AddBookSubmission();
            break;

        case 'getAllBooksSubmissions':
            echo $contactHelper->GetAllBooksSubmissions();
            break;
        case 'deleteBookSubmission':
            echo $contactHelper->DeleteBookSubmission();
        break;
    }
}
