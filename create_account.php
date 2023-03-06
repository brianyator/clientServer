<?php 
require_once('connection.php');
session_start();
    if(isset($_POST['Login']))
    {
<html>
<head>
	<body>
		<form action="accounts.php" method="POST" enctype=multipart/form-data>
			<strong>Create New Account: </strong>
		</br></br>
			<label for="first-name">First Name:</label></br>
			<input type="text" name="first-name" id="first-name"></br></br>

			<label for="username">Username:</label></br>
			<input type="number" name="username" id="username"></br></br>

			<label for="password">Password:</label></br>
			<input type="password" name="password" id="password"></br></br>

			<label for="cpassword">Confirm Password:</label></br>
			<input type="password" name="cpassword" id="cpassword"></br></br>

			<strong>User Type:</strong> <br>
			<input type="radio" name="type" value= "client" /> Client <br>
			<input type="radio" name="type" value= "admin"/> Admin <br><br>

			<label for="wnumber">Admin Worker Number (for admin only):</label></br>
			<input type="number" name="wnumber" id="wnumber"></br></br>

			<input type="submit" value="Save" name="createAccount">
		</form>
	</body>
</html>
