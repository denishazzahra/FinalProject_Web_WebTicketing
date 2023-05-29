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
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
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
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item" style="float:right;">
                            <a class="nav-link" href="logout.php?menu=user">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <br><br><br><br><br>

        <div class="container" style="width:800px;">
            <div class="row">
                <div class="col" style="border-bottom: 1px solid #3c3f44;">
                    <h1 class="header" align="center">Selamat datang, <?=$_SESSION['username']?>!</h1><br>
                </div>
            </div> 
            <div class="row">
                <div class="col">
                    <br>
                    <a href="order.php" style="text-decoration:none">
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-outline-light" style="border:solid 1.5px #45a29e;" onMouseOver="this.style.background='#45a29e'; this.style.color='white';" onMouseOut="this.style.background='none'; this.style.color='white';">Beli Tiket</button>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <br>
                    <a href="riwayat.php" style="text-decoration:none">
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-outline-light" style="border:solid 1.5px #45a29e;" onMouseOver="this.style.background='#45a29e'; this.style.color='white';" onMouseOut="this.style.background='none'; this.style.color='white';">Riwayat</button>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>