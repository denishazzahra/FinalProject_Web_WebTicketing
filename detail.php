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

    $id=$_GET['id'];
    $sql1="SELECT * from konser where id_konser='$id'";
    $query1=mysqli_query($connect,$sql1);
    $data=mysqli_fetch_array($query1);
    $sql2="SELECT * from konser_".$id;
    $query2=mysqli_query($connect,$sql2);
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
        <title><?=$data['konser']?></title>
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
                            <a class="nav-link active" style="color:#66fcf1;" href="order.php">Beli Tiket</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="riwayat.php">Riwayat</a>
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
                        <h1 class="header" align="center"><?=$data['konser']?></h1>
                        <br><br><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false" style="width:400px; object-fit:cover">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                <img src="<?=$data['gambar']?>" class="d-block w-100">
                                </div>
                                <div class="carousel-item">
                                <img src="<?=$data['seatplan']?>" class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <br><br><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col" style="text-align:left">
                        <h2 style="color:white">Deskripsi</h2><br>
                        <div class="row">
                            <div class="col-3" style="font-weight:bold">Deskripsi</div>
                            <div class="col-1">:</div>
                            <div class="col-8"><?=$data['deskripsi']?></div>
                        </div>
                        <div class="row">
                            <div class="col-3" style="font-weight:bold">Artis</div>
                            <div class="col-1">:</div>
                            <div class="col-8"><?=$data['artis']?></div>
                        </div>
                        <div class="row">
                            <div class="col-3" style="font-weight:bold">Tempat</div>
                            <div class="col-1">:</div>
                            <div class="col-8"><?=$data['tempat']?></div>
                        </div>
                        <div class="row">
                            <div class="col-3" style="font-weight:bold">Tanggal</div>
                            <div class="col-1">:</div>
                            <div class="col-8"><?=date('d F Y', strtotime($data['tanggal']))?></div>
                        </div>
                        <div class="row">
                            <div class="col-3" style="font-weight:bold">Waktu</div>
                            <div class="col-1">:</div>
                            <div class="col-8"><?=date('h:i A', strtotime($data['waktu']))?></div>
                        </div>
                        <br>
                    </div>
                    <div class="col">
                        <h2 style="color:white" align="left">Seatplan</h2>
                        <br>
                        <table class="table table-dark table-sm" style="text-align:center;">
                            <tr>
                                <th>Section</th>
                                <th>Harga</th>
                                <th>Tersedia</th>
                            </tr>
                            <?php
                                while($data2=mysqli_fetch_array($query2))
                                { ?>
                                    <tr>
                                        <td><?=$data2['section']?></td>
                                        <td><?="Rp".nominal($data2['harga']).",00"?></td>
                                        <td><?=nominal($data2['kapasitas']-$data2['terisi'])?></td>
                                    </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <a href="pemesanan.php?id=<?=$data['id_konser']?>" class="btn btn-outline-light" style="border-color:#45a29e; color:white;" onMouseOver="this.style.background='#45a29e'; this.style.color='white';" onMouseOut="this.style.background='none'; this.style.color='white';">Beli Tiket</a>
            <br><br><br>
        </center>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>