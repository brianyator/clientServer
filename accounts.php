<?php

require_once("connectionFunction.php");
if(isset($_POST['createAccount']))
{
	print_r($_POST);





$firstname = $_POST['first-name'];
$username = $_POST['username'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$user_type = $_POST['type'];
$worker_number = $_POST['wnumber'];

if($password == $cpassword){
	$confirmed_password = $cpassword;

$connecting = connection();
if($user_type == "admin"){
		if($worker_number == 100){
			$user_type = "admin";
			$sql="INSERT INTO user (user_id, first_name, password, type)VALUES('$username','$firstname','$confirmed_password', '$user_type')";
			$insert = mysqli_query($connecting, $sql);

			if($insert){
				echo "Details updated";
			}else{
				echo "details for admin not added to DB";
			}
		}
		else{
			echo "Incorrect working number. You may not be an administrator.";
		}
		
	}
	else{
			$user_type = "client";
			$sql="INSERT INTO user (user_id, first_name, password, type)VALUES('$username','$firstname','$confirmed_password', '$user_type')";
			$insert = mysqli_query($connecting, $sql);

			if($insert){
				echo "Details updated";
			}else{
				echo "Clients details not added to the database";
			}
	}
}
else{
	echo "Passwords do not match";
}
}


?>