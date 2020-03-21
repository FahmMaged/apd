<?php

require_once('../helpers/AdminUsersHelper.php');

if (!AdminUsersHelper::IsLoggedIn()) {
	UtilityHelper::RedirectTo('login.php');
	exit;
}

if (AdminUsersHelper::Logout()) {
	UtilityHelper::RedirectTo('login.php');
} else {
	header('HTTP/1.1 500 Internal Server Error');
	exit('Something went wrong while logging you out. Please try again.');
}