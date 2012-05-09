<?php

// Defines OScc functions: csv2arr, arr2csv, csv2kv, checkPost.
	require 'oscc/functions.php';

// Load site-wide variables into a K=>V array: siteName, passwordHash.
	$config = csv2kv('/data/siteData');

// Set page-specific variables. ##

	// Get 'page' variable from URL, filter it, store it as $check.
	$check = isset($_GET['page']) ?
 		toUrl(filter_input(INPUT_GET, 'page')) :
 		null;

	// Start session, load login.class, instantiate a Login object,
 	// use it to set $loggedIn to TRUE or FALSE.
	session_start();
	
	require("Login.class.php");
	
	$login = new Login();

	$loggedIn = $login->checkAuth();

	// Make a 2-D array of the site's structure/nav data,
	// only showing private pages if $loggedIn is TRUE.
	$navArray = csv2arr('/data/structureData');

	// Settings to load if on the site edit page
	// (since these aren't stored in structureData).
	if ($check === 'Edit_Site' && $loggedIn) {

		$contentURL		= 'Edit_Site';
		$contentTitle	= 'Edit Site';
		$contentPath	= 'oscc/Edit_Site.php';
		$nav 			= 'siteEdNav';
		$canEdit		= FALSE;

		
	// Or get settings for a normal page.
	} else if ($check != 'Login') {

		$foundPage = FALSE;

		foreach($navArray as $position => $lineArray) {
			// Set settings from line in structureData, if it matches $check and privacy passes.
			// (or if it is first page in list, in case an invalid page was entered).
			if ($lineArray[1] === '-' && ($lineArray[0] === '0' || $loggedIn) && ($lineArray[3] === $check || $position === 0)) {
					$contentURL 	= $lineArray[3];
					$contentTitle	= $lineArray[2];
					$contentPath	= 'oscc/content/' . $contentURL . '.php';
					$nav 			= 'standardNav';
					$canEdit		= TRUE;
					$foundPage		= TRUE;
			}
		
		} 	// End of normal page settings.

	// If no non-private page was found or user requested login, show login page.
	} if ($check === 'Login' || $foundPage === FALSE) {
		
		$contentURL		= 'Login';
		$contentTitle	= 'Log-in';
		$contentPath	= 'oscc/Login.php';
		$nav 			= 'standardNav';
		$canEdit		= FALSE;
		
	} // End of settings.

	// Store whether 'edit' is set.
	$editOn = (isset($_GET['edit']) && $canEdit && $loggedIn);

	// Store whether 'update' is set.
	$updateOn = (isset($_GET['update']) && $loggedIn);

	// If we just submitted a change in the site edit page...
	if ($contentURL === 'Edit_Site' && $updateOn)
		require 'oscc/updatesite.php';

?>