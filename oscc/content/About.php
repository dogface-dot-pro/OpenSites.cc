<p>Now you have a website!</p>

<p>You can edit this page by pushing 'Edit page', over there on the left. Or you can click 'Edit Site' to add/delete/move/rename pages, or change the site settings.</p>

<p>You should go and <a href="?page=<?php echo $config['editPage']; ?>">do that now</a>, so you can change the password!</p>

<p>The default password is <tt>opensites</tt>.</p>

<hr>

<h3>Test login</h3>

<?php 

$l = ($loggedIn) ? "Yes" : "No"; 

echo "<p>Logged in: " . ($l) . "</p>";

echo "<p>Session user: " . $_SESSION['login_user'] . "</p>";
echo "<p>Session hash: " . $_SESSION['login_pass'] . "</p>";

echo "<p>Cookie user: " . $_COOKIE['login_user'] . "</p>";
echo "<p>Cookie hash: " . $_COOKIE['login_pass'] . "</p>";

?>