<?php
    session_start();

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