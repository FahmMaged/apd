<?php

require_once('../helpers/AdminUsersHelper.php');

if (!AdminUsersHelper::IsLoggedIn())
{
	UtilityHelper::RedirectTo('login.php');
}
$adminUsersHelper = new AdminUsersHelper();

$adminName = $_SESSION['AdminUser']['FirstName'];

$head    = new LoadChunk('head', 'admin/master', array(), '../');

$header  = new LoadChunk('header', 'admin/master', array(), '../');

$sidebar = new LoadChunk('sidebar', 'admin/master', array('name' => $adminName), '../');

$content = new LoadChunk('main', 'admin/memberCategories', array(), '../');

$extraScripts 	= new LoadChunk('scripts', 'admin/memberCategories',array(),'../');

$footer  = new LoadChunk('footer', 'admin/master', array('extraScripts' => $extraScripts), '../');

$output  = new LoadChunk('template', 'admin', array(
                                            'head'    => $head,
                                            'header'  => $header,
                                            'sidebar' => $sidebar,
                                            'content' => $content,
                                            'footer'  => $footer
                                        ), '../');

echo $output;