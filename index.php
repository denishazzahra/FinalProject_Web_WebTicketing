<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>
    <body>
        <link rel="stylesheet" type="text/css" href="style.css">
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#none;">
            <div class="container-fluid">
                <span class="navbar-brand" style="color:#66fcf1; font-weight:bold;">EVENTBRITE</span>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item" style="float:right;">
                            <a class="nav-link active" style="color:#66fcf1;" href="index.php">User</a>
                        </li>
                        <li class="nav-item" style="float:right;">
                            <a class="nav-link" href="login_admin.php">Admin</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <br><br>
        <center>
            <h1 class="header">Login Page</h1>
            <p style="line-height:0.05;"><br></p>
            <table class="loginregister">
                <form method="POST" action="cek.php?menu=login_user">
                    <tr>
                        <td>
                            <?php
                                if(isset($_GET['pesan']))
                                {
                                    if($_GET['pesan']=="gagal")
                                    {
                                        echo '<p align="center" style="font-size:11pt; line-height:0.8;"><br>'."Username atau password salah".'</p>';
                                    }
                                    else if($_GET['pesan']=="logout")
                                    {
                                        echo '<p align="center" style="font-size:11pt; line-height:0.8;"><br>'."Anda telah berhasil logout".'</p>';
                                    }
                                    else if($_GET['pesan']=="belum_login")
                                    {
                                        echo '<p align="center" style="font-size:11pt; line-height:0.8;"><br>'."Akses ditolak, silakan login terlebih dahulu".'</p>';
                                    }
                                    else if($_GET['pesan']=="daftar_berhasil")
                                    {
                                        echo '<p align="center" style="font-size:11pt; line-height:0.8;"><br>'."Pendaftaran berhasil, silakan login".'</p>';
                                    }
                                }
                                else
                                {
                                    echo '<p align="center" style="font-size:11pt; line-height:0.8;"><br><br></p>';
                                }
                            ?>
                            <br>
                            <input class="form-control" type="text" name="username" placeholder="Username" aria-label="default input example" style="background-color:transparent; color:#ffffff" required>
                            <br>
                            <input class="form-control" type="password" name="password" placeholder="Password" aria-label="default input example" style="background-color:transparent; color:#ffffff" required>
                            <br><br>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-outline-light" style="border:1.5px solid #45a29e;" onMouseOver="this.style.background='#45a29e'; this.style.color='white';" onMouseOut="this.style.background='none'; this.style.color='white';">LOGIN</button>
                            </div>
                        </td>
                    </tr>
                    <tr><td><p align="center" style="font-size:11pt; line-height:1;"><br>Belum punya akun? <a href="register_user.php" style="color:#c5c6c7">Daftar di sini</a></p></td></tr>
                </form>
            </table>
        </center>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>