<?php
// ### ### ### Checks login. ### ### ###

// Username
define('LOGIN_USER', "Admin");

// Password
define('LOGIN_PASSHASH', $config['passwordHash']);


// prompt() prints a login form, and handles the resulting $_POST to set login on/off.
// checkAuth() returns TRUE and renews session/cookies if user is logged in,
//		otherwise returns FALSE and destroys session.
class Login {


	// Days "remember me" cookies will remain
	var $cookie_duration = 21;

	// temporary values for comparing login are auto set here. do not set your own $user or $pass here
	var $user = "";
	var $pass = "";

	var $loggedIn;



// Unsets existing session.
// prints login form as <div>.
// POSTs action=set_login, user, pass, remember, to this script.
function prompt () {

	//print login form.
	?>
	<div class="login">

		<form action="?login" method="post">
		<p><input type="hidden" name="action" value="set_login"></p>

		<h3>Enter Login Info:</h3>
		<p><label for="user">Username:</label> <input type="text" name="user" id="user"></p>
		<p><label for="pass">Password:</label> <input type="password" name="pass" id="pass"></p>

		<input type="submit" value="Login">

		</form>

	</div>
	<?php

} // end prompt();

// Process $_POST information from prompt().
function checkPrompt() {
	$salt = sha1("Admin");

	$this->user = $_POST['user'];
	$this->pass = sha1($salt . $_POST['pass']); // Hash password, salted with prefix.

	$okay = $this->checkDetails();

	if ($okay) {
	
		$this->approveSession();

	} else {	

		$this->destroySession();
	}
}

// $this->user and this->pass must be set. Checked against LOGIN_PASS and LOGIN_USER.
// Returns TRUE if they match; FALSE otherwise.
function checkDetails() {

	return (LOGIN_PASSHASH === $this->pass && LOGIN_USER === $this->user && !isset($_GET['logout']));
}

function approveSession() {

	$this->loggedIn = TRUE;

	// Set session variables.
	$_SESSION['login_user'] = $this->user;
	$_SESSION['login_pass'] = $this->pass;

}

// Destroy existing cookies login_user and login_pass, bys setting time in past; end session.
function destroySession() {

	$this->loggedIn = FALSE;

	session_unset();
}

// Sets $this->user and $this->pass based on stored cookies or form input.
// Returns TRUE and sets cookies if user is logged in, otherwise FALSE and destroys cookies.
function checkAuth() {

	// If processing from prompt()...
	if(isset($_GET['login']))
		$this->checkPrompt();


	// Set object variables to session variables.
	if (isset($_SESSION['login_user'])) {
		$this->user = $_SESSION['login_user'];
		$this->pass = $_SESSION['login_pass'];
	}

	$okay = $this->checkDetails();
	// If session variables are set, check the details, and approve or destroy session+cookies as needed.
	if ($okay)
		$this->approveSession();
	else
		$this->destroySession();

	return $this->loggedIn;
} // end checkAuth()

} //CLASS Login

?>