<?php

// Defines OScc functions: csv2arr, arr2csv, csv2kv, checkPost.
	require 'oscc/functions.php';

// Load site-wide variables into a K=>V array: defaultPage, siteName, editPage, userName, passwordHash.
	$config = csv2kv('/data/siteData');

// Set page-specific variables. ##

	// Get 'page' variable from URL, filter it, store it as $check.
	$check = isset($_GET['page']) ?
 		toUrl(filter_input(INPUT_GET, 'page')) :
 		null;

 	// Make a 2-D array of the site's structure/nav data.
	$navArray = csv2arr('/data/structureData');

	// Settings to load if on the site edit page
	// (since these aren't stored in structureData).
	if ($check === toUrl($config['editPage'])) {

		$contentURL		= $config['editPage'];
		$contentTitle	= 'Edit Site';
		$nav 			= 'siteEdNav';
	
	// Get settings for a normal page.
	} else {

		foreach($navArray as $position => $lineArray) {
			// Set settings from line in structureData, if it matches $check 
			// (or if it is first page in list, in case an invalid page was entered).
			if ($lineArray[0] === '-' && ($lineArray[2] === $check || $position === 0)) {
				$contentURL 	= $lineArray[2];
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
	if ($contentURL === $config['editPage'] && $updateOn)
		require 'oscc/updatesite.php';

?>