<div class="mainmenu pull-left"> <!-- Ana menü alanını başlatır, solda görünmesini sağlar -->
	<ul class="nav navbar-nav collapse navbar-collapse"> <!-- Menü öğelerinin sıralandığı listeyi oluşturur -->
		<li><a href="index.php" class="active">Anasayfa</a></li> <!-- Anasayfa linkini oluşturur ve aktif olarak işaretler -->
		
		<?php 
		// Menü verilerini çekmek için SQL sorgusu oluşturur, durum değeri 1 olan menüleri alır ve 5 öğe ile sınırlar
		$menusor=$db->prepare("SELECT * FROM tblmenu where menu_durum=:durum order by menu_sira ASC limit 5 ");
		$menusor->execute(array(
			'durum' => 1 // Durum değeri 1 olan menüler getirilecek
		)); 

		// Veritabanından dönen menü verilerini döngüyle işler
		while ($menucek=$menusor->fetch(PDO::FETCH_ASSOC)){ 
		?>
				
			<li><a href="<?php echo $menucek['menu_url'] ?>"> <!-- Menü öğesinin URL'sine yönlendiren bağlantıyı oluşturur -->
				<?php echo $menucek['menu_adi'] ?> <!-- Menü adını dinamik olarak ekler -->
			</a></li>
				
		<?php } ?>
	</ul>
</div>
