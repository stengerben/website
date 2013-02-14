<?php
session_start();
if($_SESSION['role'] != 2) { 
$link = mysql_connect("localhost", "root", "01155812");
if (!$link)
{
	die("Could not connect: " . mysql_error());
}
mysql_select_db("cs431f33", $link);

$queryChange = sprintf("UPDATE USERS SET ProfDesc='%s' WHERE Username='%s';", mysql_real_escape_string($_POST["profile"]), mysql_real_escape_string($_SESSION['user']));

$result = mysql_query($queryChange, $link);
?> Profile Successfully Changed<br />
<a href='user.php'>Click here to return to your account page</a>

<?php } 
else { ?>
	Banned
<?php } ?>