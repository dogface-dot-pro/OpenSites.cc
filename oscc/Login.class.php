<?php
// ### ### ### Checks login. ### ### ###

// Username
define('LOGIN_USER', "Admin");

// Password
define('LOGIN_PASSHASH', $config['passwordHash']);


# CLASS desc: for calling login authentication
# CLASS req: looks for constants LOGIN_USER and LOGIN_PASS
# Can be called:  ?action=clear_login   ?action=prompt
class Login {

	// unique prefix that is used with this object (on cookies and password salt)
	var $prefix = "login_";

	// days "remember me" cookies will remain
	var $cookie_duration = 21;

	// temporary values for comparing login are auto set here. do not set your own $user or $pass here
	var $user = "";
	var $pass = "";

	var $loggedIn = FALSE;



// Unsets existing session.
// prints login form as <div>.
// POSTs action=set_login, user, pass, remember, to this script.
function prompt () {

// If processing result of $this->prompt()...
	if(isset($_POST['action']) && $_POST['action'] == "set_login"){

		$this->user = $_POST['user'];
		$this->pass = sha1($this->prefix.$_POST['pass']); // Hash password, salted with prefix.

		if ($this->checkDetails() === TRUE) {

			// If 'Remember me' was ticked, set cookie.
			if(isset($_POST['remember'])){
				setcookie($this->prefix."user", $this->user);
			}
			
			$this->approveSession();

		} else			
			$this->destroySession();

// Otherwise, print login form.
	} else {

		$this->destroySession();

		//print login form.
		?>
		<div class="login">

			<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
			<input type="hidden" name="action" value="set_login">

			<h3>Enter Login Info:</h3>
			<label for="user">Username:</label> <input type="text" name="user" id="user">
			<label for="pass">Password:</label> <input type="password" name="pass" id="pass">

			<input type="checkbox" name="remember" id="remember"> <label for="remember">Remember me on this computer</label>

			<input type="submit" value="Login">

			</form>

		</div>
		<?php
	}

}

// Sets $this->user and $this->pass based on stored cookies or form input.
// Returns TRUE and sets cookies if user is logged in, otherwise FALSE and destroys cookies.
function checkAuth() {

	// Save cookie info to session, if available.
	if (isset($_COOKIE[$this->prefix.'user'])) {

		$_SESSION[$this->prefix.'user'] = $_COOKIE[$this->prefix.'user'];
		$_SESSION[$this->prefix.'pass'] = $_COOKIE[$this->prefix.'pass'];
	}

	// If session variables are set, check the details, and approve or destroy session+cookies as needed.
	if (isset($_SESSION[$this->prefix.'user']) && $this->checkDetails() === TRUE)
		$this->approveSession();
	else
		$this->destroySession();

	return $this->loggedIn;
}

// $this->user and this->pass must be set. Checked against LOGIN_PASS and LOGIN_USER.
// Returns TRUE if they match; FALSE otherwise.
function checkDetails() {

	return !(sha1($this->prefix . LOGIN_PASS) != $this->pass || LOGIN_USER != $this->user);
}

function approveSession() {

	$this->loggedIn = TRUE;

	// Set session variables.
	$_SESSION[$this->prefix.'user'] = $this->user;
	$_SESSION[$this->prefix.'pass'] = $this->pass;

	// Renew cookies if they already exist.
	if(isset($_COOKIE[$this->prefix.'user'])){
		setcookie($this->prefix."user", $this->user, time()+($this->cookie_duration*86400));// (d*24h*60m*60s)
		setcookie($this->prefix."pass", $this->pass, time()+($this->cookie_duration*86400));// (d*24h*60m*60s)
}

// Destroy existing cookies login_user and login_pass, bys setting time in past; end session.
function destroySession() {

	$this->loggedIn = FALSE;

	if (!empty($_COOKIE[$this->prefix.'user'])) 
		setcookie($this->prefix."user", "blanked", time()-(3600*25));
		
	if(!empty($_COOKIE[$this->prefix.'pass'])) 
		setcookie($this->prefix."pass", "blanked", time()-(3600*25));
	
	session_unset();
	session_destroy();	
}


} //CLASS Login

?>