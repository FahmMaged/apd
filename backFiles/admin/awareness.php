<?php

require_once('../helpers/AdminUsersHelper.php');

if (!AdminUsersHelper::IsLoggedIn())
{
	UtilityHelper::RedirectTo('login.php');
}

$adminName = $_SESSION['AdminUser']['FirstName'];

$head    = new LoadChunk('head', 'admin/master', array(), '../');

$header  = new LoadChunk('header', 'admin/master', array(), '../');

$select = new LoadChunk('selectOptions', 'admin/awareness', array(), '../');

$editSelect = new LoadChunk('editSelectOptions', 'admin/awareness', array(), '../');

$sidebar = new LoadChunk('sidebar', 'admin/master', array('name' => $adminName), '../');

$content = new LoadChunk('awareness', 'admin/awareness', array('select'     => $select,
														       'editSelect' => $editSelect), '../');

$extraScripts 	= new LoadChunk('scripts', 'admin/awareness',array(),'../');

$footer  = new LoadChunk('footer', 'admin/master', array('extraScripts' => $extraScripts), '../');

$output  = new LoadChunk('template', 'admin', array(
                                            'head'    => $head,
                                            'header'  => $header,
                                            'sidebar' => $sidebar,
                                            'content' => $content,
                                            'footer'  => $footer
                                        ), '../');

echo $output;