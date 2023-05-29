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
    $currentuser=$_SESSION['username'];
    $sql0="SELECT id_user from user where username='$currentuser'";
    $query0=mysqli_query($connect,$sql0);
    $data0=mysqli_fetch_array($query0);
    $id_user=$data0['id_user'];
    $sql="SELECT * from user_order where id_user=$id_user";
    $query=mysqli_query($connect,$sql);

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
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Riwayat</title>
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
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1 class=header>Riwayat</h1><br><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table table-dark table-sm" style="text-align:center;">
                            <tr>
                                <th>Kode Pesanan</th>
                                <th style="width:200px">Nama Lengkap</th>
                                <th style="width:200px">Konser</th>
                                <th>Section</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Status Pembayaran</th>
                                <th>Action</th>
                            </tr>

                            <?php
                            while ($data = mysqli_fetch_array($query)){
                            ?>
                                <tr>
                                    <td><?=$data['kdpesanan']?></td>
                                    <td style="width:200px"><?=$data['nama']?></td>
                                    <?php
                                        $id_konser=$data['id_konser'];
                                        $sql1="SELECT konser from konser where id_konser=$id_konser";
                                        $query1=mysqli_query($connect,$sql1);
                                        $data1=mysqli_fetch_array($query1);
                                        $id_section=$data['id_section'];
                                        $sql2="SELECT section, harga from konser_".$id_konser." where id_section=$id_section";
                                        $query2=mysqli_query($connect,$sql2);
                                        $data2=mysqli_fetch_array($query2);
                                    ?>
                                    <td style="width:200px"><?=$data1['konser']?></td>
                                    <td><?=$data2['section']?></td>
                                    <td><?=$data['jumlah']?></td>
                                    <td><?="Rp".nominal($data['jumlah']*$data2['harga']).",00"?></td>
                                    <td>LUNAS</td>
                                    <td><a href="invoice.php?id=<?=$data['id']?>"><button type="button" class="btn btn-outline-light">Lihat Tiket</button></a></td>
                                </tr>

                                <?php 
                                }
                                    ?>
                        </table>
                        <br><br>
                    </div>
                </div>
            </div>
        </center>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>