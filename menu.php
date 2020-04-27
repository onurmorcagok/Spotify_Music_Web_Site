					<div style="margin-left:80px">
					
					<ul>
						<li><a href="index.php">Ana Sayfa</a></li>
						<?php
						include "adminpanel/connection.php";
						$sql = "select * from kategoriler order by kategori";
						$result = $conn->query($sql);
						if($result->num_rows>0){
							while($rs = $result->fetch_object()){
								echo '<li><a href="kategori.php?id='.$rs->id.'">'.$rs->kategori.'</a></li>';
							}
							
						}
						?>
					</ul>
					</div>