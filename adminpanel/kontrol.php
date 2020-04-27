<?php 
session_start();
	
	include "connection.php";
	
	$k_adi = $_POST["kad"];
	$sifre = $_POST["parola"];
	
	$k_adi1 = mysqli_real_escape_string($conn,$k_adi);
	$sifre_1 = mysqli_real_escape_string($conn,$sifre);
	
	$k_adi2 = htmlspecialchars(mysqli_real_escape_string($conn,$k_adi1), ENT_QUOTES, 'UTF-8');
	$sifre_2 = htmlspecialchars(mysqli_real_escape_string($conn,$sifre_1), ENT_QUOTES, 'UTF-8');
	
	$sql = "select * from kullanicilar 
	where kullanici_ad='".$k_adi2."' AND parola='".$sifre_2."'";
	
	$sonuc = $conn->query($sql);
	
	if($sonuc->num_rows>0){
		
		$rs = $sonuc->fetch_object();
		//Kullanıcı adı parolası doğru
		$_SESSION["giris"]=1;
		$_SESSION["kullanici_ad"] = $rs->kullanici_ad;
		$_SESSION["yetki"] = $rs->yetki;
		$_SESSION["kullanici_id"] = $rs->id;
		header('location:../index.php');
	} else {
		//Kullanıcı adı veya parolası hatalı
		header('location:login.php?hata=1');
	}
?>