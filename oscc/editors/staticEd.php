<div class='edit'>

<h2>Editing: <?php echo $contentTitle ?></h2>

<?php

// if &update is in URL...
if ($updateOn) {

	$entryText = checkPost('entryText');

	// if password hash matches, write text from $_POST into page's file.
 	if (sha1(checkPost('entryPassword')) === $config['passwordHash']) {
 		
		file_put_contents('oscc/content/' . $contentURL . '.php', $entryText);

 		echo '<a href="?page=' . $contentURL . '"><div class="alert">Update successful!</div></a>' . "\n\n";
 	
 	} else {
 		
 		echo '<a href="?page=' . $contentURL . '&edit"><div class="alert">Incorrect Password! Try again?</div></a>' . "\n\n";
 	
 	}

// If &update is not set, make a form with a textarea, password box.
// Fill textarea with current page contents.
} else {
	
	echo '<form action="?page=' . $contentURL . '&update" method="post">
	 	<textarea type="text" name = "entryText" wrap="soft">';
	include 'oscc/content/' . $contentURL . '.php';
	echo '</textarea><br> 
	 	Password: <input type="password" name="entryPassword" class="password"><br> 
	 	<input type="submit" value="Submit"> 
	 	</form>';
}

?>

</div>