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
				<div>
				<a href="yenihaber.php" style="margin-left:400px" class="btn btn-info">Yeni Kayıt</a>
					
					
					<table style="margin-left:30px" class="table table-hover">
						<tr style="color:white">
							<td style="color:white">#</td>
							<td style="color:white">Başlık</td>
							<td style="color:white">Ekleyen</td>
							<td style="color:white">Kategori</td>
							<td style="color:white">Durum</td>
							<td style="color:white">Resim</td>
							<td></td>
						</tr>
						<?php
						
						
						$say = 0;				
						$sql = "select haberler.*,kullanicilar.ad_soyad, kategoriler.kategori from haberler
						left join kullanicilar on kullanicilar.id=haberler.kullanici_id
						inner join kategoriler on kategoriler.id = haberler.kategori_id";//2.ADIM SQL Cümleni Hazırla
						//echo $sql;exit;
						$result = $conn->query($sql);//3.ADIM SQL Cümlesini Sunucuya Gönder
						if($result->num_rows>0){ //4.ADIM Kayıt Sayısı Kontrolü
							while($rs = $result->fetch_object()){//5.ADIM Loop Kurulacak
							$say+=1;
						?>
						<tr>
							<td style="color:white"><?php echo $say;?></td>
							<td style="color:white"><?php echo $rs->baslik?> </td>
							<td style="color:white"><?php echo $rs->ad_soyad?></td>
							<td style="color:white"><?php echo $rs->kategori?></td>
							<td style="color:white">
							<?php
								if($rs->durum==0) echo "Yayında Değil";
								else echo "Yayınlanıyor";
							?>
							</td>
							<td>
								<img style="width:20px; height:30px;" src="upload/<?php echo $rs->resim?>" width="100">
							</td>
							<td style="color:white"> <a href="haberguncelle.php?id=<?php echo $rs->id?>">Güncelle</a> / <a href="kaydet.php?islem=habersil&id=<?php echo $rs->id?>">Sil</a></td>
						</tr>				
						<?php
							}
						}else 
							echo "Kayıt bulunmamaktadır";
						?>
					</table>
				</div>
				
				
		</body>	
</div>		
</html>