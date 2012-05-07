<!-- Title Bar -->

<a href='/'><div class='titleBar'>

<h1><?php echo $config['siteName'] ?></h1>

</div></a>
	
<!-- Nav Menu -->

<div class='nav'>

<ul>

<?php

	// For each line in $navArray (NB, each line is an array),
	// echo a <li> for pages or an <h3> for titles.
	foreach ($navArray as $la) {

		// Set <li> class to 'current' if it is the current page.
		$liClass = ($la[1] === $contentTitle) ?
			' class="current"' :
			'';

		$title = $la[1];

		if ($la[0] === '-')
			$lineString = "\t<a href='?page=" . toUrl($title) . "'><li$liClass>$title</li></a>\n\n";
		else if ($la[0] === '#')
			$lineString = "\t<h3>$title</h3>\n\n";
		else
			$lineString = '';

		echo $lineString;
	}

	// Check whether to show 'Login' or edit buttons.
	$editText = "<p><a href='?page=$contentURL&amp;edit'>Edit page</a> | <a href='?page=Edit_Site'>Edit Site</a></p>";

	$loginText = ($loggedIn) ?
		"<p><a href='?page=$contentURL&amp;logout'>Logout</a></p>" :
		"<p><a href='?page=Login'>Login</a></p>";

?>

<div class=editButtons>

<?php 

	if ($loggedIn)
		echo $editText;

	echo $loginText;

?>

</div>

</ul>

</div>