<?php
session_start();
	include 'connection.php'; //1.Adım
	if(isset($_GET["islem"])){ 
		if($_GET["islem"]=="yeni"){
			$sql = "insert  into kullanicilar set 
			ad_soyad='".$_POST["ad_soyad"]."',
			kullanici_ad='".$_POST["kullanici_ad"]."',
			parola='".$_POST["parola"]."',
			yetki='".$_POST["yetki"]."'";//2.Adım
			
			$conn->query($sql); //3.Adım
			
			header("location:index.php");
		}elseif($_GET["islem"]=="sil"){
			$sql = "delete from kullanicilar where id=".$_GET["id"];//2.ADIM
			$conn->query($sql);
			
			header("location:index.php");//3.ADIM
		}elseif($_GET["islem"]=="guncelle"){
			$sql = "update kullanicilar set 
			ad_soyad='".$_POST["ad_soyad"]."',
			kullanici_ad='".$_POST["kullanici_ad"]."',
			parola='".$_POST["parola"]."',
			yetki='".$_POST["yetki"]."' where id=".$_GET["id"];//2.Adım
			
			$conn->query($sql); //3.Adım
			
			header("location:index.php");
		}elseif($_GET["islem"]=="yenikategori"){
			$sql = "insert into kategoriler set kategori='".$_POST["kategori"]."'";
			$conn->query($sql);
			header('location:kategoriler.php');
		}elseif($_GET["islem"]=="kategorisil"){
			$sql = "delete from kategoriler where id=".$_GET["id"];
			$conn->query($sql);
			header('location:kategoriler.php');
		}elseif($_GET["islem"]=="kategoriguncelle"){
			$sql = "update kategoriler set kategori='".$_POST["kategori"]."' where id=".$_GET["id"];
			$conn->query($sql);
			header('location:kategoriler.php');
		}elseif($_GET["islem"]=="yenihaber"){
			$yol = "../upload/";
			$target_file = $yol . basename($_FILES["resim"]["name"]);
			move_uploaded_file($_FILES["resim"]["tmp_name"], $target_file);
			
			$resim = $_FILES["resim"]["name"];
			$sql = "insert into haberler set 
			baslik='".$_POST["baslik"]."',
			aciklama='".$_POST["aciklama"]."',
			resim='".$resim."',
			durum='".$_POST["durum"]."',
			kullanici_id='".$_SESSION["kullanici_id"]."',
			kategori_id='".$_POST["kategori_id"]."'";
			$conn->query($sql);
			header('location:haberler.php');
		}elseif($_GET["islem"]=="habersil"){
			$sql = "delete from haberler where id=".$_GET["id"];
			$conn->query($sql);
			header('location:haberler.php');
		}elseif($_GET["islem"]=="haberguncelle"){
			if($_FILES["resim"]["name"]!=""){
				$yol = "../upload/";
				$target_file = $yol . basename($_FILES["resim"]["name"]);
				move_uploaded_file($_FILES["resim"]["tmp_name"], $target_file);
				
				$resim = $_FILES["resim"]["name"];
				$sql = "update haberler set 
				baslik='".$_POST["baslik"]."',
				aciklama='".$_POST["aciklama"]."',
				resim='".$resim."',
				durum='".$_POST["durum"]."',
				kullanici_id='".$_SESSION["kullanici_id"]."',
				kategori_id='".$_POST["kategori_id"]."' where id=".$_GET["id"];
			}else{
				
				$sql = "update haberler set 
				baslik='".$_POST["baslik"]."',
				aciklama='".$_POST["aciklama"]."',				
				durum='".$_POST["durum"]."',
				kullanici_id='".$_SESSION["kullanici_id"]."',
				kategori_id='".$_POST["kategori_id"]."' where id=".$_GET["id"];
			}
			$conn->query($sql);
			
			header('location:haberler.php');
		}
		
	}else{
		header("location:index.php");
	}
?>