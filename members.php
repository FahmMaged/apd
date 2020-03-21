<?php
require_once('helpers/LoadChunk.php');
require_once('helpers/PageLoadHelper.php');
require_once('helpers/AdminUsersHelper.php');

global $xpdo;
$fMemberTPL = '';
$memberTPL   = '';
$membersTPL  = '';

$langFile  = json_decode(file_get_contents('lang/members.json'), true);
// $langFile['readMore'][$lang]

// Head Chunk
$head        = new LoadChunk('head', 'front/master', array(
														   'pageTitle' => $langFile['pageTitle'][$lang],
														   'baseUrl'   => $server,
														   'ogImage'   => $ogImage,
														   'enLink'    => $enLink
														   ), '');

// Members
$x = 0;
$query = $xpdo->newQuery('Members');
$query->sortby('Sort', 'ASC');
$members = $xpdo->getCollection('Members', $query);
foreach ($members as $m) {
	if ($x == 0) {
		$fMemberTPL   .= new LoadChunk('fMember', 'front/members', array(
													   'name'         => $m->get('Title_'.$lang),
													   'jobTitle'     => $m->get('JobTitle_'.$lang),
													   'ambassador'   => $langFile['ambassador'][$lang],
													   'description'  => $m->get('Description_'.$lang),
													   'image'        => $m->get('Image')
													   ), '');
		$x++;
	} else {
		$active = '';
		$memberTPL   .= new LoadChunk('member', 'front/members', array(
													   'jobTitle'     => $m->get('JobTitle_'.$lang),
													   'name'         => $m->get('Title_'.$lang),
													   'description'  => $m->get('Description_'.$lang),
													   'image'        => $m->get('Image')
													   ), '');
	}
	
}


$output = new LoadChunk('members', 'front/members', array(
											  		   'head'               => $head,
											  		   'header'             => $header,
											  		   'fMemberTPL'        => $fMemberTPL,
													   'memberTPL'          => $memberTPL,
											  		   'footer'             => $footer,
											  		   'headerTitle'        => $langFile['headerTitle'][$lang],
											  		   'membersText'        => $langFile['membersText'][$lang],
											  		   'mainImage'          => $mainImage->get('Members'),
											  		   
										           ), '');
$output = $urlHelper->changeToAlias($output);
echo $output;

