<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="keywords"content="HTML5,CSS3,JavaScript">
	<title> World of Warcraft</title>
	<link rel="stylesheet"href="mystyles.css">
	<script type="text/javascript">
	<!--
		function delayer(){
			window.location = "/Forum/home.php"
	}
	//-->
	</script>
</head>
<?php
session_start();
$link = mysql_connect("localhost", "root", "01155812");
if (!$link)
{
        die("Could not connect: " . mysql_error());
}
mysql_select_db("cs431f33", $link);

$queryProf = sprintf("SELECT * FROM USERS WHERE Username='%s';", mysql_real_escape_string($_SESSION['user']));
$result = mysql_query($queryProf, $link);
$row=mysql_fetch_assoc($result);
?>

<?php if($row['Status'] < 2) { ?>
	<body>
		<div id="wrapper">
			<header id="main_header">
			<h1><b>Welcome <?php echo strip_tags($row['Username']) ?></b><br /></h1>
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
				<article>
					<header>
						<hgroup>
							<h1>How to change realmlist.wtf</h1>
						</hgroup>
						<time datetime="2012-11-5" pubdate> posted 11-5-2012</time>
					</header>
					Step 1:<br>
						Find your World of Warcraft folder.<br>
					Step 2:<br>
						Within the World of Warcraft folder go into the Data folder.<br>
					Step 3:<br>
						Within the Data folder go into the enGB folder.<br>
					Step 4:<br>
						Within the enGB folder find realmlist or realmlist.wtf.<br>
					Step 5:<br>
						Right click on realmlist and click edit.<br>
					Step 6:<br>
						Change realmlist in your text editor to only have the following text:<br>
					<div id="code">
						set realmlist 107.194.132.249<br>
						set patchlist 107.194.132.249<br>
						set realmlistbn ""<br>
						set portal us
					</div><br>
					</article>
				</section>
				<footer id="main_footer">
				Copyright &copy 2012-2013
				</footer>
			</div>
		</body>
		<a href='passChange.php'>Click here to change your password</a><br /><br />
		<a href='profChange.php'>Click here to edit your profile</a><br /><br />
		<h1><b>Profile:</h1></b>
		<?php echo $row['ProfDesc']; ?>
		<br /><br />
		<?php if($row['Status'] == 1) { ?>
			<a href='administrator.php'>Click here to do administrative activities</a><br />
		<?php }
		$queryPost = sprintf("SELECT * FROM POST");
		
		} 
	else { ?>
		<h1><b>You have been banned</h1></b>
	<?php } ?>
</html>