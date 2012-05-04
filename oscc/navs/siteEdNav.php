<!-- Title Bar -->

<a href='/'><div class='titleBar'>

<h1><?php echo $config['siteName'] ?></h1>

</div></a>

<!-- Nav Menu 
	Starts a form that finishes in the content. 
-->

<form action='?page=<?php echo $config['editPage'] ?>&amp;update' method='post'>

<div class='nav'>

<ul>

<?php

	// Same as normal nav menu but with radio buttons.
	// FIXME: don't echo HTML; <h3> is not valid within <ul> (do <li class="section"> or <li><h3>...)
	foreach ($navArray as $position => $la) { // la = Line Array, position is line number

		$title = $la[1];

		if ($la[0] === '#')
			$lineString = "<h3><input type='radio' name='position' value='$position'>$title</h3>\n"; 
		else if ($la[0] === '-')
			$lineString = "<li><input type='radio' name='position' value='$position'>$title</li></a>\n"; 
		else
			$lineString = '';

		echo $lineString;
	
	}

?>

<div class=editButtons>

<a href='/'>Stop Editing</a>

</div>

</ul>

</div>