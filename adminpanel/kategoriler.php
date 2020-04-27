<html>
	<head>
	<title>Ana Sayfa</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script>
		function uyari(){
			e = confirm('Silmek İstediğnize Emin misiniz?');
			if(e==false){
				return false;				
			}		
		}
	</script>
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
					if(isset($_GET["id"])){
						$sql = "select * from kategoriler where id=".$_GET["id"];
						$result = $conn->query($sql);
						$rs = $result->fetch_object();
						$kategori=$rs->kategori;
					?>	
						<form name="kategori" method="post" action="kaydet.php?islem=kategoriguncelle&id=<?php echo $_GET["id"]?>">
					<?php }else{
						$kategori = "";
						echo '<form name="kategori" method="post" action="kaydet.php?islem=yenikategori">';
					}
				?>
					
						<table class="table table-hover">
							<tr>							
								<td colspan="2">
										<h3>Kategori İşlemleri</h3>
								</td>
							</tr>
							<tr>
								<td>Kategori Başlığı</td>
								<td><input value="<?php echo $kategori?>" type="text" class="form-control" name="kategori"></td>
							</tr>
							<tr>							
								<td colspan="2">
									<input type="submit" class="btn btn-success" value="Kaydet">
								</td>
							</tr>
							
						</table>
					</form>
					
					<table class="table table-hover">
						<tr>
							<td>#</td>
							<td>Kategori</td>					
							<td></td>
						</tr>
						<?php
						$say = 0;
						
						$sql = "select * from kategoriler order by kategori";//2.ADIM SQL Cümleni Hazırla
						$result = $conn->query($sql);//3.ADIM SQL Cümlesini Sunucuya Gönder
						if($result->num_rows>0){ //4.ADIM Kayıt Sayısı Kontrolü
							while($rs = $result->fetch_object()){//5.ADIM Loop Kurulacak
							$say+=1;
						?>
						<tr>
							<td><?php echo $say;?></td>
							<td><?php echo $rs->kategori?> </td>
							
							<td> <a href="kategoriler.php?id=<?php echo $rs->id?>">Güncelle</a> / <a onclick="return uyari()" href="kaydet.php?islem=kategorisil&id=<?php echo $rs->id?>">Sil</a></td>
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