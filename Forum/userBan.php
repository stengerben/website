<?php
session_start();
if ($_SESSION['role'] != 1) {
	?> You are not an admin. <?php
}
else
{
	$link = mysql_connect("localhost", "root", "01155812");
	if (!$link)
	{
		die("Could not connect: " . mysql_error());
	}
	mysql_select_db("cs431f33", $link);
	
	if ($_POST['userToBan'] == $_POST['userToBan2']) {
		if ($_POST['ban'] == 1)	{
			$queryUserRem = sprintf("UPDATE USERS SET Status='%d' WHERE USERS.Username='%s';", 2, mysql_real_escape_string($_POST['userToBan']));
			?>Sucessfully Banned User: <?php echo $_POST['userToBan'];
			?><br /><a href='administrator.php'>Click here to return to admin page</a><?php
		}
		else {
			$queryUserRem = sprintf("UPDATE USERS SET Status='%d' WHERE USERS.Username='%s';", 0, mysql_real_escape_string($_POST['userToBan']));
			?>Sucessfully Unbanned User: <?php echo $_POST['userToBan'];
			?><br /><a href='administrator.php'>Click here to return to admin page</a><?php
		}
		$result = mysql_query($queryUserRem, $link);
		
	} 
}?>