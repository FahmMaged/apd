<?php
require_once('../helpers/BooksHelper.php');

if (isset($_POST['operation'])) {
    $bookHelper = new BooksHelper();
    switch ($_POST['operation']) {
        case 'addBook':
            echo $bookHelper->AddBook();
            break;
        case 'editBook':
            echo $bookHelper->EditBook();
            break;
        case 'getBook':
            echo $bookHelper->GetBook();
            break;
        case 'getAllBooks':
            echo $bookHelper->GetAllBooks();
            break;
        case 'deleteBook':
            echo $bookHelper->DeleteBook();
            break;
        case 'upload':
            echo $bookHelper->Upload();
            break;

        case 'getAllBooksFront':
            echo $bookHelper->GetAllBooksFront();
            break;      
        default:
            # code...
            break;
    }
}