<?php
require_once('helpers/LoadChunk.php');
require_once('helpers/PageLoadHelper.php');
require_once('helpers/AdminUsersHelper.php');

global $xpdo;
// $membersTPL   = '';
// $memberTPL    = '';
// $partenersTPL = '';
// $partenerTPL  = '';

$langFile  = json_decode(file_get_contents('lang/about.json'), true);
// $langFile['readMore'][$lang]

// Head Chunk
$head        = new LoadChunk('head', 'front/master', array(
														   'pageTitle' => $langFile['pageTitle'][$lang],
														   'baseUrl'   => $server,
														   'ogImage'   => $ogImage,
														   'enLink'    => $enLink
														   ), '');

// About Members
// $query = $xpdo->newQuery('AboutMembers');
// $query->sortby('Sort', 'ASC');
// $members = $xpdo->getCollection('AboutMembers', $query);
// foreach ($members as $m) {
// 		$memberTPL   .= new LoadChunk('member', 'front/about', array(
// 													   'title' => $m->get('Title_'.$lang)
// 													   ), '');
// }
// $membersTPL   .= new LoadChunk('members', 'front/about', array(
// 													   'memberTPL' => $memberTPL,
// 													   'members'   => $langFile['members'][$lang],
// 													   ), '');

// // About Parteners
// $query = $xpdo->newQuery('AboutPartners');
// $query->sortby('Sort', 'ASC');
// $parteners = $xpdo->getCollection('AboutPartners', $query);
// foreach ($parteners as $p) {
// 		$partenerTPL   .= new LoadChunk('partener', 'front/about', array(
// 													   'image' => $p->get('Image')
// 													   ), '');
// }
// $partenersTPL   .= new LoadChunk('parteners', 'front/about', array(
// 													   'partenerTPL' => $partenerTPL,
// 													   'parteners'  => $langFile['parteners'][$lang],
// 													   ), '');
$scripts = new LoadChunk('scripts', 'front/home', array(), '');
$about   = $xpdo->getObject('AboutUs', array('ID' => 1));
$output  = new LoadChunk('about', 'front/about', array(
											  		   'head'               => $head,
											  		   'header'             => $header,
											  		   'mainImage'          => $mainImage->get('AboutUs'),
											  		   'firstTitle'         => $about->get('FirstTitle_'.$lang),
											  		//    'secondTitle'        => $about->get('SecondTitle_'.$lang),
											  		//    'thirdTitle'         => $about->get('ThirdTitle_'.$lang),
											  		//    'fourthTitle'        => $about->get('FourthTitle_'.$lang),
											  		   'firstDescription'   => $about->get('FirstDescription_'.$lang),
											  		//    'secondDescription'  => $about->get('SecondDescription_'.$lang),
											  		//    'thirdDescription'   => $about->get('ThirdDescription_'.$lang),
											  		//    'fourthDescription'  => $about->get('FourthDescription_'.$lang),
											  		   'firstImage'         => $about->get('FirstImage'),
											  		//    'secondImage'        => $about->get('SecondImage'),
											  		//    'membersTPL'         => $membersTPL,
											  		//    'partenersTPL'       => $partenersTPL,
											  		   'footer'             => $footer,
											  		   'scripts'             => $scripts,
											  		   'headerTitle'        => $langFile['headerTitle'][$lang],
											  		//    'parteners'          => $langFile['parteners'][$lang]
											  		   
										           ), '');
$output = $urlHelper->changeToAlias($output);
echo $output;

