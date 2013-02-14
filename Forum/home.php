<!DOCTYPE html>
<html lang=en>
<title>Login and Registration</title>
<?php	
	session_start();
	$link = mysql_connect("localhost", "root", "01155812");
	if (!$link)
	{
		die("Could not connect: " . mysql_error());
	}
	mysql_select_db("cs431f33",$link); ?>
<h1><b>Register:</b></h1>
<form action='/Forum/home.php' method='post'>Full Name: <input type='text' name='full' /><br />Username: <input type='text' name='user' /><br />Password: <input type='password' name='password' /><br /><input type = 'submit' name='register' value='Register' /></form>
<br />
<br />
<h1><b>Login:</b></h1>
<form action='/Forum/home.php' method='post'>Username: <input type='text' name='user'/><br />Password: <input type='password' name='password' /><br /><input type='submit' name='login' value='Login' /></form>
<?php
if(isset($_POST['login']))
{
	$query = sprintf("SELECT * FROM USERS WHERE Username='%s' AND Password='%s';", mysql_real_escape_string($_POST["user"]), mysql_real_escape_string($_POST["password"]));
	$result = mysql_query($query, $link);
if (mysql_num_rows($result))
{
	$_SESSION['user'] = $_POST['user'];
	$row=mysql_fetch_assoc($result);
	$_SESSION['role'] = $row['Status'];
	?><script type="text/javascript">
		window.location.replace("/Forum/user.php")
	</script><?php
}
else
{ 
	?>
	<script type="text/javascript">
		alert("Incorrect username or password")
	</script>
	<?php
}}
else if (isset($_POST['register']))
{
	$query = sprintf("SELECT Username FROM USERS WHERE Username='%s';", mysql_real_escape_string($_POST["user"]));
	$result = mysql_query($query, $link);
	if(mysql_num_rows($result))
	{
		?><script type="text/javascript">
			alert("That username is already taken")
		</script><?php
	}
	else
	{	
		$queryReg = sprintf("INSERT INTO USERS (FullName, Username, Password) VALUES ('%s', '%s', '%s');", mysql_real_escape_string($_POST["full"]), mysql_real_escape_string($_POST["user"]), mysql_real_escape_string($_POST["password"]));
		$result=mysql_query($queryReg, $link);
		$_SESSION['user'] = $_POST['user'];
		$_SESSION['role'] = 0;
		?><script type="text/javascript">
			alert("You are now registered")
			window.location.replace("/Forum/user.php")
		</script><?php
	}	
} ?>
</html>
