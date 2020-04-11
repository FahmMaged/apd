<?php
require_once('helpers/LoadChunk.php');
require_once('helpers/PageLoadHelper.php');
require_once('helpers/AdminUsersHelper.php');

global $xpdo;
$questionsTPL = '';

$langFile  = json_decode(file_get_contents('lang/books.json'), true);
// $langFile['readMore'][$lang]

// Head Chunk
$head        = new LoadChunk('head', 'front/master', array(
														   'pageTitle' => $langFile['pageTitle'][$lang],
														   'baseUrl'   => $server,
														   'ogImage'   => $ogImage,
														   'enLink'    => $enLink
														   ), '');

$scripts     = new LoadChunk('scripts', 'front/books', array(), '');

$output = new LoadChunk('books', 'front/books', array(
											  		   'head'               => $head,
											  		   'header'             => $header,
											  		   'footer'             => $footer,
											  		   'scripts'            => $scripts,
											  		   'headerTitle'        => $langFile['headerTitle'][$lang],
											  		   'borrow'             => $langFile['borrow'][$lang],
											  		   'firstName'          => $langFile['firstName'][$lang],
											  		   'lastName'           => $langFile['lastName'][$lang],
											  		   'email'              => $langFile['email'][$lang],
											  		   'phoneNumber'        => $langFile['phoneNumber'][$lang],
											  		   'message'            => $langFile['message'][$lang],
											  		   'send'               => $langFile['send'][$lang],
											  		   'mainImage'          => $mainImage->get('Books'),
											  		   
										           ), '');
$output = $urlHelper->changeToAlias($output);
echo $output;

