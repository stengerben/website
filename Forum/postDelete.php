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
	<link rel="stylesheet" href="mystyles.css">
	<a href='userMember.php'>Click here to return to the group member page</a>
	<h3>Remove Post:</h3>
	<form action='postDelete.php' method='post'>Post Number: <input type='text' name='PostNo'/><br /><input type='submit' name='remove' value='Remove' /></form>
	<?php
	if(isset($_POST['remove'])) {
		$queryPostRem = sprintf("DELETE FROM POST WHERE PostNo='%s' AND CreatingUser='%s';", mysql_real_escape_string($_POST['PostNo']), mysql_real_escape_string($_SESSION['user']));
		$result2 = mysql_query($queryPostRem, $link);
		if ($result2)
			?>Sucessfully Deleted Post: <?php echo $_POST['PostNo'];
	}
	$queryPosts = sprintf("SELECT * FROM POST WHERE CreatingUser='%s';", mysql_real_escape_string($_SESSION['user']));
	$result1 = mysql_query($queryPosts, $link);

	?>
	<h3>Your Posts</h3>
	<div class="PostTable">
	<table cellpadding='4' cellspacing='3' border='1'>
		<tr>
			<th>Post Number</th>
			<th>Post</th>
			<th>Thread Title</th>
		</tr>
	<?php
		if (mysql_num_rows($result1)) {
		while ($row=mysql_fetch_assoc($result1)) {
	?>
		<tr>
			<td><?php echo $row['PostNo']; ?></td>
			<td><?php echo $row['Text']; ?></td>
			<td><?php echo $row['ThreadTitle']; ?></td>
		</tr>
	<?php } ?>
	</table></div>
<?php }
} ?>
