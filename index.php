<?php 

	// Defines OScc-related functions.		
	// Loads sitewide settings as variables: 
	//		$default, $username, $config['passwordHash'], $config['siteName'].
	// Sets page-specific settings: 
	//		$contentURL, $contentTitle, $editOn, $editor, $nav.
	// Testing Git... again!
	include 'oscc/loader';

	if ($contentURL === $config['editPage'] AND $updateOn)
		header("Location: ?page=" . $config['editPage']);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<!-- ### ### OpenSites.cc ### ### -->

<head>
<?php
	// Writes header elements to load stylesheets, set title.
	include 'oscc/header';
?>
</head>

<body>
<?php
	
	// Echoes <div>s containing the nav menu, page heading, login button and smallprint.
	echo "\n<!-- ### Nav ### -->\n\n";
	include 'oscc/navs/' . $nav;

	// Loads editing interface, if $editOn is 1.
	if (($editOn OR $updateOn) AND $contentURL != $config['editPage']) {
		echo "<!-- Editor -->\n\n";
		include 'oscc/editors/staticEd';
	}

	// Loads page content.
	echo "<!-- ### Content ### -->\n\n";
	echo '<div class="content">' . "\n\n";
	echo '<h2>' . $contentTitle . "</h2>\n\n";
	include 'oscc/content/' . $contentURL;
	echo "\n\n</div>\n\n";

?>
<!-- ### End of Document ### -->

</body>

</html>