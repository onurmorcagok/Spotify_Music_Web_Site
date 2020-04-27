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
				<div class="icerik col-md-9">
				<?php
				if($_SESSION["yetki"]==1){
				?>
					<a href="haberler.php" style="margin-left:400px" class="btn btn-info">Tüm Haberler</a>
					<form enctype="multipart/form-data" name="haber" action="kaydet.php?islem=yenihaber" method="post">
					<table style="margin-left:130px" class="table table-hover">
						<tr>
							<td style="color:white">Sanatçı Adı</td>
							<td><input type="text" class="form-control" name="baslik" /></td>
						</tr>
						<tr>
							<td style="color:white">Sanatçı Hakkında</td>
							<td><textarea name="aciklama" class="form-control"></textarea></td>
						</tr>
						<tr>
							<td style="color:white">Resim</td>
							<td><input type="file" name="resim" /></td>
						</tr>
						<tr>
							<td style="color:white">Sanatçı Kategorisi</td>
							<td>
								<select class="form-control" name="kategori_id">
									<option value="0">Kategori Seçiniz</option>
								<?php
									$sql = "select * from kategoriler order by kategori";
									$result = $conn->query($sql);
									while($rs = $result->fetch_object()){
								?>
									<option value="<?php echo $rs->id?>"><?php echo $rs->kategori?></option>
								<?php
										
									}
								
								?>
								</select>
							</td>
						</tr>
						<tr>
							<td style="color:white">Durum</td>
							<td>
								<select class="form-control" name="durum">
									<option value="0">Yayınlama</option>
									<option value="1">Yayınla</option>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="2"><input class="btn btn-warning" style="margin-left:280px" type="submit" value="Kaydet" /></td>
							
						</tr>
					</table>
					</form>
					
				<?php
				}else{
					echo "<h1>Bu sayfayı görmeye yetkiniz bulunmamaktadır</h1>";
				}
				?>
				</div>
		</div>
		</body>	
		
</html>