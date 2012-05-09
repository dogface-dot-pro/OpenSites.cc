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
	foreach ($navArray as $lineArray) {

		// Skip private entries unless logged in.
		if ($lineArray[0] === '0' || $loggedIn) {

			$title = $lineArray[2];

			// Set <li> class to 'current' if it is the current page.
			$currentId = ($title === $contentTitle) ?
				' id="navCurrent"' :
				'';

			$privDiv = ($lineArray[0] === '1') ?
				'<div class="navPrivate"><img src="oscc/pub/img/lock-by-glyphish.png"></div>' :
				'';

			

			if ($lineArray[1] === '-')
				$lineString = "\t<a href='?page=" . toUrl($title) . "'><div class='navPage $divClass'$currentId><li>$title</li>$privDiv</div></a>\n\n";
			else if ($lineArray[1] === '#')
				$lineString = "\t<div class='navSection'><li>$title</li>$privDiv</div>\n\n";
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
		$editText = '<p><a href="?page=' . $contentURL . '">Stop Editing</a> | <a href="?page=Edit_Site">Edit Site</a></p>';
	else
		$editText = '<p><a href="?page=' . $contentURL . '&amp;edit">Edit Page</a> | <a href="?page=Edit_Site">Edit Site</a></p>';

	echo $editText;

?>
</div>

</ul>

</div>