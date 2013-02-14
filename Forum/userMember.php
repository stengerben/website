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
	<br />
	<h3>Create your thread: </h3>
	<form action='userMember.php' method='post'>Group Name: <input type='text' name='GName'/><br />Title:<input type='text' name='title' /><br /><input type='submit' name='thread' value='Create' /></form>
	<br />
	<h3>Post to thread: </h3>
	<form action='userMember.php' method='post'>Group Name: <input type='text' name='GName'/><br />Thread Title: <input type='text' name='TName'/><br />Post: <br /><TEXTAREA name='postText' ROWS=4 COLS=60></TEXTAREA><br /><input type='submit' name='postCreate' value='Create' /></form>
	<br />
	<a href='postDelete.php' method='post'>To delete a post you made click here</a><br />
	<?php
	$queryMembers = sprintf("SELECT USERS.Username FROM USERS, GROUP_MEMBER, GROUPS WHERE USERS.Username='%s' AND GROUP_MEMBER.Status='%d' AND USERS.id=GROUP_MEMBER.UserId AND GROUPS.id=GROUP_MEMBER.GroupId AND GROUPS.GName='%s';", mysql_real_escape_string($_SESSION['user']), 1, mysql_real_escape_string($_POST['GName']));
	if(isset($_POST['thread'])) {
		$result1 = mysql_query($queryMembers, $link);
		if (mysql_num_rows($result1))
		{
			$queryCreateThread = sprintf("INSERT INTO THREAD (Title, GName, StartingUser) VALUES ('%s', '%s', '%s');", mysql_real_escape_string($_POST['title']), mysql_real_escape_string( $_POST['GName']), mysql_real_escape_string($_SESSION['user']));
			$result2 = mysql_query($queryCreateThread, $link);
			if ($result2)
				?>Your thread has been created<?php
		}
	}
	if(isset($_POST['postCreate'])) {
		$result1 = mysql_query($queryMembers, $link);
		if (mysql_num_rows($result1))
		{
			$queryCreatePost = sprintf("INSERT INTO POST (Text, ThreadTitle, CreatingUser) VALUES ('%s', '%s', '%s');", mysql_real_escape_string($_POST['postText']), mysql_real_escape_string($_POST['TName']), mysql_real_escape_string($_SESSION['user']));
			$result2 = mysql_query($queryCreatePost, $link);
			if ($result2)
				?>Your post has been created<?php
		}
	}
}
else {
	?>Banned<?php
	}
	
	