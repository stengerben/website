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
	<a href='sendMessage.php'>Click here to send a message</a>
	<br />
	<h3>Search for Message or Scroll down to see all messages</h3>
	<form action='messages.php' method='post'>Keyword to search for: <input type='text' name='keyword'><br /><input type='submit' name='submit' value='Search' /></form>
	<br />

	<?php
	$queryMessage = sprintf("SELECT * FROM MAILBOX WHERE RecUser='%s';", mysql_real_escape_string($_SESSION['user']));
	$queryMessageBySubjectOrText = sprintf("SELECT * FROM MAILBOX WHERE RecUser='%s' AND Subject LIKE '%%%s%%' OR Text LIKE '%%%s%%';", mysql_real_escape_string($_SESSION['user']), mysql_real_escape_string($_POST['keyword']), mysql_real_escape_string($_POST['keyword']));
	if(isset($_POST['submit'])) {
		$result = mysql_query($queryMessageBySubjectOrText, $link);
	}
	else {
		$result = mysql_query($queryMessage, $link);
	}
	if (mysql_num_rows($result)) {
	?>
	<article>
	<div class="PostTable">
	<table cellpadding='4' cellspacing='3' border='1'>
		<tr>
			<th>From</th>
			<th>Subject</th>
			<th>Message</th>
		</tr>
	<?php
		while ($row=mysql_fetch_assoc($result)) {
	?>
		<tr>
			<td><?php echo $row['SendUser']; ?></td>
			<td><?php echo $row['Subject']; ?></td>
			<td><?php echo $row['Text']; ?></td>
		</tr>
	<?php } ?>
	</table>
	</div>
	</article>
<?php
	}
}
else { ?>
	Banned
<?php } ?>
