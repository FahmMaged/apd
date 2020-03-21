<?php

require_once('../helpers/AdminUsersHelper.php');

if (!AdminUsersHelper::IsLoggedIn())
{
	UtilityHelper::RedirectTo('login.php');
}
$adminUsersHelper = new AdminUsersHelper();
$adminName = $_SESSION['AdminUser']['FirstName'];

$head         = new LoadChunk('head', 'admin/master', array(), '../');

$header       = new LoadChunk('header', 'admin/master', array(), '../');

$sidebar      = new LoadChunk('sidebar', 'admin/master', array('name' => $adminName), '../');

$content      = new LoadChunk('allAdminUsers', 'admin/adminUsers', array(), '../');

$adminUsersScript = new LoadChunk('adminUsersScript', 'admin/adminUsers', array(), '../');

$footer       = new LoadChunk('footer', 'admin/master', array('extraScripts' => $adminUsersScript), '../');

$output       = new LoadChunk('template', 'admin', array(
		                                            'head'    => $head,
		                                            'header'  => $header,
		                                            'sidebar' => $sidebar,
		                                            'content' => $content,
		                                            'footer'  => $footer
		                                        ), '../');

echo $output;