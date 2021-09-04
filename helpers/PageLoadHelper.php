<?php
require_once('helpers/LoadChunk.php');
require_once('helpers/AdminUsersHelper.php');
require_once('helpers/URLHelper.php');
require_once('helpers/MembersHelper.php');

if (MembersHelper::IsLoggedIn())
{
	$logged = 1;
	$hideLogin = 'hidden';
	$hideLogout = '';
} else{
	$logged = 0;
	$hideLogin = '';
	$hideLogout = 'hidden';
}

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
	$enLink = '<link rel="stylesheet" href="scss/style-en.css" />';
}

// Get locations
$locationsTPL = '';
$locations = $xpdo->getCollection('EventsLocations');
foreach($locations as $loc){
	$locationsTPL   .= new LoadChunk('option', 'front/master', array(
		'id'    => $loc->get('ID'),
		'name'  => $loc->get('Title_'.$lang),
		), '');
}

// Get countries
$countriesTPL = '';
$countries = $xpdo->getCollection('Countries');
foreach($countries as $loc){
	$countriesTPL   .= new LoadChunk('option2', 'front/master', array(
		'id'    => $loc->get('ID'),
		'name'  => $loc->get('Title_'.$lang),
		), '');
}

// Get categories
$categoriesTPL = '';
$categories = $xpdo->getCollection('MemberCategories');
foreach($categories as $cat){
	$categoriesTPL   .= new LoadChunk('option2', 'front/master', array(
		'id'    => $cat->get('ID'),
		'name'  => $cat->get('Title_'.$lang),
		), '');
}

// get dynamic basr url
if ($_SERVER['HTTP_HOST'] != 'localhost') {
	$server        = $_SERVER['HTTP_HOST'];
} else {
	$fullPath      = explode("\\", __DIR__);
	$mainDirectory = $fullPath[sizeof($fullPath) - 2];
	$server        = $_SERVER['HTTP_HOST'] . "/" . $mainDirectory;

}

$defaultTitle = "APD";

// Default OG Image
$ogImage = 'images/headerLogo.png';
// $head        = new LoadChunk('head', 'front/master', array('baseUrl' => $server,), '');


$langFile  = json_decode(file_get_contents('lang/main.json'), true);
$langFile2 = json_decode(file_get_contents('lang/headForms.json'), true);
$langFileSubscribe = json_decode(file_get_contents('lang/subscribe.json'), true);
$noData    = $langFile['noData'][$lang];
$header      = new LoadChunk('header', 'front/master', array(
												'lang'      => $lang,
												'hideLogin'    => $hideLogin,
												'hideLogout'   => $hideLogout,
												'locationsTPL' => $locationsTPL,
												'countriesTPL' => $countriesTPL,
												'categoriesTPL' => $categoriesTPL,
												'home'      => $langFile['home'][$lang],
												'aboutUs'   => $langFile['aboutUs'][$lang],
												'page1'     => $langFile['page1'][$lang],
												'page2'     => $langFile['page2'][$lang],
												'page3'     => $langFile['page3'][$lang],
												'resources' => $langFile['resources'][$lang],
												'articles'  => $langFile['articles'][$lang],
												'pdfs'      => $langFile['pdfs'][$lang],
												'trainers'  => $langFile['trainers'][$lang],
												'services'  => $langFile['services'][$lang],
												'events'    => $langFile['events'][$lang],
												'register'  => $langFile['register'][$lang],
												'logout'    => $langFile['logout'][$lang],
												'phone'     => $langFile['phone'][$lang],
												'videos'    => $langFile['videos'][$lang],
												'email'     => $langFile['email'][$lang],
												'register'  => $langFile2['register'][$lang],
												'login'     => $langFile2['login'][$lang],
												'category'  => $langFile2['category'][$lang],
												'contactUs' => $langFile['contactUs'][$lang],
												'emailText' => $langFile2['email'][$lang],
												'phoneNumber' => $langFile2['phoneNumber'][$lang],
												'loginButton' => $langFile2['loginButton'][$lang],
												'firstName'   => $langFile2['firstName'][$lang],
												'lastName'    => $langFile2['lastName'][$lang],
												'bio'         => $langFile2['bio'][$lang],
												'password'    => $langFile2['password'][$lang],
												'confirmPassword' => $langFile2['confirmPassword'][$lang],
												'image'   => $langFile2['image'][$lang],
												'upload'  => $langFile2['upload'][$lang],
												'country' => $langFile2['country'][$lang],
												'city'    => $langFile2['city'][$lang],
												'FacebookLink'  => $langFile2['FacebookLink'][$lang],
												'clickHere'     => $langFile2['clickHere'][$lang],
												'advantage'     => $langFile2['advantage'][$lang],
												'join'          => $langFile2['join'][$lang],
												'position'      => $langFile2['position'][$lang],
												'degree'        => $langFile2['degree'][$lang],
												'FacebookLink'  => $langFile2['FacebookLink'][$lang],
												'TwitterLink'   => $langFile2['TwitterLink'][$lang],
												'InstagramLink' => $langFile2['InstagramLink'][$lang],
												'LinkedinLink'  => $langFile2['LinkedinLink'][$lang],
												), '');

$footer      = new LoadChunk('footer', 'front/master', array(
												'lang'      => $lang,
												'home'      => $langFile['home'][$lang],
												'aboutUs'   => $langFile['aboutUs'][$lang],
												'resources' => $langFile['resources'][$lang],
												'articles'  => $langFile['articles'][$lang],
												'pdfs'      => $langFile['pdfs'][$lang],
												'trainers'  => $langFile['trainers'][$lang],
												'services'  => $langFile['services'][$lang],
												'events'    => $langFile['events'][$lang],
												'register'  => $langFile['register'][$lang],
												'phone'     => $langFile['phone'][$lang],
												'phoneText' => $langFile['phoneText'][$lang],
												'address'   => $langFile['address'][$lang],
												'videos'    => $langFile['videos'][$lang],
												'email'     => $langFile['email'][$lang],
												'emailText' => $langFile2['email'][$lang],
												'contactUs' => $langFile['contactUs'][$lang],
												'links'     => $langFile['links'][$lang],
												'follow'    => $langFile['follow'][$lang],
												'theAddress' => $langFile['theAddress'][$lang],
												'aboutFooter' => $langFile['aboutFooter'][$lang],
												'subscribeTitle' => $langFileSubscribe['title'][$lang],
												'subscribeDesc'  => $langFileSubscribe['description'][$lang],
												'subscribeEmail' => $langFileSubscribe['email'][$lang],
												'subscribe'      => $langFileSubscribe['subscribe'][$lang],
												'subscribeNow'   => $langFileSubscribe['subscribeNow'][$lang],
	), '');




?>