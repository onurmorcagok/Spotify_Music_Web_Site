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
					
					<form method="post" action="kullanicilar.php?islem=sorgu">
						<a href="yeni.php" style="margin-left:400px" class="btn btn-info">Yeni Kayıt</a>
						<br><br>
						<label style="color:white; margin-left:300px;">Ad Soyad:</label>
						<input name="sorgu" />
						<input type="submit" class="btn btn-danger" value="Sorgula">
					</form>
					<table style="color:white; margin-left:120px;" class="table">
						<tr>
							<td>#</td>
							<td>Ad Soyad</td>
							<td>Kullanıcı Adı</td>
							<td>Yetki</td>
							<td></td>
						</tr>
						<?php
						$say = 0;
						if(isset($_GET["islem"]))
							$sql = "select * from kullanicilar where ad_soyad like '%".$_POST["sorgu"]."%' order by yetki,ad_soyad";//2.ADIM SQL Cümleni Hazırla
						else
							$sql = "select * from kullanicilar order by yetki,ad_soyad";//2.ADIM SQL Cümleni Hazırla
						$result = $conn->query($sql);//3.ADIM SQL Cümlesini Sunucuya Gönder
						if($result->num_rows>0){ //4.ADIM Kayıt Sayısı Kontrolü
							while($rs = $result->fetch_object()){//5.ADIM Loop Kurulacak
							$say+=1;
						?>
						<tr>
							<td><?php echo $say;?></td>
							<td><?php echo $rs->ad_soyad?> </td>
							<td><?php echo $rs->kullanici_ad?></td>
							<td>
							<?php
								if($rs->yetki==1) echo "Admin";
								elseif($rs->yetki==2) echo "Editör";
							?>
							</td>
							<td> <a href="guncelle.php?id=<?php echo $rs->id?>">Güncelle</a> / <a href="kaydet.php?islem=sil&id=<?php echo $rs->id?>">Sil</a></td>
						</tr>				
						<?php
							}
						}else 
							echo "Kayıt bulunmamaktadır";
						?>
					</table>
				<?php
				}else{
					echo "<h1>Bu sayfayı görmeye yetkiniz bulunmamaktadır</h1>";
				}
				?>
				</div>
		</div>
		</body>	
		
</html>