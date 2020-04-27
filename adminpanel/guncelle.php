<html>
	<head>
		<title>Dashboard Ekranı</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>
	<body>
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
			<a href="index.php" class="btn btn-warning">Ana Sayfa</a>
			<form class="form col-md-5" action="kaydet.php?islem=guncelle&id=<?php echo $rs->id?>" method="post">
				<div class="form-group">
					<label>Ad Soyad</label>
					<input value="<?php echo $rs->ad_soyad?>" class="form-control" name="ad_soyad" />
				</div>
				<div class="form-group">
					<label>Kullanıcı Adı</label>
					<input value="<?php echo $rs->kullanici_ad?>" class="form-control" name="kullanici_ad" />
				</div>
				<div class="form-group">
					<label>Parola</label>
					<input value="<?php echo $rs->parola?>" class="form-control" name="parola" />
				</div>
				<div class="form-group">
					<label>Yetki</label>
					<select name="yetki" class="form-control">
						<option value="0">Yetki Seçiniz</option>
						<option <?php if($rs->yetki==1) echo "selected"?> value="1">Admin</option>
						<option <?php if($rs->yetki==2) echo "selected"?> value="2">Editör</option>
					</select>
				</div>
				<div class="form-group">
					<input type="submit" class="form-control btn btn-success" value="Kaydet" />
				</div>
			</form>
		</div>
	</body>
</html>



