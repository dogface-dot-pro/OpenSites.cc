<!-- Title Bar -->

<a href="/"><div class="titleBar">

<h1><?php echo $config['siteName'] ?></h1>

</div></a>

<!-- Nav Menu 
	Starts a form that finishes in the content. 
-->

<form action="?page=Edit_Site&amp;update" method="post">

<div class="nav">

<ul>

<?php

	// Same as normal nav menu but with radio buttons.
	// FIXME: don't echo HTML; <h3> is not valid within <ul> (do <li class="section"> or <li><h3>...)
	foreach ($navArray as $position => $la) { // la = Line Array, position is line number

		$title = $la[2];

		if ($la[1] === '#')
			$lineString = "<h3><input type='radio' name='position' id='$position' value='$position'><label for='$position'>$title</label></h3>\n"; 
		else if ($la[1] === '-')
			$lineString = "<li><input type='radio' name='position' id='$position' value='$position'><label for='$position'>$title</label></li>\n"; 
		else
			$lineString = '';

		echo $lineString;
	
	}

?>

<div class="editButtons">

<p><a href='?logout'>Logout</a> | <a href='?page'>Cancel Edit Site</a></p>

</div>

</ul>

</div>