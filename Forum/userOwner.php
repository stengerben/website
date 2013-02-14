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
	<a href='user.php'>Click here to return to your user page</a><br />
	<a href='ownerMember.php'>Click here to manage members of groups you own</a><br />
	<a href='threadDelete.php'>Click here to manage threads and posts of groups you own</a><br />
	<form action='userOwner.php' method='post'>Group Name:<input type='text' name='GName'><br />New Profile Description:<br /> <TEXTAREA name='profile' ROWS=6 COLS=60>New Profile Description Here...</TEXTAREA><br /><input type='submit' name='profileChange' value='Change Profile' /></form>
	<br />
	
<?php
	if(isset($_POST['profileChange']))
	{
		$queryChange = sprintf("UPDATE GROUPS SET ProfDesc='%s' WHERE Owner='%s' AND GName='%s';", mysql_real_escape_string($_POST['profile']), mysql_real_escape_string($_SESSION['user']), mysql_real_escape_string($_POST['GName']));
		$result1 = mysql_query($queryChange, $link);
		if($result1)
			?> Profile Successfully Changed<br /><?php
	}
 } 
else { ?>
	Banned
<?php } ?>