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
					$sql = "select * from sanatcilar where id=".$_GET["id"];
					$result = $conn->query($sql);
					$rs = $result->fetch_object();
				?>
					<a href="sanatcilar.php" class="btn btn-info">Tüm Sanatçılar</a>
					<form enctype="multipart/form-data" name="haber" action="adminpanel/kaydet.php?islem=haberguncelle&id=<?php echo $_GET["id"]?>" method="post">
					<table class="table table-hover">
						<tr>
							<td>Sanatçı Başlığı</td>
							<td><input value="<?php echo $rs->baslik?>" type="text" class="form-control" name="baslik" /></td>
						</tr>
						<tr>
							<td>Resim</td>
							<td><input type="file" name="resim" />
							<img src="../upload/<?php echo $rs->resim?>" width="100">
							</td>
						</tr>
						<tr>
							<td>Kategori</td>
							<td>
								<select class="form-control" name="kategori_id">
									<option value="0">Kategori Seçiniz</option>
								<?php
									$sql = "select * from kategoriler order by kategori";
									$result = $conn->query($sql);
									while($rsKategori = $result->fetch_object()){
								?>
									<option <?php if($rs->kategori_id==$rsKategori->id) echo "selected" ?> value="<?php echo $rsKategori->id?>"><?php echo $rsKategori->kategori?></option>
								<?php
										
									}
								
								?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Durum</td>
							<td>
								<select class="form-control" name="durum">
									<option <?php if($rs->durum==0) echo "selected" ?> value="0">Yayınlama</option>
									<option <?php if($rs->durum==1) echo "selected" ?> value="1">Yayınla</option>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="2"><input class="btn btn-warning" type="submit" value="Kaydet" /></td>
							
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
			<div class="footer col-md-12">
				<?php include "footer.php"?>
			</div>
		</div>
	</body>
	
</html>