<?php
    session_start();
    $hostname="localhost";
    $username="root";
    $password="";
    $database="tugas_akhir";
    $connect=new mysqli($hostname, $username, $password, $database);

    if($_GET['menu']=="konser")
    {
        $konser=$_POST['konser'];
        $artis=$_POST['artis'];
        $tempat=$_POST['tempat'];
        $tanggal=$_POST['tanggal'];
        $waktu=$_POST['waktu'];
        $gambar=$_POST['gambar'];
        $seatplan=$_POST['seatplan'];
        $deskripsi=$_POST['deskripsi'];
        $id=$_GET['id'];

        
        $sql0="SELECT id_konser from konser where konser.konser='$konser'";
        $query0=mysqli_query($connect,$sql0);
        $cek=mysqli_num_rows($query0);
        $cekid=mysqli_fetch_array($query0);

        if($cek>0 and $cekid['id_konser']!=$id)
        {
            header("location:edit_konser.php?id=".$id."&pesan=duplikat_konser");
        }
        else
        {
            $sql="UPDATE konser set konser='$konser', artis='$artis', tempat='$tempat', deskripsi='$deskripsi', gambar='$gambar', seatplan='$seatplan', tanggal='$tanggal', waktu='$waktu' where id_konser='$id'";
            $edit = mysqli_query($connect,$sql); 
            
            if($edit)
            {
                header("location:detail_konser.php?id=".$id."&pesan=sukses_edit");
            }
            else
            { 
                header("location:edit_konser.php?id=".$id."&pesan=gagal_konser");
            }  
        }
                
    } 
    else if($_GET['menu']=="section")
    {
        $id=$_GET['id'];
        $idsection=$_GET['idsection'];
        $section=$_POST['section'];
        $harga=$_POST['harga'];
        $kapasitas=$_POST['kapasitas'];

        $sql1="SELECT * from konser_".$id." where section='$section'";
        $query1=mysqli_query($connect,$sql1);
        $cek=mysqli_num_rows($query1);
        $cekid=mysqli_fetch_array($query1);

        if($cek>0 and $cekid['id_section']!=$idsection)
        {
            header("location:edit_section.php?id=".$id."&idsection=".$idsection."&pesan=duplikat");
        }
        else
        {
            $sql2="UPDATE konser_".$id." set section='$section', harga='$harga', kapasitas='$kapasitas' where id_section='$idsection'";
            $query2=mysqli_query($connect,$sql2);
            if($query2)
            {
                header("location:detail_konser.php?id=".$id."&pesan=sukses_edit_section");
            }
            else
            {
                header("location:edit_section.php?id=".$id."&idsection=".$idsection."&pesan=gagal");
            }
        }
    }
    else if($_GET['menu']=="admin")
    {
        $id=$_GET['id'];
        $username=$_POST['username'];
        $password=$_POST['password'];

        $sql1="SELECT * from admin where username='$username'";
        $query1=mysqli_query($connect,$sql1);
        $cek=mysqli_num_rows($query1);
        $cekid=mysqli_fetch_array($query1);

        if($cek>0 and $cekid['id_admin']!=$id)
        {
            header("location:edit_admin.php?id=".$id."&pesan=duplikat");
        }
        else
        {
            $sql2="UPDATE admin set username='$username', password='$password' where id_admin='$id'";
            $query2=mysqli_query($connect,$sql2);
            if($query2)
            {
                $_SESSION['username']=$username;
                header("location:admin.php?pesan=sukses_edit");
            }
            else
            {
                header("location:edit_admin.php?id=".$id."&pesan=gagal");
            }
        }
    }
?>