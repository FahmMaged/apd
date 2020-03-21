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

// Arabic months
$months = array(
	"January"   => "يناير",
	"February"  => "فبراير",
	"March"     => "مارس",
	"April"     => "أبريل",
	"May"       => "مايو",
	"June"      => "يونيو",
	"July"      => "يوليو",
	"August"    => "أغسطس",
	"September" => "سبتمبر",
	"October"   => "أكتوبر",
	"November"  => "نوفمبر",
	"December"  => "ديسمبر"
  );
  // Months Select
  $optins = "";
  $i = 1;
  foreach ($months as $en => $ar) {
  if ($lang == 'ar') {
		$month = $ar;
  } else{
   		$month = $en;
  }
  $options        .= new LoadChunk('option', 'front/events', array("i" => $i++, "month" => $month), '');
}

$scripts        = new LoadChunk('scripts', 'front/events', array(), '');


$output = new LoadChunk('events', 'front/events', array(
											  		   'head'               => $head,
											  		   'header'             => $header,
											  		   'montheventsTPL'     => $montheventsTPL,
											  		   'footer'             => $footer,
											  		   'options'            => $options,
											  		   'scripts'            => $scripts,
											  		   'headerTitle'        => $langFile['headerTitle'][$lang],
											  		   'dateText'           => $langFile['dateText'][$lang],
											  		   'timeText'           => $langFile['timeText'][$lang],
											  		   'locationText'       => $langFile['locationText'][$lang],
											  		   'filter'             => $langFile['filter'][$lang],
											  		   'mainImage'          => $mainImage->get('Events'),
											  		   
										           ), '');
$output = $urlHelper->changeToAlias($output);
echo $output;

