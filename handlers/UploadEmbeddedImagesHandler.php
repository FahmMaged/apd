<?php
require_once('../helpers/UtilityHelper.php');
require_once('../helpers/UploadsHelper.php');

$utility = new UtilityHelper();
reset ($_FILES);
$file = current($_FILES);
list($width, $height, $type, $attr) = getimagesize($file['tmp_name']);

if (isset($file['tmp_name']) && $file['size'] > 0) {
    $timestamp = time();

    if (is_uploaded_file($file['tmp_name'])) {
        $handle = new upload($file);
        
        if ($handle->uploaded) {
            $handle->file_name_body_pre   = $timestamp .'-';
            $handle->file_safe_name = true;
            $handle->image_resize         = true;
            $handle->image_x = $width;
            $handle->image_ratio_y  = true;
            $handle->process(__DIR__.'/../uploads/embed/');

            if ($handle->processed) {
                $response['res'] = '../uploads/embed/' . $handle->file_dst_name;

                echo json_encode(array('link' => $response['res']));
            } else {
	            echo json_encode(array('error' => 'Something went wrong while uploading this image'));
	        }
	    }
    }
}
