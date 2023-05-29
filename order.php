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
    $sql1="SELECT * from konser";
    $query1=mysqli_query($connect,$sql1);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Order Ticket</title>
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
                    <div class="col-12">
                        <h1 class="header" align="center">List Konser</h1>
                        <?php
                        $i=0;
                            while($data=mysqli_fetch_array($query1))
                            {
                                if($i%3==0)
                                {
                                    echo '<div class="row">';
                                }
                                echo '<div class="col-4">';
                            ?>
                                <br><br>
                                <div class="card text-bg-dark mb-3" style="text-align:center">
                                <img src="<?=$data['gambar']?>" style="height:200px; object-fit:cover;" class="card-img-top">
                                    <div class="card-body">
                                        <h5 class="card-title text-truncate"><?=$data['konser']?></h5>
                                        <p class="card-text text-truncate"><?=$data['deskripsi']?></p>
                                        <p class="event-price uk-text-light">
                                            Harga mulai :
                                            <span class="uk-text-bold" style="font-weight:bold;">
                                                <?php 
                                                    $sql0="SELECT MIN(harga) as hargamin from konser_".$data['id_konser'];
                                                    $query0=mysqli_query($connect,$sql0);
                                                    $select=mysqli_fetch_array($query0);
                                                    $hargamin=intval($select['hargamin']);
                                                    echo "Rp".nominal($hargamin).",00";
                                                ?>
                                            </span>
                                        </p>
                                        <a href="detail.php?id=<?=$data['id_konser']?>" class="btn btn-outline-light" style="border-color:#45a29e; color:#45a29e;" onMouseOver="this.style.background='#45a29e'; this.style.color='white';" onMouseOut="this.style.background='none'; this.style.color='#45a29e';">Lihat Detail</a>
                                    </div>
                                </div>
                                <?php
                                echo '</div>';
                                if($i%3==2)
                                {
                                    echo '</div>';
                                }
                                $i+=1;
                            }
                            if($i%3!=0)
                            {
                                echo '</div>';
                            }
                        ?>
                        <br><br>
        </center>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>