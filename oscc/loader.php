<?php

// Defines OScc functions: csv2arr, arr2csv, csv2kv, checkPost.
	require 'oscc/functions.php';

// Load site-wide variables into a K=>V array: defaultPage, siteName, editPage, userName, passwordHash.
	$config = csv2kv('/data/siteData');

// Set page-specific variables. ##

	// Get 'page' variable from URL, filter it, store it as $check.
	$check = isset($_GET['page']) ?
 		filter_input(INPUT_GET, 'page', FILTER_SANITIZE_ENCODED), '_', ' ') :
 		$defaultPage;

 	// Make a 2-D array of the site's structure/nav data.
	$navArray = csv2arr('/data/structureData');

	// Settings to load if on the site edit page
	// (since these aren't stored in structureData).
	if ($check === strtr($config['editPage'], '_', ' ')) {

		$contentURL		= $config['editPage'];
		$contentTitle	= 'Edit Site';
		$nav 			= 'siteEdNav';
	
	// Get settings for a normal page.
	} else {

		foreach($navArray as $lineArray) {
			// Set settings from line in structureData, if it matches $check 
			// (or if it matches $config['defaultPage'], in case an invalid page was entered).
			// NB, this currently only works if defaultPage is at the top of the nav menu...
			if ($lineArray[0] === '-' AND ($lineArray[1] === $check OR $lineArray[1] === $config['defaultPage'])) {
				$contentURL 	= strtr($lineArray[1], ' ', '_');
				$contentTitle	= $lineArray[1];
				$nav 			= 'standardNav';
			}
		}
	}

	// Store whether 'edit' is set.
	$editOn = isset($_GET['edit']);

	// Store whether 'update' is set.
	$updateOn = isset($_GET['update']);

	// If we just submitted a change in the site edit page...
	if ($contentURL === $config['editPage'] AND $updateOn)
		require 'oscc/updatesite.php';

?>