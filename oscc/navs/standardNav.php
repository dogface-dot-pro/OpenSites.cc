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

		// Skip private entries unless logged in.
		if ($la[0] === '0' || $loggedIn) {

			$title = $la[2];

			// Set <li> class to 'current' if it is the current page.
			$liClass = ($title === $contentTitle) ?
				' class="current"' :
				'';
			

			if ($la[1] === '-')
				$lineString = "\t<a href='?page=" . toUrl($title) . "'><li$liClass>$title</li></a>\n\n";
			else if ($la[1] === '#')
				$lineString = "\t<h3>$title</h3>\n\n";
			else
				$lineString = '';

			echo $lineString;
	
		}
	}

?>

<div class=editButtons>
<?php

	if (!$loggedIn)
		$editText = '<p><a href="?page=Login">Login</a></p>';
	else if ($editOn)
		$editText = '<p><a href="?page=' . $contentURL . '">Cancel Edit</a> | <a href="?page=Edit_Site">Edit Site</a></p>';
	else
		$editText = '<p><a href="?page=' . $contentURL . '&amp;edit">Edit Page</a> | <a href="?page=Edit_Site">Edit Site</a></p>';

	echo $editText;

?>
</div>

</ul>

</div>