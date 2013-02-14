<?php
session_start();
if ($_SESSION['role'] != 1) {
	?> You are not an admin. <?php
}
else
{	?>
	<h3>Delete a User:</h3>
	<pre><form action='userDelete.php' method='post'>User to delete:		<input type='text' name='userToRemove' /><br />Confirm user to delete:	<input type='text' name='userToRemove2' /><br /><input type='submit' name='submit' value='Click to remove user' /></form></pre><br />
	<h3>Ban or Unban a User:</h3>
	<pre><form action='userBan.php' method='post'>User to ban/unban:		<input type='text' name='userToBan' /><br />Confirm user to ban/unban:	<input type='text' name='userToBan2' /><br /><input type="radio" name="ban" value=1/>Ban<br /><input type="radio" name="ban" value=0/>Unban<br /><input type='submit' name='submit' value='Click to ban user' /></form></pre><br />
	<br />
	<a href='adminGroup.php'>Click here to approve or remove groups</a><br />
	<a href='user.php'>Click here to return to your profile page</a>
<?php } ?>