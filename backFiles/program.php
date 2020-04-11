<?php
require_once('helpers/LoadChunk.php');
require_once('helpers/PageLoadHelper.php');
require_once('helpers/AdminUsersHelper.php');

global $xpdo;
$programTPL = '';
$id      = 1;

$langFile  = json_decode(file_get_contents('lang/program.json'), true);
// $langFile['readMore'][$lang]

$program = $xpdo->getObject('YourProject', array('ID' => $id));
// Head Chunk
$head        = new LoadChunk('head', 'front/master', array(
														   'pageTitle' => $langFile['pageTitle'][$lang],
														   'baseUrl'   => $server,
														   'ogImage'   => $ogImage,
														   'enLink'    => $enLink
														   ), '');


$output = new LoadChunk('program', 'front/alternatives', array(
											  		   'head'        => $head,
                                                       'header'      => $header,
                                                       'mainImage'   => $mainImage->get('AboutUs'),
											  		   'title'       => $program->get('SecondTitle_'.$lang),
													   'description' => $program->get('SecondDescription_'.$lang),
													   'image'       => $program->get('SecondImage'),
											  		   'footer'      => $footer,
											  		   'headerTitle' => $langFile['headerTitle'][$lang],
										           ), '');
$output = $urlHelper->changeToAlias($output);
echo $output;

