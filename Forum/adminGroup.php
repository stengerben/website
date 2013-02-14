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
	mysql_select_db("cs431f33", $link); ?>
	<h3>Approve Group:</h3>
	<form action='adminGroup.php' method='post'>Group Name: <input type='text' name='GNameApp'/><br /><br /><input type='submit' name='approve' value='Approve' /></form>
	<h3>Remove Group:</h3>
	<form action='adminGroup.php' method='post'>Group Name: <input type='text' name='GNameRem'/><br /><br /><input type='submit' name='remove' value='Remove' /></form>
	<?php
	if(isset($_POST['remove'])) {
		$queryMemberRem = sprintf("DELETE FROM GROUP_MEMBER WHERE GROUP_MEMBER.GroupId IN (SELECT GROUPS.id FROM GROUPS WHERE GROUPS.GName='%s');", mysql_real_escape_string($_POST['GNameRem']));
		$queryGroupRem = sprintf("DELETE FROM GROUPS WHERE GROUPS.GName='%s';", mysql_real_escape_string($_POST['GNameRem']));
		$result1 = mysql_query($queryMemberRem, $link);
		$result2 = mysql_query($queryGroupRem, $link);
		if ($result1 && $result2)
			?>Sucessfully Deleted Group: <?php echo $_POST['GNameRem'];
	} 
	if(isset($_POST['approve'])) {
		$queryGroupApp = sprintf("UPDATE GROUPS SET Status='%d' WHERE GROUPS.GName='%s';", 1, mysql_real_escape_string($_POST['GNameApp']));
		$result3 = mysql_query($queryGroupApp, $link);
		if ($result3)
			?>Sucessfully Approved Group: <?php echo $_POST['GNameApp'];
	} 
	
}?>
<br /><a href='administrator.php'>Click here to return to administration page</a>