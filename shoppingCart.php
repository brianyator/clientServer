<?php

session_start();
$connect = mysqli_connect("localhost", "root", "", "restaurant");
$user = $_SESSION['User'];
if(isset($_SESSION['User']))
    {
        echo ' Well Come user: ' . $_SESSION['User'].'<br/>';
        echo '<a href="logout.php?logout">Logout</a>';
    }
else
    {
        header("location:indexx.php");
    }

$userid = $_SESSION['User'];

if(isset($_POST["add_to_cart"])){
	if(isset($_SESSION["shopping_cart"])){
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id)){
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'	=>	$_GET["id"],
				'item_name'	=>	$_POST["hidden_name"],
				'item_price'	=>	$_POST["hidden_price"],
				'item_quantity' =>	$_POST["quantity"]
			);
			$_SESSION["shopping_cart"][$count] = $item_array;
		}
		else{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else{
		$item_array = array(
			'item_id'	=>	$_GET["id"],
			'item_name'	=>	$_POST["hidden_name"],
			'item_price'	=>	$_POST["hidden_price"],
			'item_quantity' =>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Item Removed")</script>';
			}
		}
	}
}

?>
<!DOCTYPE html>
</!DOCTYPE html>
<html>
	<head>
		<title> Restaurant shopping cart: </title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<style>
		body {background-image: url('ff6.jpg'); background-size: cover;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  padding: 0 20px;}
		h1   {color: blue;}
		p    {color: red;}
		table, th, td {
  border: 10px solid black;
}

</style>
	</head>
	<body>
			<br />
			<div class = "container" style="width: 700px;">
				<h3 align="center"> Shopping Cart </h3><br />
				<?php
					$query = "SELECT * FROM order_details ORDER BY id ASC";
					$result = mysqli_query($connect, $query);
					if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_array($result)){
							?>
							<div class = "col-md-4">
								<form method="post" action="shoppingCart.php?action=add&id=<?php echo $row["id"]; ?>">
									<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
										<img src="<?php echo $row["image"]; ?>" class="img-responsive" /><br />
										<h4 class = "text-info"><?php echo $row["item_description"]; ?> </h4>
										<h4 class = "text-danger"><?php echo $row["unit_amount"]; ?> </h4>
										<input type="text" name="quantity" value="1" class="form-control" />
										<input type="hidden" name="hidden_name" value="<?php echo $row["item_description"]; ?>" />
										<input type="hidden" name="hidden_price" value="<?php echo $row["unit_amount"]; ?>" />
										<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
									</div>									
								</form>
							</div>
							<?php
						}
					}
				?>
			<div style="clear:both"></div>
			<br />
			<h3>Order Details</h3>
			<div class="table-responsive">
				<table class="table table-bordered" border= "1px solid black">
					<tr>
						<th width="40%">Item Name</th>
						<th width="10%">Quantity</th>
						<th width="20%">Price</th>
						<th width="30%">Total</th>
						<th width="5%">Action</th>
					</tr>
					<?php
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr>
						<td><?php echo $values["item_name"]; ?></td>
						<td><?php echo $values["item_quantity"]; ?></td>
						<td>Ksh. <?php echo $values["item_price"]; ?></td>
						<td>Ksh. <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
						<td><a href="shoppingCart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
							$sql="INSERT INTO orders (total_amount, user)VALUES('$total','$userid')";
					$insert = mysqli_query($connect, $sql);

					if($insert){
					echo "Details updated";
					}
						}
					?>
					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right">Ksh. <?php echo number_format($total, 2); ?></td>
						<td></td>
					</tr>
					<?php
					}

					
					?>

					<a href="db.php"><input  type="submit" name="confirm_order" style="margin-top:5px;" class="btn btn-success" value="Confirm Order" /></a>
						
				</table>
			</div>
		</div>
	</div>
	<br />
	</body>
</html>