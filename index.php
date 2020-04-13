<?php
require_once('helpers/LoadChunk.php');
require_once('helpers/PageLoadHelper.php');
require_once('helpers/AdminUsersHelper.php');

global $xpdo;

date_default_timezone_set('Africa/Cairo');

$langFile  = json_decode(file_get_contents('lang/home.json'), true);
// $langFile['readMore'][$lang]

$sliderVideosTpl = '';
$videoSectionTpl    = '';
// Head Chunk
$head        = new LoadChunk('head', 'front/master', array(
														   'baseUrl'   => $server,
														   'pageTitle' => 'Home',
														   'ogImage'   => $ogImage,
														   'enLink'    => $enLink
														   ), '');

$scripts        = new LoadChunk('scripts', 'front/home', array(), '');

$output = new LoadChunk('home', 'front/home', array(
											  		   'head'               => $head,
													   'header'             => $header,
													   'scripts'            => $scripts,
											  		   'footer'             => $footer,
										           ), '');
$output = $urlHelper->changeToAlias($output);
echo $output;

