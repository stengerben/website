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
	<link rel="stylesheet" href="mystyles.css">
	<a href='user.php'>Click here to go back to your profile</a><br />
	<a href='ownerMember.php'>To go back a page click here</a><br />
	<h3>Remove thread: </h3>
	<form action='threadDelete.php' method='post'>Thread Title: <input type='text' name='TName'/>Group: <input type='text' name='GName'/><br /><input type='submit' name='remThread' value='Remove' /></form>
	<br />
	<h3>Remove post: </h3>
	<form action='threadDelete.php' method='post'>Post Number: <input type='text' name='PostNo'/>Group: <input type='text' name='GName'/><br /><input type='submit' name='remPost' value='Remove' /></form>
	<br />
	<?php
	$queryRemThreads = sprintf("SELECT THREAD.Title, GROUPS.GName FROM THREAD, GROUPS WHERE GROUPS.Owner='%s' AND GROUPS.GName=THREAD.GName;", mysql_real_escape_string($_SESSION['user']));
	$queryRemPosts = sprintf("SELECT POST.PostNo, GROUPS.GName FROM POST, THREAD, GROUPS WHERE GROUPS.Owner='%s' AND GROUPS.GName=THREAD.GName AND THREAD.Title=POST.ThreadTitle;", mysql_real_escape_string($_SESSION['user']));
	$result1 = mysql_query($queryRemThreads, $link);
	$result2 = mysql_query($queryRemPosts, $link);
	
	if(isset($_POST['remThread'])) {
		if (mysql_num_rows($result1))
		{
			$queryRem1 = sprintf("DELETE FROM POST WHERE ThreadTitle=(SELECT Title FROM THREAD WHERE Title='%s' AND GName=(SELECT GName FROM GROUPS WHERE GName='%s' AND Owner='%s'));", mysql_real_escape_string($_POST['TName']), mysql_real_escape_string( $_POST['GName']), mysql_real_escape_string($_SESSION['user']));
			$queryRem2 = sprintf("DELETE FROM THREAD WHERE Title='%s' AND GName=(SELECT GName FROM GROUPS WHERE GName='%s' AND Owner='%s');", mysql_real_escape_string($_POST['TName']), mysql_real_escape_string( $_POST['GName']), mysql_real_escape_string($_SESSION['user']));
			$result3 = mysql_query($queryRem1, $link);
			$result4 = mysql_query($queryRem2, $link);
			if ($result3 && $result4)
				?>The Thread has been Removed. Refresh the page to see the change.<?php
		}
	}
	if(isset($_POST['remPost'])) {
		if (mysql_num_rows($result2))
		{
			$queryRem = sprintf("DELETE FROM POST WHERE PostNo='%s' AND ThreadTitle=(SELECT Title FROM THREAD WHERE GName=(SELECT GName FROM GROUPS WHERE GName='%s' AND Owner='%s'));", mysql_real_escape_string($_POST['PostNo']), mysql_real_escape_string( $_POST['GName']), mysql_real_escape_string($_SESSION['user']));
			$result3 = mysql_query($queryRem, $link);
			if ($result3)
				?>The Post has been Removed. Refresh the page to see the change.<?php
		}
	} ?>
	<h3>Group Threads</h3>
	<div class="PostTable">
	<table cellpadding='4' cellspacing='3' border='1'>
	<tr>
		<th>Thread Title</th>
		<th>Group Name</th>
	</tr> <?php
	if (mysql_num_rows($result1)) { 
		while ($row=mysql_fetch_assoc($result1)) { ?>
		<tr>
			<td><?php echo $row['Title']; ?></td>
			<td><?php echo $row['GName']; ?></td>
		</tr>
	<?php } ?>
	</table> <?php
	} ?>
	<h3>Group Posts</h3>
	<table cellpadding='4' cellspacing='3' border='1'>
		<tr>
			<th>Post Number</th>
			<th>Group Name</th>
		</tr>
	<?php
	if (mysql_num_rows($result2)) {
		while ($row=mysql_fetch_assoc($result2)) {
	?>
		<tr>
			<td><?php echo $row['PostNo']; ?></td>
			<td><?php echo $row['GName']; ?></td>
		</tr>
	<?php } ?>
	</table> </div><?php
	}
}
else {
	?>Banned<?php
	}