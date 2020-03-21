<?php

require_once(__DIR__ . '/../xpdo/xpdo.class.php');
require_once(__DIR__ . '/../config/DBConfig.php');

if (!isset($xpdo))
{
	$xpdo = new xPDO('mysql:host=' . DBConfig::DB_HOST . ';dbname=' . DBConfig::DB_NAME . ';charset=utf8', DBConfig::DB_USER , DBConfig::DB_PASS, '');

    $xpdo->connect();

    if (!$xpdo->addPackage('nccpim', __DIR__ . '/../models/nccpim/model/', ''))
    	exit();
}
