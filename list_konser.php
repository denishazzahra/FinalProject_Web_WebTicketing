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

    $sql1="SELECT * from konser";
    $query1=mysqli_query($connect,$sql1);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Konser</title>
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
                    <div class="col-7">
                        <h1 class="header" align="center">List Konser</h1>
                        <?php
                            if(isset($_GET['pesan']))
                            {
                                if($_GET['pesan']=="sukses_hapus")
                                {
                                    echo "Konser berhasil dihapus.";
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
                            $i=0;
                            while($data=mysqli_fetch_array($query1))
                            {
                                if($i%2==0)
                                {
                                    echo '<div class="row">';
                                }
                                echo '<div class="col-6">';
                            ?>
                                <br><br>
                                <div class="card text-bg-dark mb-3" style="text-align:center">
                                    <img src="<?=$data['gambar']?>" style="height:200px; object-fit:cover;" class="card-img-top">
                                    <div class="card-body">
                                        <h5 class="card-title text-truncate"><?=$data['konser']?></h5>
                                        <p class="card-text text-truncate"><?=$data['deskripsi']?></p>
                                        <a href="detail_konser.php?id=<?=$data['id_konser']?>" class="btn btn-outline-light" style="border-color:#45a29e; color:#45a29e;" onMouseOver="this.style.background='#45a29e'; this.style.color='white';" onMouseOut="this.style.background='none'; this.style.color='#45a29e';">Detail</a>
                                        <a href="edit_konser.php?id=<?=$data['id_konser']?>" class="btn btn-outline-light">Edit</a>
                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-bs-whatever="<?=$data['id_konser']?>" data-bs-whatever2="<?=$data['konser']?>">Delete</button>
                                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" style="width:400px">
                                                <div class="modal-content bg-dark">
                                                    <div class="modal-header bg-light" style="border:none; height:40px">
                                                        <p class="modal-title" id="staticBackdropLabel" style="color:#6c757d; font-size:14px; font-weight:bold"></p>
                                                        <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" style="border:none; font-size:18px"></div>
                                                    <div class="modal-footer" style="border:none">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <a href="" id="deleteButton" class="btn btn-danger">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                echo '</div>';
                                if($i%2==1)
                                {
                                    echo '</div>';
                                }
                                $i+=1;
                            }
                            if($i%2==1)
                            {
                                echo '</div>';
                            }
                        ?>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-4">
                        <h1 class="header">Tambah Konser</h1>
                        <?php
                            if(isset($_GET['pesan']))
                            {
                                if($_GET['pesan']=="gagal")
                                {
                                    echo "Gagal menambahkan konser.";
                                }
                                else if($_GET['pesan']=="duplikat")
                                {
                                    echo "Nama konser sudah terpakai.";
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
                        <div class="row">
                            <form method="POST" action="tambah.php?menu=konser">
                                <div class="row">
                                    <div class="col" style="text-align:left;">
                                        <br>
                                        <label class="form-label">Nama Konser</label>
                                        <input class="form-control" type="text" name="konser" aria-label="default input example" style="background-color:transparent; color:#ffffff" required><br>
                                        <label class="form-label">Artis</label>
                                        <textarea class="form-control" name="artis" id="exampleFormControlTextarea1" rows="1" style="background-color:transparent; color:#ffffff" required></textarea><br>
                                        <label class="form-label">Tempat</label>
                                        <input class="form-control" type="text" name="tempat" aria-label="default input example" style="background-color:transparent; color:#ffffff" required><br>
                                        <div class="row">
                                            <div class="col">
                                                <label class="form-label">Tanggal</label>
                                                <input class="form-control" type="date" name="tanggal" aria-label="default input example" style="background-color:transparent; color:#ffffff" required><br>
                                            </div>
                                            <div class="col">
                                                <label class="form-label">Waktu</label>
                                                <input class="form-control" type="time" name="waktu" aria-label="default input example" style="background-color:transparent; color:#ffffff" required><br>
                                            </div>
                                        </div>
                                        <label class="form-label">Poster Konser</label>
                                        <input class="form-control" type="text" name="gambar" placeholder="Contoh : konser.jpg" aria-label="default input example" style="background-color:transparent; color:#ffffff" required><br>
                                        <label class="form-label">Seatplan</label>
                                        <input class="form-control" type="text" name="seatplan" placeholder="Contoh : seatplan.jpg" aria-label="default input example" style="background-color:transparent; color:#ffffff" required><br>
                                        <label class="form-label">Deskripsi Konser</label>
                                        <textarea class="form-control" name="deskripsi" id="exampleFormControlTextarea1" rows="1" style="background-color:transparent; color:#ffffff" required></textarea><br>
                                        <div class="d-grid gap-2">
                                            <button type="submit" name="submit" value="submit" class="btn btn-outline-light" style="border:solid 1.5px #45a29e;" onMouseOver="this.style.background='#45a29e'; this.style.color='white';" onMouseOut="this.style.background='none'; this.style.color='white';">SIMPAN</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br>
        </center>
        <script>
            const exampleModal = document.getElementById('staticBackdrop')
            exampleModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget
            const id_konser = button.getAttribute('data-bs-whatever')
            const konser = button.getAttribute('data-bs-whatever2')
            const modalTitle = exampleModal.querySelector('.modal-title')
            const modalBody = exampleModal.querySelector('.modal-body')
            document.getElementById('deleteButton').href = `hapus.php?id=${id_konser}&menu=konser`
            modalTitle.textContent = `EVENTBRITE`
            modalBody.textContent = `Hapus konser '${konser}'?`
            })
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>