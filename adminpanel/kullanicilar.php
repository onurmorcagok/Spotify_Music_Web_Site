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
					<a href="yeni.php" class="btn btn-info">Yeni Kayıt</a>
					<form method="post" action="index.php?islem=sorgu">
						<label>Ad Soyad</label>
						<input name="sorgu" />
						<input type="submit" class="btn btn-danger" value="Sorgula">
					</form>
					<table class="table table-hover">
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
			<div class="footer col-md-12">
				<?php include "footer.php"?>
			</div>
		</div>
	</body>
	
</html>