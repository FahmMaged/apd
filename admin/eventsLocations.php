<?php

require_once('../helpers/AdminUsersHelper.php');

if (!AdminUsersHelper::IsLoggedIn())
{
	UtilityHelper::RedirectTo('login.php');
}

$adminName = $_SESSION['AdminUser']['FirstName'];

$head    = new LoadChunk('head', 'admin/master', array(), '../');

$header  = new LoadChunk('header', 'admin/master', array(), '../');

$sidebar = new LoadChunk('sidebar', 'admin/master', array('name' => $adminName), '../');

// Get countries
global $xpdo;
$optionsTPL ="";

$countries = $xpdo->getCollection('Countries');
if(!empty($countries)){
    foreach($countries as $c){
       $optionsTPL .= new LoadChunk('option', 'admin/eventsLocations', array(
           'id' => $c->get('ID'),
           'name' => $c->get('Title_en'),
       ), '../');
    }
}

$content = new LoadChunk('locations', 'admin/eventsLocations', array('options' => $optionsTPL), '../');

$extraScripts 	= new LoadChunk('scripts', 'admin/eventsLocations',array(),'../');

$footer  = new LoadChunk('footer', 'admin/master', array('extraScripts' => $extraScripts), '../');

$output  = new LoadChunk('template', 'admin', array(
                                            'head'    => $head,
                                            'header'  => $header,
                                            'sidebar' => $sidebar,
                                            'content' => $content,
                                            'footer'  => $footer
                                        ), '../');

echo $output;