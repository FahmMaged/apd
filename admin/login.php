<?php

require_once('../helpers/AdminUsersHelper.php');

if (AdminUsersHelper::IsLoggedIn())
{
	UtilityHelper::RedirectTo('index.php');
}

$head   = new LoadChunk('head', 'admin/master', array(), '../');
$footer = new LoadChunk('footer', 'admin/master', array('extraScripts' => ''), '../');
$output = new LoadChunk('login', 'admin', array(
												'head'   => $head,
												'footer' => $footer
											), '../');

echo $output;
