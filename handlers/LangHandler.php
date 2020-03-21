<?php
require_once('../helpers/LangHelper.php');

if(isset($_POST['operation']))
{
	$langHelper = new LangHelper();
	switch ($_POST['operation']) {
		case 'getFile':
			echo $langHelper->getFile();
			break;
		case 'saveFile':
			echo $langHelper->saveFile();
			break;
        case 'changeLanguage':
			echo $langHelper->ChangeLanguage();
			break;
	}
}