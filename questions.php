<?php
require_once('helpers/LoadChunk.php');
require_once('helpers/PageLoadHelper.php');
require_once('helpers/AdminUsersHelper.php');

global $xpdo;
$questionsTPL = '';

$langFile  = json_decode(file_get_contents('lang/questions.json'), true);
// $langFile['readMore'][$lang]

// Head Chunk
$head        = new LoadChunk('head', 'front/master', array(
														   'pageTitle' => $langFile['pageTitle'][$lang],
														   'baseUrl'   => $server,
														   'ogImage'   => $ogImage,
														   'enLink'    => $enLink
														   ), '');

// Questions
$x = 0;
$query = $xpdo->newQuery('Questions');
$query->sortby('Sort', 'ASC');
$questions = $xpdo->getCollection('Questions', $query);
foreach ($questions as $q) {
	if ($x == 0) {
		$active = 'active';
		$questionsTPL   .= new LoadChunk('question', 'front/questions', array(
													   'active'       => $active,
													   'title'        => $q->get('Title_'.$lang),
													   'description'  => $q->get('Description_'.$lang),
													   ), '');
		$x++;
	} else {
		$active = '';
		$questionsTPL   .= new LoadChunk('question', 'front/questions', array(
													   'active'       => $active,
													   'title'        => $q->get('Title_'.$lang),
													   'description'  => $q->get('Description_'.$lang),
													   ), '');
	}
	
}


$output = new LoadChunk('questions', 'front/questions', array(
											  		   'head'               => $head,
											  		   'header'             => $header,
											  		   'questionsTPL'       => $questionsTPL,
											  		   'footer'             => $footer,
											  		   'headerTitle'        => $langFile['headerTitle'][$lang],
											  		   'forMore'            => $langFile['forMore'][$lang],
											  		   'firstName'          => $langFile['firstName'][$lang],
											  		   'lastName'           => $langFile['lastName'][$lang],
											  		   'email'              => $langFile['email'][$lang],
											  		   'phoneNumber'        => $langFile['phoneNumber'][$lang],
											  		   'message'            => $langFile['message'][$lang],
											  		   'send'               => $langFile['send'][$lang],
											  		   'mainImage'          => $mainImage->get('Questions'),
											  		   
										           ), '');
$output = $urlHelper->changeToAlias($output);
echo $output;

