<?php
session_start();
$link = mysql_connect("localhost", "root", "01155812");
if (!$link)
{
	die("Could not connect: " . mysql_error());
}
mysql_select_db("cs431f33", $link);

$queryPass = sprintf("SELECT Password FROM USERS WHERE Username='%s' AND Password='%s';", mysql_real_escape_string($_SESSION['user']), mysql_real_escape_string($_POST['oldPass']));
$queryChange = sprintf("UPDATE USERS SET Password='%s' WHERE Username='%s';", mysql_real_escape_string($_POST["password"]), mysql_real_escape_string($_SESSION['user']));

$result = mysql_query($queryPass, $link);

if (mysql_num_rows($result))
{
	$result = mysql_query($queryChange, $link);
	?> Password Successfully Changed<br />
	<a href='user.php'>Click here to return to your account page</a>
	<?php
}
else
{
	?> Incorrect Old Password<br />
	<a href='user.php'>Click here to return to your account page</a><br />
	<br />
	<a href='passChange.php'>Or Click here to try again</a><br />
<?php }