<html>
	<head>
	<title>Spotify - Herkes için Müzik</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="css/main.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  

  
	</head>
	<body background="img/arkaPlan.jpg">
				<div class="container col-md-9">
		<div style="color:white" id="clock"></div>
		<script type="text/javascript">
		function refrClock()
		{
		var d=new Date();
		var s=d.getSeconds();
		var m=d.getMinutes();
		var h=d.getHours();
		var day=d.getDay();
		var date=d.getDate();
		var month=d.getMonth();
		var year=d.getFullYear();
		var days=new Array("Pazar","Pazartesi","Salı","Çarşamba","Perşembe","Cuma","Cumartesi");
		var months=new Array("Ocak","Şubat","Mart","Nisan","Mayıs","Haziran","Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık");
		if (s<10) {s="0" + s}
		if (m<10) {m="0" + m}
		document.getElementById("clock").innerHTML= "<b>Tarih:</b> " + date + " " + months[month] + " " + year + " " + days[day] + " | <b>Saat:</b> " + h + ":" + m + ":" + s + " "
		setTimeout("refrClock()",1000);
		}
		refrClock();
		</script>
		
		<div class="container col-md-3" style="float:right; margin-bottom:10px;">
		
		<?php 
		session_start(); include 'connection.php';
		if(isset($_SESSION["kullanici_ad"]) && isset($_SESSION["yetki"])){
			if($_SESSION["yetki"]==1){
	
			echo ' <a href="admin.php"><button type="button" class="btn btn-warning btn-sm">Yönetim Paneli</button></a> <a href="cikis.php"><button type="button" class="btn btn-danger btn-sm">Çıkış Yap</button></a>';
			} 
			
			
		}
		else{
			header('location:index.php');
		}
		?>
		
		</div>
			<div class="header col-md-12">
				<?php include "logo.php"; ?>
				<div style="float:left"class="menubar col-md-12">
				
					<ul style="margin-left:200px">
						<li><a href="index.php">Ana Sayfa</a></li>
						<li><a href="yenihaber.php">Sanatçı Kategori Ekle</a></li>
						<li><a href="kullanicilar.php">Kullanıcı Ekle</a></li>

					</ul>

				</div>
		<?php
		include 'connection.php';
		$sql = "select  * from kullanicilar where id=".$_GET["id"];
		$result = $conn->query($sql);
		if($result->num_rows>0){
			$rs = $result->fetch_object();
		}else{
			header("location:index.php");
		}
		
		?>
		<div class="container">
			<a style="margin-left:400px" href="index.php" class="btn btn-warning">Ana Sayfa</a><br><br>
			<form  style="margin-left:350px" class="form col-md-5" action="kaydet.php?islem=guncelle&id=<?php echo $rs->id?>" method="post">
				<div class="form-group">
					<label style="color:white">Ad Soyad:</label>
					<input value="<?php echo $rs->ad_soyad?>" class="form-control" name="ad_soyad" />
				</div>
				<br><br><br><br>
				<div class="form-group">
					<label style="color:white">Kullanıcı Adı:</label>
					<input value="<?php echo $rs->kullanici_ad?>" class="form-control" name="kullanici_ad" />
				</div>
				<br><br><br><br>
				<div class="form-group">
					<label style="color:white">Parola:</label>
					<input value="<?php echo $rs->parola?>" class="form-control" name="parola" />
				</div>
				<br><br><br><br>
				<div class="form-group">
					<label style="color:white">Yetki:</label>
					<select name="yetki" class="form-control">
						<option value="0">Yetki Seçiniz</option>
						<option <?php if($rs->yetki==1) echo "selected"?> value="1">Admin</option>
						<option <?php if($rs->yetki==2) echo "selected"?> value="2">Editör</option>
					</select>
				</div>
				<br><br><br><br>
				<div class="form-group">
					<input type="submit" class="form-control btn btn-success" value="Kaydet" />
				</div>
			</form>
		</div>
		
		
		</body>	
		
</html>