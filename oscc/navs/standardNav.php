<!-- Title Bar -->

<a href='/'><div class='titleBar'>

<h1><?php echo $config['siteName'] ?></h1>

</div></a>
	
<!-- Nav Menu -->

<div class='nav'>

<ul>

<?php

	foreach ($navArray as $la) {

		$liClass = ($la[1] === $contentTitle) ?
			' class="current"' :
			'';

		$title = $la[1];

		if ($la[0] === '-')
			$lineString = "\t<a href='?page=" . strtr($title, ' ', '_') . "'><li$liClass>$title</li></a>\n\n";
		else if ($la[0] === '#')
			$lineString = "\t<h3>$title</h3>\n\n";
		else
			$lineString = '';

		echo $lineString;
	}

?>

<div class=editButtons>

<a href='?page=<?php echo $contentURL ?>&edit'>Edit page</a> | <a href='?page=<?php echo $config['editPage'] ?>'>Edit Site</a>

</div>

</ul>

</div>