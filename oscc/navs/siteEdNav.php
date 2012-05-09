<!-- Title Bar -->

<a href="/"><div class="titleBar">

<h1><?php echo $config['siteName'] ?></h1>

</div></a>

<!-- Nav Menu 
	Starts a form that finishes in the content. 
-->

<div class="nav">

<form action="?page=Edit_Site&amp;update" method="post">

<ul>

<?php

	// Same as normal nav menu but with radio buttons.
	// FIXME: don't echo HTML; <h3> is not valid within <ul> (do <li class="section"> or <li><h3>...)
	foreach ($navArray as $position => $lineArray) { // la = Line Array, position is line number

		$title = $lineArray[2];

		$privDiv = ($lineArray[0] === '1') ?
				'<div class="navPrivate"><img src="oscc/pub/img/lock-by-glyphish.png"></div>' :
				'';

		if ($lineArray[1] === '#')
			$lineString = "<div class='navSection'><li><input type='radio' name='position' id='$position' value='$position'><label for='$position'>$title</label></li>$privDiv</div>\n"; 
		else if ($lineArray[1] === '-')
			$lineString = "<div class='navPage'><li><input type='radio' name='position' id='$position' value='$position'><label for='$position'>$title</label></li>$privDiv</div>\n"; 
		else
			$lineString = '';

		echo $lineString;
	
	}

?>

<div class="editButtons">

<p><a href='?logout'>Logout</a> | <a href='?page'>Stop Editing Site</a></p>

</div>

</ul>

</div>