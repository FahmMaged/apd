<?php

if (!isset($_SESSION)) session_start();

require_once('AdminUsersHelper.php');

class LangHelper
{
	public function getFile()
	{
		if (isset($_POST['file'])) {
			$file = '../lang/' . $_POST['file'];
			$data = file_get_contents($file);
			return $data;
		}
	}

	public function saveFile()
	{
		if (isset($_POST['fileName'])) {
			$fileName = '../lang/' . $_POST['fileName'];
			$data     = json_encode($_POST['data']);
			file_put_contents($fileName, $data);
			return 1;
		}
	}

    public function ChangeLanguage()
    {
		 $lang = ( isset( $_POST['lang'] ) ) ? $_POST['lang'] : 'en' ;
		//  echo($_POST['lang']);
		//  exit;
		$pageUrl = strtolower( $_POST['currentURL'] );
		$_SESSION['lang'] = $lang;
		if ( $lang == "en" ) {
			$pageUrl = str_replace('/en/', '/ar/', $pageUrl);
			$pageUrl = str_replace('lang=en', 'lang=ar', $pageUrl);
			$lang = "ar";
		} else {
			$pageUrl = str_replace('/ar/', '/en/', $pageUrl);
			$pageUrl = str_replace('lang=ar', 'lang=en', $pageUrl);
			$lang = "en";
		}

		return $pageUrl;
    }
}
