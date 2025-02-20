<?php include"header.php"; // Header dosyasını dahil eder (başlık, menü vb.)
if (isset($_GET['sef'])) { // Eğer URL'de 'sef' parametresi varsa (kategori sayfası)
	$kategorisor=$db->prepare("SELECT * FROM tblkategori where kategori_seourl=:seourl"); // Kategori bilgilerini SEF URL'ye göre alacak SQL sorgusu hazırlar
	$kategorisor->execute(array(
		'seourl' => $_GET['sef'] // URL'den gelen 'sef' parametresine göre kategori bilgilerini alır
	));
	$kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC); // Kategori verilerini çeker
	$kategori_id=$kategoricek['kategori_id']; // Kategori ID'sini alır
	$urunsor=$db->prepare("SELECT * FROM tblurunler where kategori_id=:kategori_id order by urun_id DESC"); // Belirli kategoriye ait ürünleri alacak SQL sorgusu hazırlar
	$urunsor->execute(array(
		'kategori_id' => $kategori_id // Kategori ID'sine göre ürünleri alır
	));
	$say=$urunsor->rowCount(); // Ürün sayısını alır
} else {
	$urunsor=$db->prepare("SELECT * FROM tblurunler order by urun_id DESC"); // Eğer 'sef' parametresi yoksa, tüm ürünleri alacak SQL sorgusu
	$urunsor->execute(); // SQL sorgusunu çalıştırır
}
?>
<section> <!-- Ürünlerin listeleneceği bölüm -->
	<div class="container"> <!-- Ana konteyner -->
		<div class="row"> <!-- Satır başlatır -->
			<div class="col-sm-9 padding-right" > <!-- Ürünlerin görüntülenmesi için geniş bir sütun -->
				<div class="features_items"><!--features_items--> 
					
					<h2 class="title text-center">TÜM ÜRÜNLER</h2> <!-- Sayfa başlığı -->

					<?php 
					/// TÜM ÜRÜNLERİ VERİ TABANINDAN ÇEKİYORUZ 
					while ($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) // Ürünleri veritabanından çeker ve döngüyle listelemeye başlar
					{?>

						<?php 
						$urun_id=$uruncek['urun_id']; // Ürün ID'sini alır
						$urunfotosor=$db->prepare("SELECT* FROM tblurun_resim where urun_id=:id LIMIT 1"); // Ürünün fotoğrafını almak için sorgu hazırlar
						$urunfotosor->execute(array(
							'id'=>$urun_id // Ürün ID'sine göre fotoğraf verisini alır
						));
						$urunfotocek=$urunfotosor->fetch(PDO::FETCH_ASSOC); // Fotoğraf verilerini çeker
						?>
						<div class="col-sm-4"> <!-- Ürünler 3 sütunlu olarak gösterilecek, her bir ürün için bu div kullanılacak -->
							<div class="product-image-wrapper"> <!-- Ürünün görseli ve bilgilerini saran bir div -->
								<div class="single-products"> <!-- Her bir ürünü temsil eden bir div -->
									<div class="productinfo text-center"> <!-- Ürünün temel bilgilerini gösteren bölüm -->
										<img src="images/urun/<?php echo $urunfotocek['urunfoto_resimyol']; ?>" alt="" height="225px" width="175px" /> <!-- Ürün fotoğrafı -->
										<h1 class="title"><?php echo $uruncek['urun_fiyat']; ?>₺</h1> <!-- Ürün fiyatı -->
										<p><?php echo $uruncek['urun_ad']; ?></p> <!-- Ürün adı -->
									</div>
									<div class="product-overlay"> <!-- Ürüne tıklandığında görünen ek bilgi kısmı -->
										<div class="overlay-content">
											<img src="images/urun/<?php echo $urunfotocek['urunfoto_resimyol']; ?>" alt="" height="125px" /> <!-- Ürün fotoğrafı -->
											<h4 style="color:white"><?php echo $uruncek['urun_fiyat']; ?>₺</h4> <!-- Ürün fiyatı -->
											<p><?php echo $uruncek['urun_ad']; ?></p> <!-- Ürün adı -->

											<form action="yonetim-panel/islemler.php" method="POST"> <!-- Ürün sepete ekleme işlemi için form -->
												<input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>"> <!-- Kullanıcı ID'sini gizli alanda gönderir -->
												<input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'] ?>"> <!-- Ürün ID'sini gizli alanda gönderir -->
											</form>
											<form action="yonetim-panel/islemler.php" method="POST"> <!-- Sepete eklemek için ikinci form -->
												<input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>"> <!-- Kullanıcı ID'si -->
												<input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'] ?>"> <!-- Ürün ID'si -->
												<div class="row">
													<input type="hidden" class="form-control input-sm" value="1" name="urun_adet"> <!-- Ürün adedi -->
												</div>
												<?php if (!isset($_SESSION['userkullanici_mail'])) {?> <!-- Eğer kullanıcı giriş yapmamışsa -->
													Sepete Ürün Eklemek İçin Lütfen <a href="login">GİRİŞ YAPIN</a> <!-- Giriş yapması gerektiğini belirten mesaj -->
												<?php } else{?>
													<input type="submit" class="btn btn-default add-to-cart" name="sepeteekle" value="SEPETE EKLE"> <!-- Sepete ekle butonu -->
												<?php } ?>
											</form>
										</div>
									</div>
									<img src="images/home/sale.png" class="new" alt="" /> <!-- İndirim veya yeni ürün etiketi -->
								</div>
								<div class="choose"> <!-- Ürüne dair ek seçenekler -->
									<ul class="nav nav-pills nav-justified">
										<li><a href="urun-<?=seo($uruncek["urun_ad"]) ?>"><i class="fa fa-plus-square"></i>Detay İçin Tıklayınız</a></li> <!-- Ürün detay sayfasına yönlendiren link -->
									</ul>
								</div>
							</div>
						</div>

					<?php }?> <!-- Ürünleri listeleme döngüsü sonu -->
				</div><!--features_items-->
			</div>
			<?php include"sidebar.php"; ?> <!-- Yan menüyü dahil eder -->
		</div>
	</div>
</section>

<?php include"footer.php" ?> <!-- Footer dosyasını dahil eder -->
