<?php
    session_start();
    if(empty($_SESSION['username']) or $_SESSION['menu']!="user")
    {
        header("location:index.php?pesan=belum_login");
    }
    $hostname="localhost";
    $username="root";
    $password="";
    $database="tugas_akhir";
    $connect=new mysqli($hostname, $username, $password, $database);

    if(isset($_GET['id'])){
        $id    =$_GET['id'];
    }
    else {
        die ("Error. No ID Selected!");    
    }

    $id=$_GET['id'];
    $sql1="SELECT * from user_order where id='$id'";
    $query1=mysqli_query($connect,$sql1);
    $data= mysqli_fetch_array($query1);
    $id_konser=$data['id_konser'];
    $id_section=$data['id_section'];
    $sql2="SELECT * from konser where id_konser='$id_konser'";
    $query2= mysqli_query($connect,$sql2);
    $data2= mysqli_fetch_array($query2);
    $sql3="SELECT * from konser_".$id_konser." where id_section='$id_section'";
    $query3= mysqli_query($connect,$sql3);
    $data3= mysqli_fetch_array($query3);
    $total=NULL;

    function nominal(string $a)
    {
        $temp="";
        for($i=strlen($a)-1; $i>=0; $i--)
        {
            $temp=$temp.$a[$i];
            if(abs($i-(strlen($a)-1))%3==2 && $i!=0)
            {
                $temp=$temp.".";
            }
        }
        return strrev($temp);
    }

    function phone(string $a)
    {
        //+62 xxx-xxxx-xxxx
        $temp="+";
        for($i=0; $i<strlen($a); $i++)
        {
            $temp=$temp.$a[$i];
            if($i==1)
            {
                $temp=$temp." ";
            }
            else if($i%4==0 and !($i<=1 or $i==strlen($a)-1 or $i>=12))
            {
                $temp=$temp."-";
            }
        }
        return $temp;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Invoice</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>
    <body>
        <link rel="stylesheet" type="text/css" href="style.css">
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:none;">
            <div class="container-fluid">
                <span class="navbar-brand" style="color:#66fcf1; font-weight:bold;">EVENTBRITE</span>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="order.php">Beli Tiket</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" style="color:#66fcf1;" href="riwayat.php">Riwayat</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item" style="float:right;">
                            <a class="nav-link" href="logout.php?menu=user">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <br><br>
        <center>
            <h1 class="header">E-Ticket</h1><br>
            <div class="container" style="background-color:#212429; width:800px">
                <div class="row">
                    <div class="col-4">
                        <img src="<?=$data2['gambar']?>" style="height:300px; width:250px; object-fit:cover">
                    </div>
                    <div class="col-8">
                        <br>
                        <h4 style="text-align:center; color:white;"><?=$data2['konser']?></h3>
                        <div class="row">
                            <div class="col-5" style="font-weight:bold">Kode Pesanan</div>
                            <div class="col-1">:</div>
                            <div class="col-6"><?=$data['kdpesanan']?></div>
                        </div>
                        <div class="row">
                            <div class="col-5" style="font-weight:bold">Nama Lengkap</div>
                            <div class="col-1">:</div>
                            <div class="col-6"><?=$data['nama']?></div>
                        </div>
                        <div class="row">
                            <div class="col-5" style="font-weight:bold">Email</div>
                            <div class="col-1">:</div>
                            <div class="col-6"><?=$data['email']?></div>
                        </div>
                        <div class="row">
                            <div class="col-5" style="font-weight:bold">No. Telp</div>
                            <div class="col-1">:</div>
                            <div class="col-6"><?=phone($data['nohp'])?></div>
                        </div>
                        <div class="row">
                            <div class="col-5" style="font-weight:bold">Section</div>
                            <div class="col-1">:</div>
                            <div class="col-6"><?=$data3['section']?></div>
                        </div>
                        <div class="row">
                            <div class="col-5" style="font-weight:bold">Jumlah Tiket</div>
                            <div class="col-1">:</div>
                            <div class="col-6"><?=$data['jumlah']?></div>
                        </div>
                        <div class="row">
                            <div class="col-5" style="font-weight:bold">Total Bayar</div>
                            <div class="col-1">:</div>
                            <div class="col-6"><?="Rp".nominal($data['jumlah']*$data3['harga']).",00"?></div>
                        </div>
                        <div class="row">
                            <div class="col-5" style="font-weight:bold">Metode Pembayaran</div>
                            <div class="col-1">:</div>
                            <div class="col-6"><?=$data['payment']?></div>
                        </div>
                        <div class="row">
                            <div class="col-5" style="font-weight:bold">Status Pembayaran</div>
                            <div class="col-1">:</div>
                            <div class="col-6" style="font-weight:bold; color:#04aa6d">LUNAS<br><br></div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <a href="riwayat.php" class="btn btn-outline-light" style="border-color:#45a29e; color:white;" onMouseOver="this.style.background='#45a29e'; this.style.color='white';" onMouseOut="this.style.background='none'; this.style.color='white';">Kembali</a>
        </center>
        <br><br><br>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>


