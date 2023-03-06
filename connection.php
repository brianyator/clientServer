<?php 
 $con = mysqli_connect("localhost", "root", "","restaurant");

 if(!$con){
 	die('Please check connection'.mysql_error());
 }
 ?>