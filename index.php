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

// Slider Videos
$sliderVideosTpl = '';
$query = $xpdo->newQuery('SliderVideos');
$query->sortby('Sort', 'ASC');
$sliderVideos = $xpdo->getCollection('SliderVideos', $query);
foreach ($sliderVideos as $sliderVideo) {
	$sliderVideosTpl  .= new LoadChunk('sliderVideo', 'front/home', array(
																	'link' => $sliderVideo->get('Link')
																), '');
}
$sliderVideoTpl  = new LoadChunk('videosSlider', 'front/home', array('sliderVideosTpl' => $sliderVideosTpl), '');


// Video Section
$video = $xpdo->getObject('Home', array('ID' => 1));
$videoSectionTpl  = new LoadChunk('video', 'front/home', array(
															'title' => $video->get('Title_'.$lang),
															'description'  => $video->get('Description_'.$lang),
															'link'=> $video->get('Link'),
															'views'=> $video->get('NumberOfViews'),
															'videos'             => $langFile['videos'][$lang],
															'view'               => $langFile['view'][$lang]
															), '');

$scripts        = new LoadChunk('scripts', 'front/home', array(), '');

$output = new LoadChunk('home', 'front/home', array(
											  		   'head'               => $head,
													   'header'             => $header,
													   'sliderVideoTpl'     => $sliderVideoTpl,
													   'videoSectionTpl'    => $videoSectionTpl,
													   'scripts'            => $scripts,
											  		   'footer'             => $footer,
											  		   'facebook'           => $langFile['facebook'][$lang],
											  		   'twitter'            => $langFile['twitter'][$lang]
											  		   
										           ), '');
$output = $urlHelper->changeToAlias($output);
echo $output;

