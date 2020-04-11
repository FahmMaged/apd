<?php
require_once('helpers/LoadChunk.php');
require_once('helpers/PageLoadHelper.php');
require_once('helpers/AdminUsersHelper.php');

global $xpdo;
$ourWorkItems = '';

$langFile  = json_decode(file_get_contents('lang/ourWork.json'), true);
// $langFile['readMore'][$lang]

// Head Chunk
$head        = new LoadChunk('head', 'front/master', array(
														   'pageTitle' => $langFile['pageTitle'][$lang],
														   'baseUrl'   => $server,
														   'ogImage'   => $ogImage,
														   'enLink'    => $enLink
														   ), '');

// OurWork
$x = 0;
$query = $xpdo->newQuery('OurWork');
$query->sortby('Sort', 'ASC');
$items = $xpdo->getCollection('OurWork', $query);
foreach ($items as $i) {
		$ourWorkItems   .= new LoadChunk('item', 'front/ourWork', array(
													   'title'        => $i->get('Title_'.$lang),
													   'image'        => $i->get('Image'),
													   'description'  => $i->get('Description_'.$lang),
													   ), '');
		
	
}


$output = new LoadChunk('ourWork', 'front/ourWork', array(
											  		   'head'               => $head,
											  		   'header'             => $header,
											  		   'ourWorkItems'       => $ourWorkItems,
											  		   'footer'             => $footer,
											  		   'headerTitle'        => $langFile['headerTitle'][$lang],
											  		   'mainImage'          => $mainImage->get('OurWork'),
											  		   
										           ), '');
$output = $urlHelper->changeToAlias($output);
echo $output;

