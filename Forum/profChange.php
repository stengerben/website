<?php 
session_start();
if($_SESSION['role'] != 2) { ?>
<html>
	<form action='profChangeValidate.php' method='post'>New Profile Description:<br /> <TEXTAREA name='profile' ROWS=6 COLS=60>New Profile Description Here...</TEXTAREA><br /><input type='submit' name='submit' value='Change Profile' /> <input type='hidden' name='redirect' value='/profChangeValidate.php' /></form>
	<br />
	<a href='user.php'>Click here if you do not wish to change your profile</a>
</html>
<?php } 
else { ?>
	Banned
<?php } ?>