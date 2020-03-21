<?php
require_once('helpers/LoadChunk.php');
require_once('helpers/PageLoadHelper.php');
require_once('helpers/AdminUsersHelper.php');

global $xpdo;
$ourWorkItems = '';

$langFile  = json_decode(file_get_contents('lang/contactUs.json'), true);
// $langFile['readMore'][$lang]

// Head Chunk
$head        = new LoadChunk('head', 'front/master', array(
														   'pageTitle' => $langFile['pageTitle'][$lang],
														   'baseUrl'   => $server,
														   'ogImage'   => $ogImage,
														   'enLink'    => $enLink
														   ), '');



$output = new LoadChunk('contactUs', 'front/contactUs', array(
											  		   'head'               => $head,
											  		   'header'             => $header,
											  		   'ourWorkItems'       => $ourWorkItems,
											  		   'footer'             => $footer,
											  		   'headerTitle'        => $langFile['headerTitle'][$lang],
											  		   'name'               => $langFile['name'][$lang],
											  		   'email'              => $langFile['email'][$lang],
											  		   'phoneNumber'        => $langFile['phoneNumber'][$lang],
											  		   'message'            => $langFile['message'][$lang],
											  		   'complaints'         => $langFile['complaints'][$lang],
											  		   'fax'                => $langFile['fax'][$lang],
											  		   'sendToUs'           => $langFile['sendToUs'][$lang],
											  		   'telephone'          => $langFile['telephone'][$lang],
											  		   'contact'            => $langFile['contact'][$lang],
											  		   'email'              => $langFile['email'][$lang],
											  		   'address'            => $langFile['address'][$lang],
											  		   'title2'             => $langFile['title2'][$lang],
											  		   'title1'             => $langFile['title1'][$lang],
											  		   'send'              => $langFile['send'][$lang],
											  		   'theAddress'        => $langFile['theAddress'][$lang],
											  		   'mainImage'          => $mainImage->get('ContactUs'),
											  		   
										           ), '');
$output = $urlHelper->changeToAlias($output);
echo $output;

