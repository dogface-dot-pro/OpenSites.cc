<?php // ### Updates data/structureData and/or files in content/.

// Only proceed if password hash matches.
if (sha1(checkPost('password')) === $config['passwordHash']) {

	// Which line in navArray to work on.
	$position 		= intval(checkPost('position'));

	$action 		= checkPost('action');

	$newTitle 		= checkPost('newtitle');

	$tempArray		= $navArray;

	switch ($action) {
		
		case 'delete':

			$delFile 	= 'oscc/content/' . strtr($navArray[$position][1] . '.php', ' ', '_');
			
			$before 	= array_slice($navArray, 0, $position);
			
			$after 		= array_slice($navArray, $position + 1);
			
			$tempArray 	= array_merge($before, $after);

			arr2csv('data/structureData', $tempArray);

			unlink($delFile);

			break;

		case 'rename':

			$oldTitle = strtr($navArray[$position][1], ' ', '_');

			$tempArray[$position][1] = $newTitle;

			arr2csv('data/structureData', $tempArray);

			if ($navArray[$position][0] === '-')
				rename('oscc/content/' . $oldTitle . '.php', 'oscc/content/' . strtr($newTitle, ' ', '_') . '.php');

			break;

		case 'newpage':

			$before 	= array_slice($navArray, 0, $position + 1);

			$newType	= '-';

			$new 		= array(array($newType, $newTitle));
			
			$after 		= array_slice($navArray, $position + 1);
			
			$tempArray 	= array_merge($before, $new, $after);

			arr2csv('data/structureData', $tempArray);

			$newFile 	= 'oscc/content/' . strtr($newTitle, ' ', '_') . '.php';
				
			fopen($newFile, 'w');
				
			fclose($newFile);

			break;

		case 'newsection':

			$before 	= array_slice($navArray, 0, $position + 1);

			$newType	= '#';

			$new 		= array(array($newType, $newTitle));
			
			$after 		= array_slice($navArray, $position + 1);
			
			$tempArray 	= array_merge($before, $new, $after);

			arr2csv('data/structureData', $tempArray);

			break;

		case 'edit':

			$url = strtr($navArray[$position][1], ' ', '_');

			header("location: ?page=" . $url . "&edit");

			break;

		case 'moveup':

			if ($position === 0)
				break;

			$tempLine 					= $navArray[$position];

			$tempArray[$position] 		= $navArray[$position - 1];

			$tempArray[$position - 1] 	= $tempLine;

			arr2csv('data/structureData', $tempArray);

			break;

		case 'movedown':

			$endPosition = count($navArray) - 1;

			if ($position === $endPosition) {
				break;
			}

			$tempLine 					= $navArray[$position];

			$tempArray[$position] 		= $navArray[$position + 1];

			$tempArray[$position + 1]	= $tempLine;

			arr2csv('data/structureData', $tempArray);

			break;

		case 'edit':

			$newPage = strtr($navArray[$position][1], ' ', '_');

			header("Location: ?page=$newPage&edit");

			break;

		default: break;

	}

}

?>