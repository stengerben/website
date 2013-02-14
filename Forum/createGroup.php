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
	<a href='userGroup.php'>Click here to go back to group info</a>
	<br />
	<h3>Create your group: </h3>
	<form action='createGroup.php' method='post'>Group Name: <input type='text' name='GName'/><br />Profile Description: <br /><TEXTAREA name='prof' ROWS=6 COLS=60></TEXTAREA><br /><input type='submit' name='submit' value='Send' /></form>
	<br />
	<?php
	if(isset($_POST['submit'])) {
		$queryCreateGroup = sprintf("INSERT INTO GROUPS (GName, ProfDesc, Owner) VALUES ('%s', '%s', '%s');", mysql_real_escape_string( $_POST['GName']), mysql_real_escape_string($_POST['prof']), mysql_real_escape_string($_SESSION['user']));
		$result = mysql_query($queryCreateGroup, $link);
		$querySetUpMember = sprintf("INSERT INTO GROUP_MEMBER (UserId, GroupId) SELECT USERS.id, GROUPS.id FROM USERS JOIN GROUPS WHERE USERS.Username='%s' AND GROUPS.GName='%s';", mysql_real_escape_string($_SESSION['user']), mysql_real_escape_string( $_POST['GName']));
		$result = mysql_query($querySetUpMember, $link);
		?>An administrator must now approve your group creation.<?php
	}
}
else {
	?>Banned<?php
	}
	
	
	
	