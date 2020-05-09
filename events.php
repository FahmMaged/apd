<?php
require_once('helpers/LoadChunk.php');
require_once('helpers/PageLoadHelper.php');
require_once('helpers/AdminUsersHelper.php');

global $xpdo;

$montheventsTPL = '';
$eventWithImage = '';
$eventWithoutImage = '';

$langFile  = json_decode(file_get_contents('lang/events.json'), true);

// Head Chunk
$head        = new LoadChunk('head', 'front/master', array(
														   'pageTitle' => $langFile['pageTitle'][$lang],
														   'baseUrl'   => $server,
														   'ogImage'   => $ogImage,
														   'enLink'    => $enLink
														   ), '');

// Get Categories
$categoriesTPL = '';
$categories = $xpdo->getCollection('EventCategories');
foreach($categories as $cat){
	$categoriesTPL   .= new LoadChunk('option2', 'front/master', array(
		'id'    => $cat->get('ID'),
		'name'  => $cat->get('Title_'.$lang),
		), '');
}

$scripts        = new LoadChunk('scripts', 'front/events', array(), '');

if($logged == 1){
	$hideAdd = '';
} else{
	$hideAdd = 'hidden';
}
$output = new LoadChunk('events', 'front/events', array(
											  		   'head'               => $head,
											  		   'header'             => $header,
													   'footer'             => $footer,
													   'logged'             => $logged,
											  		   'scripts'            => $scripts,
											  		   'hideAdd'            => $hideAdd,
											  		   'categoriesTPL'      => $categoriesTPL,
											  		   'headerTitle'        => $langFile['headerTitle'][$lang],
											  		   'dateText'           => $langFile['dateText'][$lang],
											  		   'youCanAddEvent'     => $langFile['youCanAddEvent'][$lang],
											  		   'locationText'       => $langFile['locationText'][$lang],
											  		   'addEvent'           => $langFile['addEvent'][$lang],
													   'eventTitle'         => $langFile['eventTitle'][$lang],
											  		   'upload'             => $langFile['upload'][$lang],
											  		   'eventImage'         => $langFile['eventImage'][$lang],
											  		   'eventLocation'      => $langFile['eventLocation'][$lang],
											  		   'eventTime'          => $langFile['eventTime'][$lang],
											  		   'eventDetails'       => $langFile['eventDetails'][$lang],
											  		   'submit'             => $langFile['submit'][$lang],
											  		   'eventDate'          => $langFile['eventDate'][$lang],
											  		   'search'             => $langFile['search'][$lang],
											  		   'category'           => $langFile['category'][$lang],
											  		   'mainImage'          => $mainImage->get('Events'),
											  		   
										           ), '');
$output = $urlHelper->changeToAlias($output);
echo $output;

