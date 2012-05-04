<?php
	
	// Converts a CSV file into an array.
	function csv2arr($path) {
		$file 			= fopen('oscc/' . $path, 'r') or die ("Can't open file oscc/" . $path);
		$resultsArray	= array();

		while (!feof($file)) {
			$lineArray = fgetcsv($file);
			array_push($resultsArray, $lineArray);
		}
		fclose($file);
		return $resultsArray;
	};

	// Converts a CSV file into key-value array 
	// (uses first two values of each line).
	function csv2kv ($path) {
		$file 			= fopen('oscc/' . $path, 'r') or die ("Can't open file oscc/" . $path);
		$resultsArray	= array();

		while (!feof($file)) {
			$lineArray = fgetcsv($file);
			$resultsArray[$lineArray[0]] = $lineArray[1];
		}
		fclose($file);
		return $resultsArray;
	};

	// Writes an $array into a file at $path.
	function arr2csv($path, $array) {

		$file = fopen('oscc/' . $path, 'w');

		foreach ($array as $line) {
			fputcsv($file, $line);
		}

		fclose($file);
	};

	// Returns a POST-value if it exists, runs stripslashes if needed.
	function checkPost($input) {

		if (isset($_POST[$input]) AND !empty($_POST[$input])) {
			if (get_magic_quotes_gpc())
				return (string) stripslashes($_POST[$input]);
			else 
				return (string) $_POST($input);
		} else
			return null;
	};

?>