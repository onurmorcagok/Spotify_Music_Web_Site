<html>
	<head>
		<title>Spotify - Giriş Sayfası</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<style>
			.ortala{
				margin:30px auto;
			}
		</style>
		
		<style type="text/css">
		body{
			margin:0;
			padding:0;
		}
		
		.overlay{
			position: fixed;
			width: 100%;
			height: 100%;
			overflow: hidden;
			top: 0;
			left: 0;
		}
		
		#myVideo{
			position: absolute;
			top: 0;
			left: 0;
			min-height: 100%;
			min-width: 100%;
		}
		
		</style>
	</head>
	
	<body>
	
	<div class="overlay">
		
			<video id="myVideo" autoPlay="true" loop muted> 
			<source src="video.mp4" type="video/mp4">
			<source src="video.ogg" type="video/ogg">
			<source src="video.webm" type="video/webm">
			Video desteklenmiyor.
			</video>
		</div>
		
		
	<div class="container">
		<div class="row">
			<form class="col-md-4 ortala" action="kontrol.php" method="post"   style="background-color:#808080d1;">
			  <div class="form-group">
				<center><img src="./imgs/l1.png" style="width:50%" />
				<h2><label style="color:white">Spotify</h2></label><br>
				<h4><label style="color:white">ÜYE GİRİŞİ</label></h4>
				</center>
			  </div>
			  <?php
			  if(isset($_GET["hata"])){
				if($_GET["hata"]==1){
			   ?>
			   <div class="alert alert-danger">
				<strong>HATA: </strong>Kullanıcı adı veya Parolası Hatalı. 
			   </div>
			   <?php 
				}elseif($_GET["hata"]==2){
					echo '<div class="alert alert-danger">
				<strong>HATA: </strong>Sayfayı görmeye yetkiniz bulunmamaktadır. 
			   </div>';
				}
			  }
			  ?>
			  <div class="form-group">
				<h5><center><label style="color:white" for="exampleInputEmail1">Kullanıcı Adı:</label></center></h5>
				<input type="text" name="kad" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Kullanıcı Adı">
				
			  </div>
			  <div class="form-group">
				<h5><center><label style="color:white" for="exampleInputPassword1">Parola:</label></center></h5>
				<input type="password" name="parola" class="form-control" id="exampleInputPassword1" placeholder="Parola">
			  </div>
			  <div class="form-group form-check">
				<input type="checkbox" class="form-check-input" id="exampleCheck1">
				<label style="color:white" class="form-check-label" for="exampleCheck1">Beni hatırla</label>
			  </div>
			  <center><button type="submit" class="btn btn-success">Giriş Yap</button></center>
			</form>
		</div>
	</div>
		
	</body>
</html>