<?php
if (!isset($_SESSION)) {
    session_start();
}

if (file_exists('../config/config.php')) {
    require_once('../config/config.php');
} else {
    require_once('config/config.php');
}

require_once('UtilityHelper.php');
require_once('UploadsHelper.php');
require_once('LoadChunk.php');

class BaseHelper
{
    protected $table;
    protected $utility;
    public $timezone;

    public function __construct()
    {
        $this->utility  = new UtilityHelper();
        $this->timezone = new DateTimeZone('Africa/Cairo');
    }

    /**
     * @access public
     * @param  array  $file $_FILES['form_field']
     *    or   string $file Local filename
     * @param  string $directory Optional Upload directory
     */
    public function uploadFile($file, $directory = '/../uploads/', $x)
    {
        if (empty($file)) {
            return UtilityHelper::Response('error', 'Missing argument error. File is required.');
        }

        $timestamp = time();
        
        if (is_uploaded_file($file['tmp_name'])) {
            $handle = new upload($file);

            if ($handle->uploaded) {
                $handle->file_name_body_pre = $timestamp . '-';
                $handle->file_safe_name     = false;
                $handle->image_resize       = true;
                $handle->image_x            = $x;
                $handle->jpeg_quality       = 85;
                // $handle->file_max_size      = 100;
                $handle->allowed            = array('image/*' ,'application/pdf');
                $handle->image_ratio_y      = true;
                $handle->process(__DIR__ . $directory);

                if ($handle->processed) {
                    // Remove the leading slashes
                    $filePath = str_replace('/../', '', $directory);

                    return UtilityHelper::Response('success', $filePath . $handle->file_dst_name);
                } else {
                    return UtilityHelper::Response('error', $handle->error);
                }
            } else {
                return UtilityHelper::Response('error', 'File upload error. Try again.');
            }
        }
    }

    public function Server(){

		if ($_SERVER['HTTP_HOST'] != 'localhost') {
		$server        = $_SERVER['HTTP_HOST'];
		} else {
			$fullPath      = explode("\\", __DIR__);
			$mainDirectory = $fullPath[sizeof($fullPath) - 2];
			$server        = $_SERVER['HTTP_HOST'] . "/" . $mainDirectory;
		}
		return $server;
	}
}
