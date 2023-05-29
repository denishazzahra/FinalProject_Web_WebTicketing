<?php
    session_start();
    session_destroy();
    if($_GET['menu']=="admin")
    {
        header("location:login_admin.php?pesan=logout");
    }
    else if($_GET['menu']=="user")
    {
        header("location:index.php?pesan=logout");
    }
?>