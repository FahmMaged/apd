<?php
require_once('helpers/LoadChunk.php');
require_once('helpers/PageLoadHelper.php');
require_once('helpers/AdminUsersHelper.php');

global $xpdo;
$questionsTPL = '';

$langFile  = json_decode(file_get_contents('lang/pdfs.json'), true);
// $langFile['readMore'][$lang]

// Head Chunk
$head        = new LoadChunk('head', 'front/master', array(
														   'pageTitle' => $langFile['pageTitle'][$lang],
														   'baseUrl'   => $server,
														   'ogImage'   => $ogImage,
														   'enLink'    => $enLink
														   ), '');

$scripts     = new LoadChunk('scripts', 'front/pdfs', array(), '');

$output = new LoadChunk('pdfs', 'front/pdfs', array(
											  		   'head'               => $head,
											  		   'header'             => $header,
											  		   'logged'             => $logged,
											  		   'footer'             => $footer,
											  		   'scripts'            => $scripts,
											  		   'pageTitle'          => $langFile['pageTitle'][$lang],
											  		   'mainImage'          => $mainImage->get('Books'),
											  		   
										           ), '');
$output = $urlHelper->changeToAlias($output);
echo $output;

