<html>
	<head>
	<title>Ana Sayfa</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		
	<?php
		session_start();
		if(!isset($_SESSION["giris"])){
			header("location:login.php");
		}
		if(isset($_SESSION["giris"])){
			if($_SESSION["giris"]!=1)
				header("location:login.php");
		}
		include "connection.php";
	?>
	<style>
		.solmenu, .icerik{float:left}
		.icerikalani {overflow:hidden}
	</style>
	</head>
	<body>
		<div class="container col-md-8">
			<div class="header col-md-12">
				<?php include "header.php"?>
			</div>
			<div class="icerikalani col-md-12">
				<div class="solmenu col-md-3">
					<?php include "solmenu.php";?>
				</div>
				<div class="icerik col-md-9">
				<?php
				if($_SESSION["yetki"]==1){
				?>
					<a href="yenihaber.php" class="btn btn-info">Yeni Kayıt</a>
					
					
					<table class="table table-hover">
						<tr>
							<td>#</td>
							<td>Başlık</td>
							<td>Ekleyen</td>
							<td>Kategori</td>
							<td>Durum</td>
							<td>Resim</td>
							<td></td>
						</tr>
						<?php
						$say = 0;				
						$sql = "select haberler.*,kullanicilar.ad_soyad, kategoriler.kategori from haberler
						left join kullanicilar on kullanicilar.id=haberler.kullanici_id
						inner join kategoriler on kategoriler.id = haberler.kategori_id;
						";//2.ADIM SQL Cümleni Hazırla
						$result = $conn->query($sql);//3.ADIM SQL Cümlesini Sunucuya Gönder
						if($result->num_rows>0){ //4.ADIM Kayıt Sayısı Kontrolü
							while($rs = $result->fetch_object()){//5.ADIM Loop Kurulacak
							$say+=1;
						?>
						<tr>
							<td><?php echo $say;?></td>
							<td><?php echo $rs->baslik?> </td>
							<td><?php echo $rs->ad_soyad?></td>
							<td><?php echo $rs->kategori?></td>
							<td>
							<?php
								if($rs->durum==0) echo "Yayında Değil";
								else echo "Yayınlanıyor";
							?>
							</td>
							<td>
								<img src="../upload/<?php echo $rs->resim?>" width="100">
							</td>
							<td> <a href="haberguncelle.php?id=<?php echo $rs->id?>">Güncelle</a> / <a href="kaydet.php?islem=habersil&id=<?php echo $rs->id?>">Sil</a></td>
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
			<div class="footer col-md-12">
				<?php include "footer.php"?>
			</div>
		</div>
	</body>
	
</html>