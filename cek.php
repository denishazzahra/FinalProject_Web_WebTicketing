<?php
    session_start();
    $hostname="localhost";
    $username="root";
    $password="";
    $database="tugas_akhir";
    $connect=new mysqli($hostname, $username, $password, $database);

    $username=$_POST['username'];
    $password=$_POST['password'];

    if($_GET['menu']=="login_user")
    {
        $sql="SELECT * from user where username='$username' and password='$password'";
        $query=mysqli_query($connect, $sql) or die(mysqli_error($connect));
        $cek=mysqli_num_rows($query);

        if($cek==1)
        {
            $_SESSION['username']=$username;
            $_SESSION['menu']="user";
            $_SESSION['status']="login";
            header("location:home.php");
        }
        else
        {
            header("location:index.php?pesan=gagal");
        }
    }
    else if($_GET['menu']=="register_user")
    {
        $sql1="SELECT * from user where username='$username'";
        $query1=mysqli_query($connect, $sql1) or die(mysqli_error($connect));
        $cek1=mysqli_num_rows($query1);

        if($cek1>0)
        {
            header("location:register_user.php?pesan=duplikat");
        }
        else
        {
            $sql2="INSERT INTO user VALUES('', '$username', '$password')";
            $query2=mysqli_query($connect, $sql2) or die(mysqli_error($connect));
            if($query2)
            {
                header("location:index.php?pesan=daftar_berhasil");
            }
        }
    }
    else if($_GET['menu']=="login_admin")
    {
        $sql="SELECT * from admin where username='$username' and password='$password'";
        $query=mysqli_query($connect, $sql) or die(mysqli_error($connect));
        $cek=mysqli_num_rows($query);

        if($cek==1)
        {
            $_SESSION['username']=$username;
            $_SESSION['menu']="admin";
            $_SESSION['status']="login";
            header("location:home_admin.php");
        }
        else
        {
            header("location:login_admin.php?pesan=gagal");
        }
    }
?>