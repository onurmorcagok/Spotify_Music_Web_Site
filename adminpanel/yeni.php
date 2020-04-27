<html>
	<head>
		<title>Spotify - Kayıt Sayfası</title>
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
			<source src="connect.mp4" type="video/mp4">
			<source src="connect.ogg" type="video/ogg">
			<source src="connect.webm" type="video/webm">
			Video desteklenmiyor.
			</video>
	</div>
	
	<div class="container">
		<div class="row">

			<form class="col-md-4 ortala" method="post" action="kaydet.php?islem=yeni" style="background-color:#808080d1;">
			  <div class="form-group">
				<center><img src="./imgs/l1.png" style="width:20%" />
				<h2><label style="color:white">Spotify</h2></label>
				<h4><label style="color:white">ÜYE OL</label></h4>
				<div class="container">
		
				<div class="form-group">
					<h5><label style="color:white">Ad Soyad:</label></h5>
					<input class="form-control" name="ad_soyad" />
				</div>
				<div class="form-group">
					<h5><label style="color:white">Kullanıcı Adı:</label></h5>
					<input class="form-control" name="kullanici_ad" />
				</div>
				<div class="form-group">
					<h5><label style="color:white">Parola:</label></h5>
					<input class="form-control" name="parola" type="password" />
				</div>
				<div class="form-group">
					<h5><label style="color:white">Kullanıcı Türü</label></h5>
					<select name="yetki" class="form-control">
						<option value="2">User (Kullanıcı)</option>
					</select>
				</div>
				<div class="form-group">
					<a href="login.php"><input type="submit" class="form-control btn btn-success" value="Kayıt Ol" /></a>
				</div>
				</center>
			  </div>
			  
			
		</form>
		</div>
	</div>
</div>
	</body>
</html>