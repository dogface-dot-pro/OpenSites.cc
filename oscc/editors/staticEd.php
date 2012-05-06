<?php

// if &update is in URL...
if ($updateOn) {

	$entryText = checkPost('entryText');

	// if password hash matches, write text from $_POST into page's file.
 	if (sha1(checkPost('entryPassword')) === $config['passwordHash']) {
 		
		file_put_contents('oscc/content/' . $contentURL . '.php', $entryText);

 		header("url:?page=$contentURL");

 		//echo '<a href="?page=' . $contentURL . '"><div class="alert">Update successful!</div></a>' . "\n\n";
 	
 	} else {

 		echo "<div class='edit'>";

		echo "<h2>Editing: $contentTitle</h2>";
 		
 		echo '<a href="?page=' . $contentURL . '&edit"><div class="alert">Incorrect Password! Try again?</div></a>' . "\n\n";
 	
 	}

// If &update is not set, make a form with a textarea, password box.
// Fill textarea with current page contents.
} else {

	echo "<div class='edit'>";

	echo "<h2>Editing: <?php echo $contentTitle ?></h2>";

	$output = file_get_contents('oscc/content/' . $contentURL . '.php');
	
	echo '<form action="?page=' . $contentURL . '&amp;update" method="post">
	 	<textarea type="text" name = "entryText" wrap="soft">';

	echo $output;

	echo '</textarea><br>
		Username: <input type="text" name="username" value="Admin"></input><br> 
	 	Password: <input type="password" name="entryPassword" class="password"><br> 
	 	<input type="submit" value="Submit"> 
	 	</form>';
}

?>

</div>