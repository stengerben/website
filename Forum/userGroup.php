<?php 
session_start();
if($_SESSION['role'] < 2) { 
	$link = mysql_connect("localhost", "root", "01155812");
	if (!$link)
	{
		die("Could not connect: " . mysql_error());
	}
	mysql_select_db("cs431f33", $link); ?>
	<link rel="stylesheet" href="mystyles.css">
	<a href='user.php'>Click here to go back to your profile</a><br />
	<a href='createGroup.php'>Click here to create a group</a>
	<br />
	<h3>Search for Approved Group or Scroll down to see all Approved Groups</h3>
	<form action='userGroup.php' method='post'>Group Name to search for: <input type='text' name='group'/><br /><input type='submit' name='submit' value='Search' /></form>
	<h3>Join an Approved Group By Name</h3>
	<form action='userGroup.php' method='post'>Group Name to Join: <input type='text' name='groupName'/><br /><input type='submit' name='join' value='Join' /></form>
	<br />

	<?php
	if(isset($_POST['join'])) {
		$queryJoin = sprintf("INSERT INTO GROUP_MEMBER (UserId, GroupId) SELECT USERS.id, GROUPS.id FROM USERS JOIN GROUPS WHERE USERS.Username='%s' AND GROUPS.GName='%s';", mysql_real_escape_string($_SESSION['user']), mysql_real_escape_string( $_POST['groupName']));
		$result3 = mysql_query($queryJoin, $link);
		if ($result3)
			?>You have sucessfully joined the group<?php
	}
	$queryGroup = sprintf("SELECT * FROM GROUPS WHERE GROUPS.Status=%d;", 1);
	$queryGroupByName = sprintf("SELECT * FROM GROUPS WHERE GName='%s' AND Status=%d;", mysql_real_escape_string($_POST['group']), 1);
	if(isset($_POST['submit'])) {
		$result = mysql_query($queryGroupByName, $link);
	}
	else {
		$result = mysql_query($queryGroup, $link);
	}?>
	<h1>List of Approved Groups:</h1>
	<div class="PostTable">
	<table cellpadding='4' cellspacing='3' border='1'>
		<tr>
			<th>Group Name</th>
			<th>Owner</th>
			<th>Profile Description</th>
			<th>Members</th>
		</tr><?php
	if (mysql_num_rows($result)) {
		while ($row=mysql_fetch_assoc($result)) {
		$queryMembers = sprintf("SELECT USERS.Username FROM USERS, GROUP_MEMBER, GROUPS WHERE GROUP_MEMBER.Status='%d' AND USERS.id=GROUP_MEMBER.UserId AND GROUPS.id=GROUP_MEMBER.GroupId AND GROUPS.GName='%s';", 1, mysql_real_escape_string($row['GName']));
		$result2 = mysql_query($queryMembers, $link);
	?>
		<tr>
			<td><?php echo $row['GName']; ?></td>
			<td><?php echo $row['Owner']; ?></td>
			<td><?php echo $row['ProfDesc']; ?></td>
			<td><?php while ($row2=mysql_fetch_assoc($result2)) {
								echo $row2['Username'];?><br /><?php }?></td>
		</tr>
	<?php } ?>
	</table></div>
<?php
	}
}
else { ?>
	Banned
<?php } ?>