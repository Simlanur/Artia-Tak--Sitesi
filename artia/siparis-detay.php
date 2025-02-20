<?php include"header.php"; ?> <!-- Header dosyasını dahil eder (sayfa başlığı, menü vb.) -->


<section id="cart_items"> <!-- Sepet öğelerini gösteren bölüm -->
	<div class="container"> <!-- Ana konteyner başlatır -->
		<div class="breadcrumbs"> <!-- Navigasyon çubuğu (breadcrumb) -->
			<ol class="breadcrumb"> <!-- Sırasıyla gezinme linklerini oluşturur -->
				<li><a href="urunler.php">Urun</a></li> <!-- Ürünler sayfasına link verir -->
				<li class="active">Siparişlerim</li> <!-- Aktif olarak "Siparişlerim" linki gösterir -->
			</ol>
		</div>
		<div class="table-responsive cart_info"> <!-- Sepet bilgilerini tablo formatında göstermek için responsive (esnek) tablo -->
			<table class="table table-condensed"> <!-- Sıkıştırılmış (compact) bir tablo oluşturur -->
				<thead> <!-- Tablo başlıklarını tanımlar -->
					<tr class="cart_menu"> <!-- Sipariş tablosu başlıkları -->
						<th>Sipariş No</th> <!-- Sipariş numarası başlığı -->
						<th>Urun Adı</th> <!-- Ürün adı başlığı -->
						<th>Tutar</th> <!-- Ürün tutarı başlığı -->
						<th>Urun Adet</th> <!-- Ürün adedi başlığı -->
						<th>Adres</th> <!-- Adres başlığı -->
						<td></td> <!-- Boş bir hücre -->
					</tr>
				</thead>
				<tbody> <!-- Tablo içeriği -->
					<?php 
					

					$siparis_id=$asipariscek['urun_id']; // Sipariş ID'sini değişkene atar

					$siparissor=$db->prepare("SELECT * FROM tblsiparis_detay  where siparis_id=:id "); // Sipariş detaylarını çekmek için SQL sorgusu oluşturur
					$siparissor->execute(array(

						'id'=>$_GET['siparis_id'] // URL'den gelen sipariş ID'sini sorguya ekler
                     ));// Sorguyu çalıştırır


					while($sipariscek=$siparissor->fetch(PDO::FETCH_ASSOC)) { // Veritabanından gelen sipariş detaylarını döngüyle alır
						

					 $dsiparissor=$db->prepare("SELECT * FROM tblurunler where urun_id =".$sipariscek['urun_id']); // Ürün bilgilerini çekmek için SQL sorgusu oluşturur
					 $dsiparissor->execute(); // Ürün bilgilerini sorgulamak için çalıştırır
					 $dsipariscek=$dsiparissor->fetch(PDO::FETCH_ASSOC); // Ürün bilgilerini alır

		



					 ?>
					 <tr> <!-- Tablo satırını başlatır -->

					 	<td><?php echo $sipariscek['siparis_id']; ?></td> <!-- Sipariş ID'sini tabloya yazar -->
					 	<td><?php echo $dsipariscek['urun_ad']; ?></td> <!-- Ürün adını tabloya yazar -->
					 	<td><?php echo $sipariscek['urun_fiyat']; ?></td> <!-- Ürün fiyatını tabloya yazar -->
					 	<td><?php echo $sipariscek['urun_adet']; ?></td> <!-- Ürün adetini tabloya yazar -->
					 	<td><?php echo $kullanicicek['kullanici_adres']; ?></td> <!-- Kullanıcının adresini tabloya yazar -->




					 </tr>

					<?php } ?>



				</tbody>
			</table>
		</div>
	</div>
</section> <!--/#cart_items--> <!-- Sepet öğelerini sonlandırır -->


<section id="do_action"> <!-- İşlem yapma alanı (reklamlar vb. eklenebilir) -->
	<div class="container"> <!-- Ana konteyner başlatır -->

		<div class="row"> <!-- Satır başlatır -->

			<div class="col-sm-12"> <!-- 12 sütun genişliğinde bir sütun oluşturur -->
				<!--<img src="images/adsens.png"> --> <!-- Reklam alanı (görsel) yorum satırına alınmış -->
			</div>
		</div>
	</div>
</section> <!--/#do_action--> <!-- İşlem yapma alanını sonlandırır -->

<?php include"footer.php" ?> <!-- Footer dosyasını dahil eder (sayfanın alt kısmı) -->
