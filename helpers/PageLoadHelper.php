<?php
require_once('helpers/LoadChunk.php');
require_once('helpers/AdminUsersHelper.php');
require_once('helpers/URLHelper.php');

$urlHelper    = new URLHelper();
// Get Main Images
$mainImage = $xpdo->getObject('MainImages', array('ID' => 1));
//Language Session
if(!isset($_COOKIE['lang'])) {
    $lang = (isset($_GET['lang'])) ? $_GET['lang'] : 'ar' ;
    setcookie('lang', $lang, time() + (86400 * 30 * 30), "/");
} else {
    $langCookie = $_COOKIE['lang'];
    $lang = (isset($_GET['lang'])) ? $_GET['lang'] : 'ar' ;
}
$_SESSION['lang'] = $lang;

$enLink = '';
if ($lang == 'en') {
	$enLink = '<link type="text/css" rel="stylesheet" href="css/en.css" media="screen,projection" />';
}

// get dynamic basr url
if ($_SERVER['HTTP_HOST'] != 'localhost') {
	$server        = $_SERVER['HTTP_HOST'];
} else {
	$fullPath      = explode("\\", __DIR__);
	$mainDirectory = $fullPath[sizeof($fullPath) - 2];
	$server        = $_SERVER['HTTP_HOST'] . "/" . $mainDirectory;

}

$defaultTitle = "NCCPIM";

// Default OG Image
$ogImage = 'images/headerLogo.png';
// $head        = new LoadChunk('head', 'front/master', array('baseUrl' => $server,), '');


$langFile  = json_decode(file_get_contents('lang/main.json'), true);
$langFile2 = json_decode(file_get_contents('lang/contactUs.json'), true);
$noData    = $langFile['noData'][$lang];
$header      = new LoadChunk('header', 'front/master', array(
												'lang'      => $lang,
												'home'      => $langFile['home'][$lang],
												'aboutUs'   => $langFile['aboutUs'][$lang],
												'stuff'     => $langFile['stuff'][$lang],
												'members'   => $langFile['members'][$lang],
												'media'     => $langFile['media'][$lang],
												'books'     => $langFile['books'][$lang],
												'news'      => $langFile['news'][$lang],
												'events'    => $langFile['events'][$lang],
												'strategies'  => $langFile['strategies'][$lang],
												'alternatives' => $langFile['alternatives'][$lang],
												'videosAndImages' => $langFile['videosAndImages'][$lang],
												'awarness'  => $langFile['awarness'][$lang],
												'ourWork'   => $langFile['ourWork'][$lang],
												'questions' => $langFile['questions'][$lang],
												'contactUs' => $langFile['contactUs'][$lang],
												'boss'      => $langFile['boss'][$lang],
												'mission'   => $langFile['mission'][$lang],
												'vision'    => $langFile['vision'][$lang],
												'keep'      => $langFile['keep'][$lang],
												'abilities' => $langFile['abilities'][$lang],
												'activities'=> $langFile['activities'][$lang],
												'legislative' => $langFile['legislative'][$lang],
												'cooperation' => $langFile['cooperation'][$lang],
												'protection'  => $langFile['protection'][$lang],
												), '');

$footer      = new LoadChunk('footer', 'front/master', array(
												'lang'      => $lang,
												'home'      => $langFile['home'][$lang],
												'aboutUs'   => $langFile['aboutUs'][$lang],
												'members'   => $langFile['members'][$lang],
												'media'     => $langFile['media'][$lang],
												'books'     => $langFile['books'][$lang],
												'news'      => $langFile['news'][$lang],
												'events'    => $langFile['events'][$lang],
												'awarness'  => $langFile['awarness'][$lang],
												'ourWork'   => $langFile['ourWork'][$lang],
												'questions' => $langFile['questions'][$lang],
												'contactUs' => $langFile['contactUs'][$lang],
												'links'     => $langFile['links'][$lang],
												'theAddress' => $langFile2['theAddress'][$lang],
												'aboutFooter' => $langFile['aboutFooter'][$lang],
	), '');




?>