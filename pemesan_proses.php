<?php
    session_start();
    $hostname="localhost";
    $username="root";
    $password="";
    $database="tugas_akhir";
    $connect=new mysqli($hostname, $username, $password, $database);

    $query3 = mysqli_query($connect, "SELECT max(kdpesanan) as maxKode FROM user_order");
	$data3  = mysqli_fetch_array($query3);
	$kdpesanan = $data3['maxKode'];
	$noUrut = (int) substr($kdpesanan, 4, 4);
	$noUrut++;
	
	$char = "BOK";
	$newID = $char . sprintf("%04s", $noUrut);
	
	$idkonser = $_GET['id'];
	$iduser = $_POST['id_user'];
	$nama	= $_POST['nama'];
    $email  = $_POST['email'];
    $nohp  = $_POST['nohp'];
    $alamat  = $_POST['alamat'];
    $idsection = $_POST['section'];
    $jumlah = $_POST['jumlah'];
    $payment = $_POST['payment'];

	$sql0="SELECT * from konser_".$idkonser." where id_section='$idsection'";
	$query0=mysqli_query($connect,$sql0);
	$cek=mysqli_fetch_array($query0);
	$available=$cek['kapasitas']-$cek['terisi'];
	if($jumlah<=$available)
	{
		$sql4	= "INSERT INTO user_order VALUES('', '$iduser', '$idkonser', '$idsection', '$newID', '$nama', '$email','$nohp', '$alamat', '$jumlah', '$payment')";
		$query4	= mysqli_query($connect, $sql4) or die(mysqli_error($connect));
		$sql5="UPDATE konser_".$idkonser." set terisi=terisi+$jumlah where id_section='$idsection'";
		$query5= mysqli_query($connect,$sql5);

		if($query4) {
			header("location:riwayat.php");
		} else {
			header("location:pemesanan.php?id=".$idkonser."&pesan=gagal");
		}
	}
	else
	{
		header("location:pemesanan.php?id=".$idkonser."&pesan=overcapacity");
	}
?>