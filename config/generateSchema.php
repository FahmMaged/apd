<?php

require_once(__DIR__ . '/../xpdo/xpdo.class.php');
require_once(__DIR__ . '/../config/DBConfig.php');

$xpdo      = new xPDO('mysql:host=' . DBConfig::DB_HOST . ';dbname=' . DBConfig::DB_NAME . ';charset=utf8', DBConfig::DB_USER , DBConfig::DB_PASS, '');

$manager   = $xpdo->getManager();
$generator = $manager->getGenerator();

$xml       = $generator->writeSchema(__DIR__ . '/../models/nccpim/nccpim.schema.xml', 'nccpim', 'xPDOObject', '');

echo $generator->parseSchema(__DIR__ . '/../models/nccpim/nccpim.schema.xml', __DIR__ . '/../models/nccpim/model/');