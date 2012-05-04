<!-- Title Bar -->

<a href='/'><div class='titleBar'>

<h1><?php echo $config['siteName'] ?></h1>

</div></a>

<!-- Nav Menu -->

<form action='?page=<?php echo $config['editPage'] ?>&update' method='post'>

<div class='nav'>

<ul>

<?php

	$position = 0;

	foreach ($navArray as $la) { // la = Line Array.

		$title = $la[1];

		if ($la[0] === '#')
			$lineString = "<h3><input type='radio' name='position' value='$position'>$title</h3>\n"; 
		else if ($la[0] === '-')
			$lineString = "<li><input type='radio' name='position' value='$position'>$title</li></a>\n"; 
		else
			$lineString = '';

		echo $lineString;

		$position = $position + 1;
	
	}

?>

<div class=editButtons>

<a href='/'>Stop Editing</a>

</div>

</ul>

</div>