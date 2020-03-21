<?php

require_once('../helpers/AdminUsersHelper.php');

$adminUsersHelper = new AdminUsersHelper();

if (!$adminUsersHelper->IsLoggedIn()) {
    UtilityHelper::RedirectTo('login.php');
}

$output			= '';

$head         	= new LoadChunk('head', 'admin/master', array(), '../');

$settings     	= '';

$header       	= new LoadChunk('header', 'admin/master', array(), '../');

$sidebar      	= new LoadChunk('sidebar', 'admin/master', array(), '../');

$content      	= new LoadChunk('languageTool', 'admin/languageTool', array(), '../');

$extraScripts 	= new LoadChunk('scripts', 'admin/languageTool', array(), '../');

$footer       	= new LoadChunk('footer', 'admin/master', array('extraScripts' => $extraScripts), '../');

$output       	= new LoadChunk('template', 'admin', array(
	                                            'head'    => $head,
	                                            'header'  => $header,
	                                            'sidebar' => $sidebar,
	                                            'content' => $content,
	                                            'footer'  => $footer
	                                        ), '../');

echo $output;
