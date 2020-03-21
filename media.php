<?php
require_once('helpers/LoadChunk.php');
require_once('helpers/PageLoadHelper.php');
require_once('helpers/AdminUsersHelper.php');

global $xpdo;

$montheventsTPL = '';
$eventWithImage = '';
$eventWithoutImage = '';

$langFile  = json_decode(file_get_contents('lang/media.json'), true);

// Head Chunk
$head        = new LoadChunk('head', 'front/master', array(
														   'pageTitle' => $langFile['pageTitle'][$lang],
														   'baseUrl'   => $server,
														   'ogImage'   => $ogImage,
														   'enLink'    => $enLink
														   ), '');
// Months Select
// $options        = new LoadChunk('option', 'front/media', array(), '');

$scripts        = new LoadChunk('scripts', 'front/media', array(), '');


$output = new LoadChunk('media', 'front/media', array(
											  		   'head'          => $head,
											  		   'header'        => $header,
											  		   'footer'        => $footer,
											  		   // 'options'       => $options,
											  		   'scripts'       => $scripts,
											  		   'headerTitle'   => $langFile['headerTitle'][$lang],
											  		   'all'           => $langFile['all'][$lang],
											  		   'images'        => $langFile['images'][$lang],
											  		   'videos'        => $langFile['videos'][$lang],
											  		   'mainImage'     => $mainImage->get('Media'),
											  		   
										           ), '');
$output = $urlHelper->changeToAlias($output);
echo $output;

