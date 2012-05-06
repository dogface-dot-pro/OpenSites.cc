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

	// Writes a k=>v array to a CSV.
	function kv2csv($path, $array) {

		$file = fopen('oscc/' . $path, 'w');

		foreach ($array as $k => $v) {
			fputcsv($file, array($k, $v));
		}

		fclose($file);

	};

	// Returns a POST-value if it exists, runs stripslashes if needed.
	function checkPost($input) {

		if (isset($_POST[$input]) AND !empty($_POST[$input])) {
			if (get_magic_quotes_gpc())
				return stripslashes(filter_input(INPUT_POST, $input));
			else 
				return filter_input(INPUT_POST, $input);
		} else
			return null;
	};


	// Converts a title into a URL-safe string - only alphanumeric and _.
	function toUrl($input) {
		
		return ereg_replace("[^A-Za-z0-9_]", "", $input);
		
	};
	

?>