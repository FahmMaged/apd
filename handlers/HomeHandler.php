<?php
require_once('../helpers/HomeHelper.php');

if (isset($_POST['operation'])) {
    $homeHelper = new HomeHelper();
    switch ($_POST['operation']) {
        case 'get':
            echo $homeHelper->Get();
            break;
        case 'edit':
            echo $homeHelper->Edit();
            break;
        case 'getSliderItems':
            echo $homeHelper->GetSliderItems();
            break;
        case 'getAboutSection':
            echo $homeHelper->GetAboutSection();
            break;
        case 'getNewsSection':
            echo $homeHelper->GetNewsSection();
            break;
        case 'getServicesSection':
            echo $homeHelper->GetServicesSection();
            break;
        case 'getTestimonialSection':
            echo $homeHelper->GetTestimonialSection();
            break;
        
        default:
            # code...
            break;
    }
}
