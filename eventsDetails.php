<?php
require_once('helpers/LoadChunk.php');
require_once('helpers/PageLoadHelper.php');
require_once('helpers/AdminUsersHelper.php');

global $xpdo;
$newsTPL = '';
$id      = $_GET['id'];
$baseHelper      = new BaseHelper();
// echo $id;
// exit;
$langFile  = json_decode(file_get_contents('lang/events.json'), true);
$langFile2  = json_decode(file_get_contents('lang/contactUs.json'), true);
// $langFile['readMore'][$lang]

$event = $xpdo->getObject('Events', array('ID' => $id));
// $location = $xpdo->getObject('EventsLocations', array('ID' => $event->get('LocationID')));
// Head Chunk
$head        = new LoadChunk('head', 'front/master', array(
														   'pageTitle' => $event->get('Title_'.$lang),
														   'baseUrl'   => $server,
														   'ogImage'   => $ogImage,
														   'enLink'    => $enLink
														   ), '');

$url = $baseHelper->Server()."/eventDetails.php?id=".$event->get('ID').'&alias='.$event->get('Alias_'.$lang);
$encodedUrl = urlencode($url);
$output = new LoadChunk('eventDetails', 'front/events', array(
											  		   'head'        => $head,
											  		   'header'      => $header,
											  		   'lang'        => $lang,
											  		   'title'       => $event->get('Title_'.$lang),
											  		//    'location'    => $location->get('Title_'.$lang),
													   'description' => $event->get('Description_'.$lang),
													   'image'       => $event->get('Image'),
													   'publishDate' => $event->get('PublishDate'),
													   'time'        => $event->get('Time_'.$lang),
													   'location'    => $event->get('Location_'.$lang),
											  		   'footer'      => $footer,
											  		   'url'         => $url,
											  		   'encodedUrl'  => $encodedUrl,
											  		   'headerTitle' => $langFile['headerTitle'][$lang],
											  		   'details'     => $langFile['details'][$lang],
											  		   'timeText'     => $langFile['timeText'][$lang],
											  		   'date'         => $langFile['date'][$lang],
											  		   'join'         => $langFile['join'][$lang],
											  		   'locationText' => $langFile['locationText'][$lang],
														'share'       => $langFile['share'][$lang],
														'name'        => $langFile2['name'][$lang],
														'email'       => $langFile2['email'][$lang],
														'phoneNumber' => $langFile2['phoneNumber'][$lang],
														'send'        => $langFile2['send'][$lang],
														'message'     => $langFile2['message'][$lang],
											  		   'mainImage'   => $mainImage->get('Events'),
										           ), '');
$output = $urlHelper->changeToAlias($output);
echo $output;

