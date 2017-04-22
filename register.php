<?php

$page_title = 'Register';

if (isset($_POST['submitted'])) {
	
	$errors = array();
	
	if (!empty($_POST['full_name'])) {
	$fn = trim($_POST['full_name']);
	} else {
	$errors[] = 'You forgot to enter your full name.';
	}

	if (!empty($_POST['username'])) {
	$un = trim($_POST['username']);
	} else {
	$errors[] = 'You forgot to enter your username.';
	}
	
	if (!empty($_POST['password1'])) {
		if($_POST['password1'] != $_POST['password2']){
		 $errors[] = 'Your password did not match';
		 }else {
		 $p = trim($_POST['password1']);
		 }
	} else {
	$errors[] = 'You forgot to enter your password';
	}
	
    if (empty($errors)){
    	
	    require_once ('mysql_connect.php');
	    
	    $query = "INSERT INTO users (full_name, username, password) VALUES
	    ('$fn', '$un', SHA('$p') )";
	    $result = @mysql_query ($query);
	    if ($result) {
	    
	    echo '<h1 id="mainhead">Thank you!</h1>
	    <p> You are now registered.</p><p><br /></p>';
	
	    exit();
	} else {
 	echo '<h1 id="mainhead">System Error</h1>
       <p class="error"> You could not be registered due to a system error. We apologize for any incovenience!</p>';
	echo '<p>' . mysql_error(). '<br /><br />Query: ' . $query. '</p>';
	exit(); } 
	} else {
	echo '<h1 id="mainhead">Error</h1>
	<p class="error"> The following error(s) occured :<br />';
	foreach ($errors as $msg){
	echo " - $msg<br />\n";
	}
	echo '</p><p>Please try again.</p><p><br /></p>';
	
	}
}	
?>
<h2>Register</h2>
<form action="register.php" method="post">
<legend>Enter your information in the form below:</legend>
<p><b>  Full Name:</b> <input type="text" name="full_name" size="15" maxlength="15" value="<?php if (isset($_POST['full_name'])) echo $_POST['full_name']; ?>" /></p>
<p><b>  Username:</b> <input type="text" name="username" size="20" maxlength="40" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" /></p>
<p><b>Password:</b> <input type="password" name="password1" size="10" maxlength="20" /></p>
<p><b>  Confirm Password:</b> <input type="password" name="password2" size="10" maxlength="20" /></p>
<p><input type="submit" name="submit" value="Register" /></p>
<input type="hidden" name="submitted" value="TRUE" />

</form>
