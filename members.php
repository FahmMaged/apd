<?php
require_once('helpers/LoadChunk.php');
require_once('helpers/PageLoadHelper.php');
require_once('helpers/AdminUsersHelper.php');

global $xpdo;
$fMemberTPL = '';
$memberTPL   = '';
$membersTPL  = '';

$langFile  = json_decode(file_get_contents('lang/members.json'), true);
$langFile2  = json_decode(file_get_contents('lang/headForms.json'), true);
// $langFile['readMore'][$lang]

// Head Chunk
$head        = new LoadChunk('head', 'front/master', array(
														   'pageTitle' => $langFile['pageTitle'][$lang],
														   'baseUrl'   => $server,
														   'ogImage'   => $ogImage,
														   'enLink'    => $enLink
														   ), '');

$scripts     = new LoadChunk('scripts', 'front/members', array(), '');
$output = new LoadChunk('members', 'front/members', array(
											  		   'head'               => $head,
											  		   'header'             => $header,
													    'footer'            => $footer,
													   'scripts'            => $scripts,
													   'locationsTPL'       => $locationsTPL,
													   'countriesTPL'       => $countriesTPL,
													   'categoriesTPL'      => $categoriesTPL,
													   'country'            => $langFile2['country'][$lang],
													   'city'               => $langFile2['city'][$lang],
													   'category'           => $langFile2['category'][$lang],
											  		   'headerTitle'        => $langFile['headerTitle'][$lang],
											  		   'search'             => $langFile['search'][$lang],
											  		   'mainImage'          => $mainImage->get('Members'),
											  		   
										           ), '');
$output = $urlHelper->changeToAlias($output);
echo $output;

