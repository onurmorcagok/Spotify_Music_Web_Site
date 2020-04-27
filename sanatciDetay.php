<html>
	<head>
	<title>Spotify - Herkes için Müzik</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="css/main.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  

  
	</head>
	<body>
						<div class="container col-md-9">
		
		<div id="clock"></div>
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
		
		
		<div class="container col-md-4" style="float:right; margin-bottom:10px;">
		
		<?php 
		session_start();
		if(isset($_SESSION["kullanici_ad"]) && isset($_SESSION["yetki"])){
			if($_SESSION["yetki"]==1){
				echo " ".'Hoşgeldiniz';
				echo " ".$_SESSION["kullanici_ad"];
	
			echo ' <a href="admin.php"><button type="button" class="btn btn-warning btn-sm">Yönetim Paneli</button></a> <a href="cikis.php"><button type="button" class="btn btn-danger btn-sm">Çıkış Yap</button></a>';
			} 
			else{
				echo 'Hoşgeldiniz';
				echo " ".$_SESSION["kullanici_ad"];
				echo " ".'<a href="cikis.php"><button type="button" class="btn btn-danger btn-sm">Çıkış Yap</button></a>';
			}
			
		}
		else{
			echo '<a href="adminpanel/login.php"><button type="button" class="btn btn-success btn-sm">Üye Girişi</button></a>
			<a href="adminpanel/yeni.php"><button type="button" class="btn btn-success btn-sm">Üye Ol</button>	';
		}
		?>
			
		</div>
			<div class="header col-md-12">
				<?php include "logo.php"; ?>
				<div class="menubar col-md-12">
					<?php include "menu.php"?>
										<?php if(isset($_SESSION["kullanici_ad"])){
					echo '<a href="oneCikanSarkilar.php"><button style="margin-top:-5px" type="button" class="btn btn-light btn-sm">Şarkılar</button>
						  <a href="sanatcilar.php"><button style="margin-top:-5px" type="button" class="btn btn-light btn-sm">Sanatçılar</button>';
					}?>
				</div>
			<div style="margin-top:20px" class="content">
				<div class="col-md-9 haberler">
					<?php
					$sql = "select * from sanatcilar where sanatci_id=".$_GET["id"];
					$result = $conn->query($sql);
					if($result->num_rows>0){
						while($rs = $result->fetch_object()){
					?>
					
						<div class="col-md-6">
							<img src="img/<?php echo $rs->sanatciResmi?>">
							<div style="margin-top:0px" class="alert alert-success" role="alert"><a href="Sanatcilar/hadise.php"><p><?php echo $rs->sanatciAdi?>...</a></div>
							<div class="alert alert-success" role="alert"><a href="sanatcilar.php"><button type="button" class="btn btn-light btn-sm">Geri Dön</button></a></div>
							<div style="margin-top:0px" class="alert alert-success" role="alert"><p><?php echo $rs->SanatciAciklama?>"...</div>
							</p>
						</div>
					
					<?php					
						}
					}else{
						echo "Sanatçı bulunumadı.";
					}
					
					?>
				</div><br><br><br><br>
				<h3>Öne Çıkan Şarkılar</h3>
				<div style="margin-top:5px" class="minislider col-md-3">
					<div id="minisliderExampleControls" class="minislider slide" data-ride="left">
						  <div class="carousel-inner">
							<div class="carousel-item active">
							  <img src="img/kapak4.jpg" class="d-block w-100" alt="...">
							  <audio style="width:220px" controls>
						<source src="music/zeytinGozlum.mp3" type="audio/mpeg">
						Tarayıcınız audio(ses) ögesi desteklemiyor.
						</audio>
							</div>
						  </div>
						</div>
					</div>
					
					<div style="margin-top:20px" class="minislider col-md-3">
					<div id="minisliderExampleControls" class="minislider slide" data-ride="left">
						  <div class="carousel-inner">
							<div class="carousel-item active">
							  <img src="img/kapak1.jpg" class="d-block w-100" alt="...">
							  <audio style="width:220px" controls>
						<source src="music/isyan.mp3" type="audio/mpeg">
						Tarayıcınız audio(ses) ögesi desteklemiyor.
						</audio>
							</div>
						  </div>
						</div>
					</div>
					
					<div style="margin-top:20px" class="minislider col-md-3">
					<div id="minisliderExampleControls" class="minislider slide" data-ride="left">
						  <div class="carousel-inner">
							<div class="carousel-item active">
							  <img src="img/kapak2.jpg" class="d-block w-100" alt="...">
							  <audio style="width:220px" controls>
						<source src="music/sensevdamisin.mp3" type="audio/mpeg">
						Tarayıcınız audio(ses) ögesi desteklemiyor.
						</audio>
							</div>
						  </div>
						</div>
					</div>
					
					<div style="margin-top:20px" class="minislider col-md-3">
					<div id="minisliderExampleControls" class="minislider slide" data-ride="left">
						  <div class="carousel-inner">
							<div class="carousel-item active">
							  <img src="img/kapak3.jpg" class="d-block w-100" alt="...">
							  <audio style="width:220px" controls>
						<source src="music/oyledertli.mp3" type="audio/mpeg">
						Tarayıcınız audio(ses) ögesi desteklemiyor.
						</audio>
							</div>
						  </div>
						</div>
					</div>
			</div>
			<div class="footer col-md-12">
				<?php
					include "footer.php";
				?>
			</div>
			
			
		</div>
	</body>
	<script>

	</script>
</html>