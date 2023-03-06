<?php 
require_once('connection.php');
session_start();
    if(isset($_POST['Login']))
    {
       if(empty($_POST['UName']) || empty($_POST['Password']))
       {
            header("location:indexx.php?Empty= Please Fill in the Blanks");
       }
       else
       {
            $query="SELECT * FROM user WHERE user_id='".$_POST['UName']."' AND password='".$_POST['Password']."'";
            $result=mysqli_query($con,$query);

            if($i = mysqli_fetch_assoc($result))
            {
              if($i['type'] == "client"){
                $_SESSION['User']=$_POST['UName'];
                header("location:shoppingcart.php");
              }else{
                //$_SESSION['User']=$_POST['UName'];
                header("location:uploadFile.html");
              }
            }
            else
            {
                header("location:indexx.php?Invalid= Please Enter Correct User Name and Password ");
            }
       }
    }
    else if(isset($_POST['createAccount'])){
      header("location:create_account.html");
    }
    else
    {
        echo 'Not Working Now Guys';
    }


?>