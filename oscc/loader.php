<?php

// Defines OScc functions and names globals from them.
	include 'oscc/functions.php';

// Set site-wide variables.
	$config = csv2kv('/data/siteData');

// Set page-specific variables. ##

	// Get 'page' variable from URL, filter it, store it as $check.
	$check = isset($_GET['page']) ?
 		strtr(filter_input(INPUT_GET, 'page'), '_', ' ') :
 		$defaultPage;

	$navArray = csv2arr('/data/structureData');

	// Settings to load if on the edit page
	// (since these aren't stored in structureData).
	if ($check === strtr($config['editPage'], '_', ' ')) {

		$contentURL		= $config['editPage'];
		$contentTitle	= 'Edit Site';
		$nav 			= 'siteEdNav';
	
	} else {

		foreach($navArray as $la) { // $la = line array.
			// Set settings from line in structureData, if it matches $check 
			// (or $config['defaultPage'], in case an invalid page was entered).
			if ($la[0] === '-' AND ($la[1] === $check OR $la[1] === $config['defaultPage'])) {
				$contentURL 	= strtr($la[1], ' ', '_');
				$contentTitle	= $la[1];
				$nav 			= 'standardNav';
			}
		}
	}

	// Store whether 'edit' is set.
	$editOn = isset($_GET['edit']);

	// Store whether 'update' is set.
	$updateOn = isset($_GET['update']);

	if ($contentURL === $config['editPage'] AND $updateOn)
		include 'oscc/updatesite.php';

?>