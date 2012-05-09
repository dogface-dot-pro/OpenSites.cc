<p><span class='arrow'>&larr;</span> Select a page/section, if needed.</p>
<div class="newtitlesnote">New pages/sections are placed after the selected one.</div>

<p><span class='arrow'>&darr;</span> Select an action or change a site setting.</p>

<div class="siteEdActions">

	<ul>
		<h3>Actions</h3>
		<li><input type="radio" name="action" id ="newpage" value="newpage">		<label for="newpage">New Page</label></li>
		<li><input type="radio" name="action" id="newsection" value="newsection">	<label for="newsection">New Section</label></li>
		<li><input type="radio" name="action" id="moveup" value="moveup">			<label for="moveup">Move Up</label></li>	
		<li><input type="radio" name="action" id="movedown" value="movedown">		<label for="movedown">Move Down</label></li>
		<li><input type="radio" name="action" id="setprivacy" value="setprivacy">	<label for="setprivacy">Set Privacy</label></li>		
		<li><input type="radio" name="action" id="delete" value="delete">			<label for="delete">Delete</label></li>
		<li><input type="radio" name="action" id="rename" value="rename">			<label for="rename">Rename</label></li>
		New Title:<input type="text" name="newtitle"></input></br>
		Private?: <input type="checkbox" name="private" value="private"></input></br>
		<hr>
		<h3>Site Settings</h3>
		<li>Change Site Name: <input type="text" name="newSiteName" value="<?php echo $config['siteName'] ?>"></input></li><br>
		<li>Set New Password: <input type="password" name="newPass1" autocomplete="off"></input></li>
		<li>Confirm Password: <input type="password" name="newPass2" autocomplete="off"></input></li>
	</ul>
	<input type="submit" name="submit" value="Submit">

</div>

<p><span class='arrow'>&uarr;</span> Click 'Submit'.</p>

</form>