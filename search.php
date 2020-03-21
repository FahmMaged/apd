<?php
require_once('helpers/LoadChunk.php');
require_once('helpers/PageLoadHelper.php');
require_once('helpers/AdminUsersHelper.php');

global 	$xpdo;
		$itemsTPL = '';
		$val      = $_GET['val'];



// Head Chunk
$head        = new LoadChunk('head', 'front/master', array(
														   'pageTitle' => $val,
														   'baseUrl'   => $server,
														   'enLink'    => $enLink
														   ), '');

// Search Items
$items = $xpdo->query("SELECT ID As id, Title_en AS title_en, Alias_en AS alias_en, Alias_ar AS alias_ar, PublishDate AS publishDate, Title_ar AS title_ar, Image AS image, 'news' AS type  FROM News
 n WHERE n.Title_en LIKE '%$val%' OR n.Title_ar LIKE '%$val%' UNION ALL SELECT ID As id, Title_en AS title_en, Alias_en AS alias_en, Alias_ar AS alias_ar, PublishDate AS publishDate, Title_ar AS title_ar, Image AS image, 'event' AS type FROM Events
 e WHERE e.Title_en LIKE '%$val%' OR e.Title_ar LIKE '%$val%'");

$items = $items->fetchAll(PDO::FETCH_ASSOC);
foreach ($items as $i ){
	$link = '';
	if ($i['type'] == 'news') {
		$link = 'newsDetails.php?id='.$i['id'].'&alias='.$i['alias_'.$lang];
	} else{
		$link = 'eventsDetails.php?id='.$i['id'].'&alias='.$i['alias_'.$lang];
	}
	$itemsTPL .= new LoadChunk('item', 'front/search', array(
													   'image' => $i['image'],
													   'link'  => $link,
													   'title' => $i['title_'.$lang],
													   'date'  => $i['publishDate']),'');
}


$output = new LoadChunk('search', 'front/search', array(
											  		   'head'        => $head,
											  		   'header'      => $header,
											  		   'itemsTPL'    => $itemsTPL,
											  		   'footer'      => $footer,
											  		   'headerTitle' => $val,
											  		   'mainImage'   => $mainImage->get('Search'),
										           ), '');
$output = $urlHelper->changeToAlias($output);
echo $output;

