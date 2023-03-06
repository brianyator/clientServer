<?php
function connection()
{

$conn = mysqli_connect("localhost", "root", "","food_orders")
   or die("Connection failed!");   
return $conn;

}

function setdata($sql)
{
$conn=connection();
if(mysqli_query($conn,$sql)){
return true;
}
else{
return false;
}
}

function getdata($sql)
{
	$conn=connection();
	$result=mysqli_query($conn,$sql);
	$rowdata=array();
	
	while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
	{
		$rowdata[]=$row;
	}
	return $rowdata;
}
?>