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

        $sql0="SELECT konser from konser where konser.konser='$konser'";
        $query0=mysqli_query($connect,$sql0);
        $cek=mysqli_num_rows($query0);

        if($cek>0)
        {
            header("location:list_konser.php?pesan=duplikat");
        }
        else
        {
            $sql="INSERT into konser VALUES ('','$konser','$artis','$tempat','$deskripsi','$gambar','$seatplan','$tanggal','$waktu')";
            $query = mysqli_query($connect,$sql); 
            
            if($query)
            {
                $sql1="SELECT MAX(id_konser) as idmax from konser";
                $query1=mysqli_query($connect,$sql1);
                $select=mysqli_fetch_array($query1);
                $latestid=intval($select['idmax']);
                $sql2="CREATE TABLE konser_".$latestid." (id_section int NOT NULL AUTO_INCREMENT PRIMARY KEY, section VARCHAR(30) NOT NULL, harga INT NOT NULL, kapasitas INT NOT NULL , terisi INT NULL)";
                $query2=mysqli_query($connect,$sql2);
                header("location:detail_konser.php?id=".$latestid."&pesan=sukses_tambah");
            }
            else
            { 
                header("location:list_konser.php?pesan=gagal");
            }  
        }
    }
    else if($_GET['menu']=="section")
    {
        $id=$_GET['id'];
        $section=$_POST['section'];
        $harga=$_POST['harga'];
        $kapasitas=$_POST['kapasitas'];

        $sql1="SELECT * from konser_".$id." where section='$section'";
        $query1=mysqli_query($connect,$sql1);
        $cek=mysqli_num_rows($query1);

        if($cek>0)
        {
            header("location:tambah_section.php?id=".$id."&pesan=duplikat_section");
        }
        else
        {
            $sql2="INSERT INTO konser_".$id." VALUES('','$section','$harga','$kapasitas','0')";
            $query2=mysqli_query($connect,$sql2);
            if($query2)
            {
                header("location:detail_konser.php?id=".$id."&pesan=sukses_tambah_section");
            }
            else
            {
                header("location:tambah_section.php?id=".$id."&pesan=gagal_section");
            }
        }
    }
    else if($_GET['menu']=="admin")
    {
        $username=$_POST['username'];
        $password=$_POST['password'];
        $currentuser=$_SESSION['username'];
        $sql0="SELECT * from admin where username='$currentuser'";
        $query0=mysqli_query($connect,$sql0);
        $data0=mysqli_fetch_array($query0);
        $currentid=$data0['id_admin'];
        $sql1="SELECT * from admin where username='$username'";
        $query1=mysqli_query($connect,$sql1);
        $cek1=mysqli_num_rows($query1);

        if($cek1>0)
        {
            header("location:admin.php?pesan=duplikat_tambah");
        }
        else
        {
            $sql2="INSERT INTO admin VALUES('','$username','$password','$currentid')";
            $query2=mysqli_query($connect,$sql2);
            if($query2)
            {
                header("location:admin.php?pesan=sukses_tambah");
            }
            else
            {
                header("location:admin.php?pesan=gagal_tambah");
            }
        }
    }
?>