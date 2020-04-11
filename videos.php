<?php
require_once('helpers/LoadChunk.php');
require_once('helpers/PageLoadHelper.php');
require_once('helpers/AdminUsersHelper.php');

global $xpdo;
$questionsTPL = '';

$langFile  = json_decode(file_get_contents('lang/videos.json'), true);
// $langFile['readMore'][$lang]

// Head Chunk
$head        = new LoadChunk('head', 'front/master', array(
														   'pageTitle' => $langFile['pageTitle'][$lang],
														   'baseUrl'   => $server,
														   'ogImage'   => $ogImage,
														   'enLink'    => $enLink
														   ), '');

$scripts     = new LoadChunk('scripts', 'front/videos', array(), '');

$output = new LoadChunk('videos', 'front/videos', array(
											  		   'head'               => $head,
											  		   'header'             => $header,
											  		   'footer'             => $footer,
											  		   'scripts'            => $scripts,
											  		   'pageTitle'          => $langFile['pageTitle'][$lang],
											  		   'mainImage'          => $mainImage->get('Media'),
											  		   
										           ), '');
$output = $urlHelper->changeToAlias($output);
echo $output;

