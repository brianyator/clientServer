<?php include 'shoppingCart.php';?>
<?php
			require_once("connectionFunction.php");
			$connecting = connection();
					$sql="INSERT INTO orders (total_amount, user)VALUES('$total','$user')";
			$insert = mysqli_query($connecting, $sql);

			if($insert){
					echo "Details updated";
				}	
			
		?>
<!DOCTYPE html>
<html>
<head><title>Items ordered</title></head>
<body>
	<div>

		<font size="+3"><p>Person with User ID <?php echo $user ?> has made an order amounting to Ksh. <?php echo $total ?></p></font>
		<font size="+2"><p>Your <?php echo $values["item_quantity"]; ?> <?php echo $values["item_name"]; ?>(s) and other preceeding foods will be delivered in 30 mintues</p></font>
		<font size="+1"><p>Thank you for shopping  with TamuTamu Restaurant.</p></font>
		
	</div>



</body>
</html>