<div class='edit'>

<h2>Editing: <?php echo $contentTitle ?></h2>

<?php

if ($updateOn) {

	$entryText = checkPost('entryText');

 	if (sha1(checkPost('entryPassword')) === $config['passwordHash']) {
 		
 		$editFile = fopen('oscc/content/' . $contentURL, "w");
 		
 		fclose($editFile);

 		file_put_contents('oscc/content/' . $contentURL, $entryText);

 		echo '<a href="?page=' . $contentURL . '"><div class="alert">Update successful!</div></a>' . "\n\n";
 	
 	} else {
 		
 		echo '<a href="?page=' . $contentURL . '&edit"><div class="alert">Incorrect Password! Try again?</div></a>' . "\n\n";
 	
 	}


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