<?php
require_once('helpers/LoadChunk.php');
require_once('helpers/PageLoadHelper.php');
require_once('helpers/AdminUsersHelper.php');

global $xpdo;
$newsTPL = '';
$id      = $_GET['id'];

$langFile  = json_decode(file_get_contents('lang/events.json'), true);
// $langFile['readMore'][$lang]

$event = $xpdo->getObject('Events', array('ID' => $id));
$location = $xpdo->getObject('EventsLocations', array('ID' => $event->get('LocationID')));
// Head Chunk
$head        = new LoadChunk('head', 'front/master', array(
														   'pageTitle' => $event->get('Title_'.$lang),
														   'baseUrl'   => $server,
														   'ogImage'   => $ogImage,
														   'enLink'    => $enLink
														   ), '');


$output = new LoadChunk('eventDetails', 'front/events', array(
											  		   'head'        => $head,
											  		   'header'      => $header,
											  		   'lang'        => $lang,
											  		   'title'       => $event->get('Title_'.$lang),
											  		   'location'    => $location->get('Title_'.$lang),
													   'description' => $event->get('Description_'.$lang),
													   'image'       => $event->get('Image'),
													   'publishDate' => $event->get('PublishDate'),
													   'start'       => $event->get('StartTime'),
													   'end'         => $event->get('EndTime'),
											  		   'footer'      => $footer,
											  		   'headerTitle' => $langFile['headerTitle'][$lang],
											  		   'details'     => $langFile['details'][$lang],
											  		   'mainImage'   => $mainImage->get('Events'),
										           ), '');
$output = $urlHelper->changeToAlias($output);
echo $output;

