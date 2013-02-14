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
	<title>Group Management</title>
	<link rel="stylesheet" href="mystyles.css">
		<div id="wrapper">
		<header id="main_header">
			<h1><b>Main Posts Page</b></h1>
		</header>
		<nav id="main_menu">
			<ul>
				<li><a href="/Forum/user.php">Home</a></li>
				<li><a href="http://wotlk.openwow.com/">Database</a></li>
				<li><a href="/Forum/messages.php">Mailbox</a></li>
				<li><a href="/Forum/userGroup.php">Groups</a></li>
				<li><a href="/Forum/userMember.php">Threads</a></li>
				<li><a href="/Forum/userOwner.php">Group Owner</a></li>
				<li><a href="/Forum/userPost.php">Posts</a></li>
				<li><a href="/Forum/administrator.php"></a></li>
			</ul>
		</nav>
	<article>
	 <button onclick="window.location='/Forum/threadDelete.php'">Delete a Post</button><br />
	<h3>Approve members: </h3>
	<form action='ownerMember.php' method='post'>Username: <input type='text' name='UNameApp'/>Group: <input type='text' name='GName'/><br /><input type='submit' name='approve' value='Approve' /></form>
	<br />
	<h3>Remove members: </h3>
	<form action='ownerMember.php' method='post'>Username: <input type='text' name='UNameRem'/>Group: <input type='text' name='GName'/><br /><input type='submit' name='remove' value='Remove' /></form>
	<br />
	<?php
	$queryAppMembers = sprintf("SELECT USERS.Username, GROUPS.GName FROM USERS, GROUP_MEMBER, GROUPS WHERE GROUPS.Owner='%s' AND GROUP_MEMBER.Status='%d' AND USERS.id=GROUP_MEMBER.UserId AND GROUPS.id=GROUP_MEMBER.GroupId;", mysql_real_escape_string($_SESSION['user']), 0);
	$queryRemMembers = sprintf("SELECT USERS.Username, GROUPS.GName FROM USERS, GROUP_MEMBER, GROUPS WHERE GROUPS.Owner='%s' AND GROUP_MEMBER.Status='%d' AND USERS.id=GROUP_MEMBER.UserId AND GROUPS.id=GROUP_MEMBER.GroupId;", mysql_real_escape_string($_SESSION['user']), 1);
	$result1 = mysql_query($queryAppMembers, $link);
	$result2 = mysql_query($queryRemMembers, $link);
	
	if(isset($_POST['approve'])) {
		if (mysql_num_rows($result1))
		{
			$queryApp = sprintf("UPDATE GROUP_MEMBER SET Status='%d' WHERE UserId=(SELECT id FROM USERS WHERE Username='%s') AND GroupId=(SELECT id FROM GROUPS WHERE GName='%s' AND Owner='%s');", 1, mysql_real_escape_string($_POST['UNameApp']), mysql_real_escape_string( $_POST['GName']), mysql_real_escape_string($_SESSION['user']));
			$result3 = mysql_query($queryApp, $link);
			if ($result2)
				?>The Group Member has been Approved. Refresh the page to see the change.<?php
		}
	}
	if(isset($_POST['remove'])) {
		if (mysql_num_rows($result2))
		{
			$queryRem = sprintf("DELETE FROM GROUP_MEMBER WHERE UserId=(SELECT id FROM USERS WHERE Username='%s') AND GroupId=(SELECT id FROM GROUPS WHERE GName='%s' AND Owner='%s');", mysql_real_escape_string($_POST['UNameRem']), mysql_real_escape_string( $_POST['GName']), mysql_real_escape_string($_SESSION['user']));
			$result3 = mysql_query($queryRem, $link);
			if ($result2)
				?>The Group Member has been Removed. Refresh the page to see the change.<?php
		}
	} ?>
	</article>
	

	<?php
	if (mysql_num_rows($result1)) { ?>
	<article>
	<div class="MemberTable">
	<h3>Possible Members</h3>
		<table cellpadding='4' cellspacing='3' border='1'>
		<tr>
			<th>Username</th>
			<th>Group Name</th>
		</tr> <?php
		while ($row=mysql_fetch_assoc($result1)) {
	?>
		<tr>
			<td><?php echo $row['Username']; ?></td>
			<td><?php echo $row['GName']; ?></td>
		</tr>
	<?php } ?>
	</table></div></article><?php
	} ?>
	<article>
	<div class="MemberTable">
	<h3>Current Members</h3>
	<table cellpadding='4' cellspacing='3' border='1'>
		<tr>
			<th>Username</th>
			<th>Group Name</th>
		</tr>
	<?php
	if (mysql_num_rows($result2)) {
		while ($row=mysql_fetch_assoc($result2)) {
	?>
		<tr>
			<td><?php echo $row['Username']; ?></td>
			<td><?php echo $row['GName']; ?></td>
		</tr>
	<?php } ?>
	</table> </div></article><?php
	}
}
else {
	?>Banned<?php
	}
	