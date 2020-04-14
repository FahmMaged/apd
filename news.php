<?php
require_once('helpers/LoadChunk.php');
require_once('helpers/PageLoadHelper.php');
require_once('helpers/AdminUsersHelper.php');

global $xpdo;
$questionsTPL = '';

$langFile  = json_decode(file_get_contents('lang/news.json'), true);
// $langFile['readMore'][$lang]

// Head Chunk
$head        = new LoadChunk('head', 'front/master', array(
														   'pageTitle' => $langFile['pageTitle'][$lang],
														   'baseUrl'   => $server,
														   'ogImage'   => $ogImage,
														   'enLink'    => $enLink
														   ), '');

$scripts     = new LoadChunk('scripts', 'front/news', array(), '');

$output = new LoadChunk('news', 'front/news', array(
											  		   'head'               => $head,
											  		   'header'             => $header,
														 'footer'             => $footer,
														 'logged'             => $logged,
											  		   'scripts'            => $scripts,
											  		   'headerTitle'        => $langFile['headerTitle'][$lang],
											  		   'mainImage'          => $mainImage->get('News'),
											  		   
										           ), '');
$output = $urlHelper->changeToAlias($output);
echo $output;

