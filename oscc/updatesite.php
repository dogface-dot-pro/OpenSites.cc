<?php // ### Updates data/structureData and/or files in content/.

// ####### Site-settings
$newSiteName 	= checkPost('newSiteName');
$newPass = checkPost('newPass1');

// If newPass1 is set and matches newPass2, set passwordHash to new hash.
if ($newPass != null && $newPass === checkPost('newPass2')) {
	
	$config['passwordHash'] = sha1(sha1('Admin') . $newPass);
	
	kv2csv('data/siteData', $config);
}

// Change siteName if it's set.
if ($newSiteName != null) {

	$config['siteName'] = $newSiteName;
	
	kv2csv('data/siteData', $config);
}

// ####### Page changes

$position 		= intval(checkPost('position'));
$action 		= checkPost('action');
$newType 		= $navArray[$position][2];

// Merge 'newpage' and 'newsection'
if ($action === 'newpage' || $action === 'newsection') {
	$newType = ($action === 'newpage') ? '-' : '#';
	$action = 'new';
}

$newTitle 		= checkPost('newtitle');
$newUrl			= toUrl($newTitle);
$newFile 		= 'oscc/content/' . $newUrl . '.php';
$tempArray		= $navArray;

switch ($action) {
	
	case 'delete':

		$delFile 	= 'oscc/content/' . $navArray[$position][3] . '.php';
		$before 	= array_slice($navArray, 0, $position);
		$after 		= array_slice($navArray, $position + 1);
		$tempArray 	= array_merge($before, $after);

		arr2csv('data/structureData', $tempArray);

		if ($newType === '-')
			unlink($delFile);

		break;

	case 'rename':

		foreach($navArray as $line) {
			if ($line[1] === $newType && $line[2] === $newTitle)
				break 2;
		}

		$oldUrl 					= $navArray[$position][3];
		$tempArray[$position][2] 	= $newTitle;
		$tempArray[$position][3] 	= toUrl($newTitle);

		arr2csv('data/structureData', $tempArray);

		if ($navArray[$position][1] === '-')
			rename('oscc/content/' . $oldUrl . '.php', 'oscc/content/' . $newUrl . '.php');

		break;

	case 'new':

		foreach($navArray as $line) {
			if ($line[1] === $newType && $line[2] === $newTitle)
				break 2;
		}

		$before 	= array_slice($navArray, 0, $position + 1);
		$after 		= array_slice($navArray, $position + 1);
		$new 		= array(array('0', $newType, $newTitle, $newUrl));
		$tempArray 	= array_merge($before, $new, $after);

		arr2csv('data/structureData', $tempArray);
		
		if ($newType === '-') {	
			fopen($newFile, 'w');
			fclose($newFile);
		}

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

	default: break;

}

?>