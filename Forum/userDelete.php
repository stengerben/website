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
	
	if ($_POST['userToRemove'] == $_POST['userToRemove2']) {
		$queryUserRem = sprintf("DELETE FROM USERS WHERE USERS.Username='%s';", mysql_real_escape_string($_POST['userToRemove']));
		$result = mysql_query($queryUserRem, $link);
		?>Sucessfully Deleted User: <?php echo $_POST['userToRemove'];?>
		<br /><a href='administrator.php'>Click here to return to administration page</a><?php
	} 
}?>