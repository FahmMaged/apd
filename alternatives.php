<?php
require_once('helpers/LoadChunk.php');
require_once('helpers/PageLoadHelper.php');
require_once('helpers/AdminUsersHelper.php');

global $xpdo;
$membersTPL   = '';
$memberTPL    = '';
$partenersTPL = '';
$partenerTPL  = '';

$langFile  = json_decode(file_get_contents('lang/alternatives.json'), true);
// $langFile['readMore'][$lang]

// Head Chunk
$head        = new LoadChunk('head', 'front/master', array(
														   'pageTitle' => $langFile['pageTitle'][$lang],
														   'baseUrl'   => $server,
														   'ogImage'   => $ogImage,
														   'enLink'    => $enLink
														   ), '');

$about = $xpdo->getObject('Alternatives', array('ID' => 1));
$output = new LoadChunk('alternatives', 'front/alternatives', array(
											  		   'head'               => $head,
											  		   'header'             => $header,
											  		   'mainImage'          => $mainImage->get('AboutUs'),
											  		   'firstTitle'         => $about->get('FirstTitle_'.$lang),
											  		   'secondTitle'        => $about->get('SecondTitle_'.$lang),
											  		   'thirdTitle'         => $about->get('ThirdTitle_'.$lang),
											  		   'fourthTitle'        => $about->get('FourthTitle_'.$lang),
											  		   'firstDescription'   => $about->get('FirstDescription_'.$lang),
											  		   'secondDescription'  => $about->get('SecondDescription_'.$lang),
											  		   'thirdDescription'   => $about->get('ThirdDescription_'.$lang),
											  		   'fourthDescription'  => $about->get('FourthDescription_'.$lang),
											  		   'firstImage'         => $about->get('FirstImage'),
											  		   'secondImage'        => $about->get('SecondImage'),
											  		   'footer'             => $footer,
											  		   'headerTitle'        => $langFile['headerTitle'][$lang],											  		   
										           ), '');
$output = $urlHelper->changeToAlias($output);
echo $output;

