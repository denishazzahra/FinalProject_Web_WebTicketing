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
    
    $id=$_GET['id'];
    $sql1="SELECT * from konser where id_konser='$id'";
    $query1=mysqli_query($connect,$sql1);
    $data=mysqli_fetch_array($query1);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edit Konser <?=$data['konser']?></title>
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
                            <a class="nav-link active" style="color:#66fcf1;" href="list_konser.php">Konser</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="penjualan.php">Penjualan</a>
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
                    <div class="col-3"></div>
                    <div class="col-6" style="text-align:left">
                        <h1 class="header" align="center">Edit Konser</h1>
                        <center>
                            <?php
                                if(isset($_GET['pesan']))
                                {
                                    if($_GET['pesan']=="duplikat_konser")
                                    {
                                        echo "Nama konser sudah terpakai!";
                                    }
                                    else if($_GET['pesan']=="gagal_konser")
                                    {
                                        echo "Gagal mengedit data.";
                                    }
                                    else
                                    {
                                        echo '<br>';
                                    }
                                }
                                else
                                {
                                    echo '<br>';
                                }
                            ?>
                        </center>
                        <br>
                        <div class="row">
                            <form method="POST" action="edit_proses.php?menu=konser&id=<?=$_GET['id']?>">
                                <div class="row">
                                    <div class="col" style="text-align:left;">
                                        <label class="form-label">Nama Konser</label>
                                        <input class="form-control" type="text" name="konser" value="<?=$data['konser']?>" aria-label="default input example" style="background-color:transparent; color:#ffffff" required><br>
                                        <label class="form-label">Artis</label>
                                        <input class="form-control" type="text" name="artis" value="<?=$data['artis']?>" aria-label="default input example" style="background-color:transparent; color:#ffffff" required></textarea><br>
                                        <label class="form-label">Tempat</label>
                                        <input class="form-control" type="text" name="tempat" value="<?=$data['tempat']?>" aria-label="default input example" style="background-color:transparent; color:#ffffff" required><br>
                                        <div class="row">
                                            <div class="col">
                                                <label class="form-label">Tanggal</label>
                                                <input class="form-control" type="date" name="tanggal" value="<?=$data['tanggal']?>" aria-label="default input example" style="background-color:transparent; color:#ffffff" required><br>
                                            </div>
                                            <div class="col">
                                                <label class="form-label">Waktu</label>
                                                <input class="form-control" type="time" name="waktu" value="<?=$data['waktu']?>" aria-label="default input example" style="background-color:transparent; color:#ffffff" required><br>
                                            </div>
                                        </div>
                                        <label class="form-label">Poster Konser</label>
                                        <input class="form-control" type="text" name="gambar" value="<?=$data['gambar']?>" placeholder="Contoh : konser.jpg" aria-label="default input example" style="background-color:transparent; color:#ffffff" required><br>
                                        <label class="form-label">Seatplan</label>
                                        <input class="form-control" type="text" name="seatplan" value="<?=$data['seatplan']?>" placeholder="Contoh : seatplan.jpg" aria-label="default input example" style="background-color:transparent; color:#ffffff" required><br>
                                        <label class="form-label">Deskripsi Konser</label>
                                        <input class="form-control" type="text" name="deskripsi" value="<?=$data['deskripsi']?>" style="background-color:transparent; color:#ffffff" required></textarea><br>
                                        <div class="d-grid gap-2">
                                            <button type="submit" name="submit" value="submit" class="btn btn-outline-light" style="border:solid 1.5px #45a29e;" onMouseOver="this.style.background='#45a29e'; this.style.color='white';" onMouseOut="this.style.background='none'; this.style.color='white';">SIMPAN</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>      
                    </div>
                    <div class="col-3"></div>
                </div>
            </div>
            <br><br><br>
        </center>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>