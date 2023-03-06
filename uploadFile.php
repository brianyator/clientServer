<?php

require_once("connectionFunction.php");
if(isset($_POST['submitimage']))
{
	print_r($_POST);

	echo $_POST['food-item'];
	print_r($_FILES['fileUpload']['name']);



$itemname=$_POST['food-item'];
$original_file_name=$_FILES['fileUpload']['name'];
echo $original_file_name; 
$price=$_POST['price'];

$connecting = connection();

$tmp_file_location=$_FILES['fileUpload']['tmp_name'];

$check_size_of_image = getimagesize($original_file_name);
if($check_size_of_image == true){
	$imageContent = addslashes(file_get_contents($original_file_name));
}
$sql="INSERT INTO order_details (item_description, image, unit_amount)VALUES('$itemname','$original_file_name','$price')";
$insert = mysqli_query($connecting, $sql);

if($insert){
		echo "Details updated";
	}	
}
?>