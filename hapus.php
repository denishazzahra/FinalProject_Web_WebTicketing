<?php
    session_start();
    $hostname="localhost";
    $username="root";
    $password="";
    $database="tugas_akhir";
    $connect=new mysqli($hostname, $username, $password, $database);
    if($_GET['menu']=="konser")
    {
        $id=$_GET['id'];
        $sql1="DELETE from konser where id_konser='$id'";
        $query1=mysqli_query($connect,$sql1);
        if($query1)
        {
            $sql2="DROP table konser_".$id;
            $query2=mysqli_query($connect,$sql2);
            if($query2)
            {
                $sql3="DELETE from user_order where id_konser='$id'";
                $query3=mysqli_query($connect,$sql3);
                header("location:list_konser.php?pesan=sukses_hapus");
            }
        }
    }
    else if($_GET['menu']=="section")
    {
        $id=$_GET['id'];
        $idsection=$_GET['idsection'];
        $sql1="DELETE from konser_".$id." where id_section='$idsection'";
        $query1=mysqli_query($connect,$sql1);
        if($query1)
        {
            $sql2="DELETE from user_order where id_konser='$id' and id_section='$idsection'";
            $query2=mysqli_query($connect,$sql2);
            header("location:detail_konser.php?id=".$id."&pesan=sukses_hapus_section");
        }
    }
    else if($_GET['menu']=="admin")
    {
        $id=$_GET['id'];
        $sql="SELECT username from admin where id_admin='$id'";
        $query=mysqli_query($connect,$sql);
        $userdel=mysqli_fetch_array($query);
        $sql1="DELETE from admin where id_admin='$id'";
        $query1=mysqli_query($connect,$sql1);
        if($query1)
        {
            if($userdel['username']==$_SESSION['username'])
            {
                header("location:logout.php?menu=admin");
            }
            else
            {
                header("location:admin.php?pesan=sukses_hapus");
            }
        }
    }
?>