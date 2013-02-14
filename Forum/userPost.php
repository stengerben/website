<html lang="en">
<meta charset="utf-8">
<meta name="keywords" content="HTML5, CSS3, JavaScript">
<title>Posts</title>
<link rel="stylesheet" href="mystyles.css">
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
		<section id="main_section">	
	<h3>Search Post: </h3>
	<nav id="forms">
	<ul>
	<li><form action='userPost.php' method='post'>Post Number: <input type='text' name='PostNo'/><input type='submit' name='PostNum' value='Search' /></form>
	<li><form action='userPost.php' method='post'>Text: <input type='text' name='Keyword'/><input type='submit' name='PostText' value='Search' /></form>
	</ul>
	</nav>
	<br />
	</section>
	<?php
	$queryPosts = sprintf("SELECT * FROM POST;");
	if(isset($_POST['PostNum'])) {
		$queryPost = sprintf("SELECT * FROM POST WHERE PostNo='%s';", mysql_real_escape_string($_POST['PostNo']));
		$result = mysql_query($queryPost, $link);
	}
	else if(isset($_POST['PostText'])) {
		$queryPost = sprintf("SELECT * FROM POST WHERE Text LIKE '%%%s%%';", mysql_real_escape_string($_POST['Keyword']));
		$result = mysql_query($queryPost, $link);
	}
	else {
		$result = mysql_query($queryPosts, $link);
	} ?>
	<article>
	<div class="PostTable">
	<table cellpadding='4' cellspacing='3' border='1'>
		<tr>
			<th>Post Number</th>
			<th>Thread</th>
			<th>Post</th>
		</tr>
	<?php
	if (mysql_num_rows($result)) {
		while ($row=mysql_fetch_assoc($result)) {
	?>
		<tr>
			<td><?php echo strip_tags($row['PostNo']); ?></td>
			<td><?php echo strip_tags($row['ThreadTitle']); ?></td>
			<td><?php echo strip_tags($row['Text']); ?></td>
		</tr>
	<?php } ?>
	</table></div> </article><?php
	}
}
else {
	?>Banned<?php
	}