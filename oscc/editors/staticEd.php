<?php

// if &update is in URL...
if ($updateOn) {

	$entryText = checkPost('entryText');

// Write text from $_POST into page's file.
 		
	file_put_contents('oscc/content/' . $contentURL . '.php', $entryText);

 	header("url:?page=$contentURL");

// If &update is not set, make a form with a textarea, password box.
// Fill textarea with current page contents.
} else {
	?>

	<div class='edit'>

	<h2>Editing: <?php echo $contentTitle; ?></h2>

	<?php $output = file_get_contents('oscc/content/' . $contentURL . '.php'); ?>
	
	<form action="?page=' . $contentURL . '&amp;update" method="post">
	<textarea type="text" name = "entryText" wrap="soft"><?php 
		echo $output; 
	?></textarea><br>
	<input type="submit" value="Submit"> 
	</form>

	</div>

	<?php
}

?>