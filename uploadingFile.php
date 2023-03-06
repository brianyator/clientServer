<?php  
if(isset($_SESSION['User']))
    {
        echo ' Well Come user: ' . $_SESSION['User'].'<br/>';
        echo '<a href="logout.php?logout">Logout</a>';
    }
else
    {
        header("location:indexx.php");
    }
    ?>
<html>
<head>
	<body>
		<form action="uploadFile.php" method="POST" enctype=multipart/form-data>
			<strong>Admin Form:</strong>
		</br></br>
			<label for="food-item">Food-Item:</label></br>
			<input type="text" name="food-item" id="food-item"></br></br>

			<label for="file-upload">Upload Pic:</label></br>
			<input type="file" name="fileUpload" id="file-upload"></br></br>

			<label for="price">Price:</label></br>
			<input type="text" name="price" id="price"></br></br>

			<input type="submit" value="Save" name="submitimage">
		</form>
	</body>
</html>
