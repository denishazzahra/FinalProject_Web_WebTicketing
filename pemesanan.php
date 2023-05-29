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

    $id=$_GET['id'];
    $sql0="SELECT id_user from user where username='$currentuser'";
    $query0=mysqli_query($connect,$sql0);
    $data0=mysqli_fetch_array($query0);
    $sql1="SELECT * from konser where id_konser='$id'";
    $query1=mysqli_query($connect,$sql1);
    $data=mysqli_fetch_array($query1);
    $sql2="SELECT * from konser_".$id;
    $query2=mysqli_query($connect,$sql2);
    $sql3="SELECT * from user_order";
    $query3=mysqli_query($connect,$sql3);

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

        <div class="container">
            <div class="row">
                <center>
                    <h1 class="header"> Beli Tiket </h1>
                    <?php
                        if(isset($_GET['pesan']))
                        {
                            if($_GET['pesan']=="gagal")
                            {
                                echo "Gagal membeli tiket konser";
                            }
                            else if($_GET['pesan']=="overcapacity")
                            {
                                echo "Maaf, stok tiket tidak mencukupi.";
                            }
                        }
                        else
                        {
                            echo '<br>';
                        }
                    ?>
                    <div class="col-12">
                        <br><br>
                        <div class="card text-bg-dark mb-3" style="max-width: 550px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="<?=$data['gambar']?>"class="d-block w-100" style="height:220px; width:180px; object-fit:cover">
                                </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-text"><?=$data['konser']?></h5><br>
                                    <p class="card-text">Tanggal : <?=date('d F Y', strtotime($data['tanggal']))?></p>
                                    <p class="card-text">Waktu : <?=date('h:i A', strtotime($data['waktu']))?></p>
                                    <p class="card-text">Lokasi : <?=$data['tempat']?></p></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <h3> Detail Pemesan </h3>
                    <br> 
                    <form method="POST" action="pemesan_proses.php?id=<?=$id?>">
                        <div class="col-md-4" style="text-align:left;">
                            <input type="text" name="id_user" value="<?=$data0['id_user']?>" hidden>
                            <label for="inputname4" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" style="background-color:transparent; color:#ffffff" id="inputname4" name="nama" required><br>
                        </div>
                        <div class="col-md-4" style="text-align:left;">
                            <label for="inputno4" class="form-label">Nomor Handphone</label>
                            <input type="text" class="form-control" placeholder="Contoh : 6281234567890" style="background-color:transparent; color:#ffffff" id="inputno4" name="nohp" required><br>
                        </div>
                        <div class="col-4" style="text-align:left;">
                            <label for="inputemail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="inputemail" style="background-color:transparent; color:#ffffff" name="email" required><br>
                        </div>
                        <div class="col-4" style="text-align:left;">
                            <label for="inputAddress" class="form-label">Alamat</label>
                            <input type="text" class="form-control" style="background-color:transparent; color:#ffffff" id="inputAddress2" name="alamat" required><br>
                        </div>
                        <div class="col-md-4" style="text-align:left;">
                            <label for="inputsection" class="form-label">Section</label>
                            <select id="inputsection" class="form-select bg-dark text-white" name="section" required>
                                <?php
                                    while($data2=mysqli_fetch_array($query2))
                                    { ?>
                                        <option value="<?=$data2['id_section']?>"><?=$data2['section']." - Rp".nominal($data2['harga']).",00"?></option>
                                    <?php }
                                ?>
                            </select>
                            <br>
                        </div>
                        <div class="col-md-4" style="text-align:left;">
                            <label for="inputjml" class="form-label">Jumlah Tiket</label>
                            <input type="number" class="form-control" style="background-color:transparent; color:#ffffff" id="inputjml" name="jumlah" required><br>
                        </div>
                        <div class="col-md-4" style="text-align:left;">
                            <label for="inputinvoce" class="form-label">Metode Pembayaran (transfer)</label>
                            <select id="inputState" class="form-select bg-dark text-white" name="payment" required>
                                <option value="BCA">M-Banking (BCA: 07654321)</option>
                                <option value="Mandiri">M-Banking (Mandiri: 124456091)</option>
                                <option value="Go-pay">Go-pay</option>
                            </select>
                            <br>
                        </div>
                        <br>
                        <div class="row mb-3">
                            <div class="col-sm-8 offset-sm-2">
                                <input class="form-check-input" type="checkbox" style="background-color:bg-primary;" id="gridCheck" required>
                                <label class="form-check-label" for="gridCheck">
                                    Saya setuju dengan Syarat & Ketentuan yang berlaku di EVENTBRITE.
                                </label>
                                <br>
                            </div>
                        </div>
                        <br>
                        <div class="col-12">
                            <button type="button" class="btn btn-outline-light" style="border:1.5px solid #45a29e; background-color:none; color:white" onMouseOver="this.style.background='#45a29e'; this.style.color='white';" onMouseOut="this.style.background='none'; this.style.color='white';" data-bs-toggle="modal" data-bs-target="#exampleModal">Bayar Sekarang</button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" style="width:400px">
                                    <div class="modal-content bg-dark">
                                        <div class="modal-header bg-light" style="border:none; height:40px">
                                            <p class="modal-title" id="staticBackdropLabel" style="color:#6c757d; font-size:14px; font-weight:bold">EVENTBRITE</p>
                                            <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="border:none; font-size:18px; color:white">
                                            Pesan tiket konser '<?=$data['konser']?>'? Anda tidak dapat mengubah atau membatalkan pesanan setelah meninggalkan halaman ini.
                                        </div>
                                        <div class="modal-footer" style="border:none">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-light" style="border:1.5px solid #45a29e; background-color:#45a29e; color:white" onMouseOver="this.style.background='#3e918e'; this.style.color='white';" onMouseOut="this.style.background='#45a29e'; this.style.color='white';" data-bs-dismiss="modal" aria-label="Close">Pesan, bayar sekarang</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br><br>
                </center>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>
                       