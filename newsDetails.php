<?php
require_once('helpers/LoadChunk.php');
require_once('helpers/PageLoadHelper.php');
require_once('helpers/AdminUsersHelper.php');

global $xpdo;
$newsTPL = '';
$id      = $_GET['id'];

$langFile  = json_decode(file_get_contents('lang/news.json'), true);
// $langFile['readMore'][$lang]

$news = $xpdo->getObject('News', array('ID' => $id));
// Head Chunk
$head        = new LoadChunk('head', 'front/master', array(
														   'pageTitle' => $news->get('Title_'.$lang),
														   'baseUrl'   => $server,
														   'ogImage'   => $ogImage,
														   'enLink'    => $enLink
														   ), '');


$output = new LoadChunk('newsDetails', 'front/news', array(
											  		   'head'        => $head,
											  		   'header'      => $header,
											  		   'title'       => $news->get('Title_'.$lang),
													   'description' => $news->get('Description_'.$lang),
													   'image'       => $news->get('Image'),
													   'publishDate' => $news->get('PublishDate'),
											  		   'footer'      => $footer,
											  		   'headerTitle' => $langFile['headerTitle'][$lang],
											  		   'mainImage'   => $mainImage->get('News'),
										           ), '');
$output = $urlHelper->changeToAlias($output);
echo $output;

