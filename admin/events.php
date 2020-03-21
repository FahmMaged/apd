<?php

require_once('../helpers/AdminUsersHelper.php');

if (!AdminUsersHelper::IsLoggedIn())
{
	UtilityHelper::RedirectTo('login.php');
}

$adminName = $_SESSION['AdminUser']['FirstName'];

$itemsTpl = '';
global $xpdo;
$query = $xpdo->newQuery('EventsLocations');
$query->sortby('Sort', 'ASC');
$locations = $xpdo->getCollection('EventsLocations', $query);
foreach ($locations as $location) {
	$itemsTpl .= new LoadChunk('option', 'admin/events', array(
												'id'   => $location->get('ID'),
												'name' => $location->get('Title_en'),
												), '../');
}

$select = new LoadChunk('selectOptions', 'admin/events', array(
												'options' => $itemsTpl,
												), '../');

$editSelect = new LoadChunk('editSelectOptions', 'admin/events', array(
												'options' => $itemsTpl,
												), '../');

$head    = new LoadChunk('head', 'admin/master', array(), '../');

$header  = new LoadChunk('header', 'admin/master', array(), '../');

$sidebar = new LoadChunk('sidebar', 'admin/master', array('name' => $adminName), '../');



$content = new LoadChunk('events', 'admin/events', array('select'     => $select,
														 'editSelect' => $editSelect), '../');

$extraScripts 	= new LoadChunk('scripts', 'admin/events',array(),'../');

$footer  = new LoadChunk('footer', 'admin/master', array('extraScripts' => $extraScripts), '../');

$output  = new LoadChunk('template', 'admin', array(
                                            'head'    => $head,
                                            'header'  => $header,
                                            'sidebar' => $sidebar,
                                            'content' => $content,
                                            'footer'  => $footer
                                        ), '../');

echo $output;