<?php
session_start();
if($_SESSION['role'] != 2) { 
	$link = mysql_connect("localhost", "root", "01155812");
	if (!$link)
	{
		die("Could not connect: " . mysql_error());
	}
	mysql_select_db("cs431f33", $link);
	?>
	<a href='user.php'>Click here to go back to your profile</a><br />
	<a href='messages.php'>Click here to go back to inbox</a>
	<br />
	<h3>Send your messages: </h3>
	<form action='sendMessage.php' method='post'>To: <input type='text' name='rec'/><br />Subject: <input type='text' name='sub'/><br />Message: <br /><TEXTAREA name='message' ROWS=6 COLS=60></TEXTAREA><br /><input type='submit' name='submit' value='Send' /></form>
	<br />
	<?php
	if(isset($_POST['submit'])) {
		$query = sprintf("INSERT INTO MAILBOX (Subject, Text, SendUser, RecUser) VALUES ('%s', '%s', '%s', '%s');", mysql_real_escape_string( $_POST['sub']), mysql_real_escape_string($_POST['message']), mysql_real_escape_string($_SESSION['user']), mysql_real_escape_string($_POST['rec']));
		$result = mysql_query($query, $link);
		?>Message Sent<?php
	}
}
else {
	?>Banned<?php
	}
	
	
	
	
