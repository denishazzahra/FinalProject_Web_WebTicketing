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
    $currentuser=$_SESSION['username'];
    $sql0="SELECT * from admin where username='$currentuser'";
    $query0=mysqli_query($connect,$sql0);
    $data0=mysqli_fetch_array($query0);
    $currentid=$data0['id_admin'];

    $sql1="SELECT * from admin";
    $query1=mysqli_query($connect,$sql1);
?>
<html>
    <head>
        <title>Admin</title>
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
                            <a class="nav-link" href="penjualan.php">Penjualan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" style="color:#66fcf1;" href="admin.php">Admin</a>
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
                    <div class="col-6">
                        <h1 class="header">List Admin</h1>
                        <?php
                            if(isset($_GET['pesan']))
                            {
                                if($_GET['pesan']=="sukses_edit")
                                {
                                    echo "Admin berhasil diedit.";
                                }
                                else if($_GET['pesan']=="sukses_hapus")
                                {
                                    echo "Admin berhasil dihapus.";
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
                            <div class="col">
                                <br><br>
                                <table class="table table-dark table-sm" style="text-align:center;">
                                    <tr>
                                        <th>No.</th>
                                        <th>Username</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                    <?php
                                        $i=1;
                                        while($data1=mysqli_fetch_array($query1))
                                        { ?>
                                            <tr>
                                                <td><?=$i?></td>
                                                <td><?=$data1['username']?></td>
                                                <?php
                                                    if($_SESSION['username']==$data1['username'])
                                                    { ?>
                                                        <td><a href="edit_admin.php?id=<?=$data1['id_admin']?>"><button class="btn btn-outline-light">Edit</button></a></td>
                                                        <?php
                                                            if($data1['tambah_oleh']!=NULL)
                                                            { ?>
                                                                <td>
                                                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-bs-whatever="<?=$data1['id_admin']?>" data-bs-whatever2="<?=$data1['username']?>">Delete</button>
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
                                                                </td>
                                                            <?php }
                                                            else
                                                            { ?>
                                                                <td><button class="btn btn-outline-danger" disabled>Delete</button></td>
                                                            <?php 
                                                        }
                                                    }
                                                    else
                                                    { ?>
                                                        <td><button class="btn btn-outline-light" disabled>Edit</button></td>
                                                        <?php
                                                            if($data1['tambah_oleh']==$currentid)
                                                            { ?>
                                                                <td>
                                                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-bs-whatever="<?=$data1['id_admin']?>" data-bs-whatever2="<?=$data1['username']?>">Delete</button>
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
                                                                </td>
                                                            <?php }
                                                            else
                                                            { ?>
                                                                <td><button class="btn btn-outline-danger" disabled>Delete</button></td>
                                                            <?php
                                                        }
                                                    }
                                                ?>
                                            </tr>
                                        <?php $i+=1; 
                                        }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-5">
                        <h1 class="header">Tambah Admin</h1>
                        <?php
                            if(isset($_GET['pesan']))
                            {
                                if($_GET['pesan']=="duplikat_tambah")
                                {
                                    echo "Username sudah terdaftar sebelumnya.";
                                }
                                else if($_GET['pesan']=="sukses_tambah")
                                {
                                    echo "Admin berhasil ditambahkan.";
                                }
                                else if($_GET['pesan']=="gagal_tambah")
                                {
                                    echo "Gagal menambahkan admin.";
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
                            <form method="POST" action="tambah.php?menu=admin">
                                <div class="col" style="text-align:left;">
                                    <br><br>
                                    <input class="form-control" type="text" name="username" placeholder="Username" aria-label="default input example" style="background-color:transparent; color:#ffffff" required><br>
                                    <input class="form-control" type="password" name="password" placeholder="Password" aria-label="default input example" style="background-color:transparent; color:#ffffff" required><br>
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-outline-light" style="border:solid 1.5px #45a29e;" onMouseOver="this.style.background='#45a29e'; this.style.color='white';" onMouseOut="this.style.background='none'; this.style.color='white';">SIMPAN</button>
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
            const id_admin = button.getAttribute('data-bs-whatever')
            const admin = button.getAttribute('data-bs-whatever2')
            const modalTitle = exampleModal.querySelector('.modal-title')
            const modalBody = exampleModal.querySelector('.modal-body')
            document.getElementById('deleteButton').href = `hapus.php?id=${id_admin}&menu=admin`
            modalTitle.textContent = `EVENTBRITE`
            modalBody.textContent = `Hapus admin '${admin}'?`
            })
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>