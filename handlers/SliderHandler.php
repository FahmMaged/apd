<?php
require_once('../helpers/SliderHelper.php');

if(isset($_POST['operation']))
{
	$sliderHelper = new SliderHelper();
	switch ($_POST['operation']) {
		case 'add':
			echo $sliderHelper->AddItem();
			break;

		case 'addVideo':
			echo $sliderHelper->AddVideo();
			break;

		case 'getAll':
			echo $sliderHelper->GetItems();
			break;

		case 'getAllVideos':
			echo $sliderHelper->GetVideos();
			break;

		case 'edit':
			echo $sliderHelper->EditItem();
			break;

		case 'editVideo':
			echo $sliderHelper->EditVideo();
			break;

		case 'get':
			echo $sliderHelper->GetItem();
			break;
		case 'getVideo':
			echo $sliderHelper->GetVideo();
			break;

        case 'delete':
            echo $sliderHelper->DeleteItem();
            break;

        case 'deleteVideo':
            echo $sliderHelper->DeleteVideo();
            break;
		default:
			# code...
			break;
	}
}
?>