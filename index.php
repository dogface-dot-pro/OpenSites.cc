<?php 

	// Defines OScc-related functions:
	//		csv2arr, arr2csv, csv2kv, checkPost.		
	// Loads sitewide settings as variables: 
	//		siteName, editPage, userName, passwordHash.
	// Sets page-specific settings: 
	//		$contentURL, $contentTitle, $editOn, $updateOn
	// Loads nav data into $navArray.
	// Sets $loggedIn if user is logged in.
	require 'oscc/loader.php';

	// If we just processed a change from the site-edit page, return to it.
	if ($contentURL === 'Edit_Site' && $updateOn)
		header("Location: ?page=Edit_Site");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<!-- ### ### OpenSites.cc ### ### -->

<head>
<?php
	// Writes header elements to load stylesheets, set title, etc.
	include 'oscc/header.php';
?>
</head>

<body>

<!-- ### Nav ### -->
<?php
	
	// Echoes <div>s containing the nav menu, page heading, login button and smallprint.
	include 'oscc/navs/' . $nav . '.php';

	// Loads editing interface, if $editOn is 1.
	if ($editOn || ($updateOn && $canEdit)) {
		echo "<!-- Editor -->\n\n";
		include 'oscc/editors/staticEd.php';
	}

?>

<!-- ### Content ### -->

<div class="content">

<h2><?php echo $contentTitle ?></h2>
<?php

	include $contentPath;

?>
</div>

<!-- ### End of Document ### -->

</body>

</html>