<?php
    session_start();
    if(empty($_SESSION['username']) or $_SESSION['menu']!="admin")
    {
        header("location:login_admin.php?pesan=belum_login");
    }
    $hostname="localhost";
    $username="root";
    $password="";
    $database="tugas_akhir";
    $connect=new mysqli($hostname, $username, $password, $database);
    
    $sql="SELECT * from konser";
    $query=mysqli_query($connect,$sql);
    $sql0="SELECT * from user_order";
    $query0=mysqli_query($connect,$sql0);
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
        <title>Penjualan</title>
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
                            <a class="nav-link" href="home_admin.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="list_konser.php">Konser</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" style="color:#66fcf1;" href="penjualan.php">Penjualan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">Admin</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item" style="float:right;">
                            <a class="nav-link" href="logout.php?menu=admin">Logout</a>
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
                        <h1 class=header>Penjualan</h1><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <?php
                        if(isset($_GET['expand']))
                        {
                            if($_GET['expand']=="true")
                            {
                                $namabutton="Sembunyikan Detail Pemesanan Tiket";
                                $link="penjualan.php";
                            }
                        }
                        else
                        {
                            $namabutton="Lihat Detail Pemesanan Tiket";
                            $link="penjualan.php?expand=true";
                        }
                        ?>
                        <a href="<?=$link?>" class="btn btn-outline-light" style="border-color:#45a29e; color:white;" onMouseOver="this.style.background='#45a29e'; this.style.color='white';" onMouseOut="this.style.background='none'; this.style.color='white';"><?=$namabutton?></a>
                    </div>
                </div>
                <?php
                if(isset($_GET['expand']))
                {
                    if($_GET['expand']=="true") 
                    {?>
                        <div class="row">
                            <div class="col">
                                <br>
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
                                    while ($data0 = mysqli_fetch_array($query0)){
                                    ?>
                                        <tr>
                                            <td><?=$data0['kdpesanan']?></td>
                                            <td style="width:200px"><?=$data0['nama']?></td>
                                            <?php
                                                $id_konser=$data0['id_konser'];
                                                $sql1="SELECT konser from konser where id_konser=$id_konser";
                                                $query1=mysqli_query($connect,$sql1);
                                                $data1=mysqli_fetch_array($query1);
                                                $id_section=$data0['id_section'];
                                                $sql2="SELECT section, harga from konser_".$id_konser." where id_section=$id_section";
                                                $query2=mysqli_query($connect,$sql2);
                                                $data2=mysqli_fetch_array($query2);
                                            ?>
                                            <td style="width:200px"><?=$data1['konser']?></td>
                                            <td><?=$data2['section']?></td>
                                            <td><?=$data0['jumlah']?></td>
                                            <td><?="Rp".nominal($data0['jumlah']*$data2['harga']).",00"?></td>
                                            <td>LUNAS</td>
                                            <td><a href="invoice_admin.php?id=<?=$data0['id']?>"><button type="button" class="btn btn-outline-light">Lihat Tiket</button></a></td>
                                        </tr>

                                        <?php 
                                        }
                                            ?>
                                </table>
                                <br>
                            </div>
                        </div>
                    <?php }
                } ?>
                <div class="row">
                    <div class="col">
                        <br>
                        <?php
                            $i=0;
                            $total=0;
                            while($data=mysqli_fetch_array($query))
                            {
                                $sql4="SELECT * from konser_".$data['id_konser'];
                                $query4=mysqli_query($connect,$sql4);
                                $subtotal[$i]=0;
                                $jumlah=0;
                                ?>
                                <h2 style="color:white"><?=$data['konser']?></h2><br><br>
                                <table class="table table-dark table-sm" style="text-align:center;">
                                    <tr>
                                        <th>Section</th>
                                        <th>Harga</th>
                                        <th>Terjual</th>
                                        <th>Subtotal</th>
                                    </tr>
                                    <?php
                                        while($data4=mysqli_fetch_array($query4))
                                        { ?>
                                            <tr>
                                                <td><?=$data4['section']?></td>
                                                <td><?="Rp".nominal($data4['harga']).",00"?></td>
                                                <td><?=nominal($data4['terisi'])?></td>
                                                <td><?="Rp".nominal($data4['terisi']*$data4['harga']).",00"?></td>
                                                <?php 
                                                    $subtotal[$i]+=$data4['terisi']*$data4['harga'];
                                                    $total+=$data4['terisi']*$data4['harga'];
                                                    $jumlah+=$data4['terisi'];
                                                ?>
                                            </tr>
                                    <?php } ?>
                                        <tr>
                                            <td></td>
                                            <th>Total</th>
                                            <td><?=nominal($jumlah)?></td>
                                            <td><?="Rp".nominal($subtotal[$i]).",00"?></td>
                                        </tr>
                                </table><br><br>
                                <?php $i+=1; 
                            } 
                        ?>
                    </div>
                    <div class="col">
                        <br>
                        <h2 style="color:white">Semua Konser</h2><br><br>
                        <table class="table table-dark table-sm" style="text-align:center;">
                            <tr>
                                <th>Konser</th>
                                <th>Penjualan</th>
                            </tr>
                            <?php
                                $sql3="SELECT * from konser";
                                $query3=mysqli_query($connect,$sql3);
                                $j=0;
                                while($data3=mysqli_fetch_array($query3))
                                { ?>
                                    <tr>
                                        <td><?=$data3['konser']?></td>
                                        <td><?="Rp".nominal($subtotal[$j]).",00"?></td>
                                    </tr>
                                <?php $j+=1; }
                            ?>
                            <tr>
                                <th>Total</th>
                                <td><?="Rp".nominal($total).",00"?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <br><br>
        </center>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>