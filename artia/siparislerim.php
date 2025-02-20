<?php include"header.php";  // Header dosyasını dahil eder (sayfa başlığı, menü vb.)
$urunsor=$db->prepare("SELECT* FROM tblurunler where urun_id=:id"); // Ürün bilgilerini çekmek için SQL sorgusu hazırlar
$urunsor->execute(array( // Sorguyu çalıştırarak veritabanından ürün verilerini çeker
	'id'=>$_GET['urun_id'] // URL'den gelen 'urun_id' parametresini kullanarak ürün bilgilerini alır
));

$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC); // Ürün verilerini $uruncek değişkenine atar

?>

<section id="cart_items"> <!-- Sepet öğelerini gösteren bölüm -->
	<div class="container"> <!-- Ana konteyner başlatır -->
		<div class="breadcrumbs"> <!-- Navigasyon çubuğu (breadcrumb) -->
			<ol class="breadcrumb"> <!-- Gezinme linkleri sırasını oluşturur -->
				<li><a href="urunler.php">Urun</a></li> <!-- Ürünler sayfasına link verir -->
				<li class="active">Siparişlerim</li> <!-- Aktif olarak "Siparişlerim" linki gösterir -->
			</ol>
		</div>
		<div class="table-responsive cart_info"> <!-- Sepet bilgilerini tablo formatında göstermek için responsive (esnek) tablo -->
			<table class="table table-condensed"> <!-- Sıkıştırılmış (compact) bir tablo oluşturur -->
				<thead> <!-- Tablo başlıklarını tanımlar -->
					<tr class="cart_menu"> <!-- Sipariş tablosu başlıkları -->
						<th>Sipariş No</th> <!-- Sipariş numarası başlığı -->
						<th>Sipariş Tarihi</th> <!-- Sipariş tarihi başlığı -->
						<th>Tutar</th> <!-- Sipariş tutarı başlığı -->
						<th>Ödeme Tip</th> <!-- Ödeme tipi başlığı -->
						<th>Durum</th> <!-- Sipariş durumu başlığı -->
						<td></td> <!-- Boş bir hücre (stil veya başka bir şey için kullanılabilir) -->
					</tr>
				</thead>
				<tbody> <!-- Tablo içeriği -->
					<?php 
					$kullanici_id=$kullanicicek['kullanici_id']; // Kullanıcı ID'sini alır
					$siparissor=$db->prepare("SELECT * FROM tblsiparis where kullanici_id=:id ORDER BY siparis_zaman DESC"); // Kullanıcının siparişlerini sıralı bir şekilde çekmek için sorgu oluşturur
					$siparissor->execute(array(
						'id' => $kullanici_id // Kullanıcı ID'sini kullanarak sipariş verilerini çeker
					));

					while($sipariscek=$siparissor->fetch(PDO::FETCH_ASSOC)) { // Siparişleri döngü ile alır
					?>
						<tr> <!-- Tablo satırını başlatır -->

							<td><?php echo $sipariscek['siparis_id']; ?></td> <!-- Sipariş ID'sini tabloya yazar -->
							<td><?php echo $sipariscek['siparis_zaman']; ?></td> <!-- Sipariş zamanını tabloya yazar -->
							<td><?php echo $sipariscek['siparis_toplam']; ?></td> <!-- Sipariş toplam tutarını tabloya yazar -->
							<td><?php echo $sipariscek['siparis_tip']; ?></td> <!-- Sipariş ödeme tipini tabloya yazar -->
							<td><?php // Sipariş durumunu kontrol ederek durumu yazdırır

							if ($sipariscek['siparis_durum']==0) { // Durum 0 ise "Ödeme Bekleniyor" yazdırır
								echo "<b style='color:red'>Ödeme Bekleniyor</b>";
							}elseif ($sipariscek['siparis_durum']==1) { // Durum 1 ise "Ödeme Onaylandı" yazdırır
								echo "<b style='color:#228B22'>Ödeme Onaylandı</b>";
							}elseif ($sipariscek['siparis_durum']==2) { // Durum 2 ise "Kargoya Verildi" yazdırır
								echo "<b style='color:#7FFF00'>Kargoya Verildi</b>";
							}elseif ($sipariscek['siparis_durum']==3) { // Durum 3 ise "Kargo Teslim Edildi" yazdırır
								echo "<b style='color:'>Kargo Teslim Edildi</b>";
							}elseif ($sipariscek['siparis_durum']==4) { // Durum 4 ise "İptal Edildi" yazdırır
								echo "<b style='color:#B22222'>İptal edildi</b>";
							}

							?></td>

							<th> <!-- Sipariş detayına giden buton -->
								<a href="siparis-detay?siparis_id=<?php echo $sipariscek['siparis_id']?>" class="btn btn-success btn-xs" role="button">Sipariş Detay</a> <!-- Sipariş detayına gitmek için link -->
							</th>

						</tr>

					<?php } ?> <!-- Döngü bitişi -->

				</tbody>
			</table>
		</div>
	</div>
</section> <!--/#cart_items--> <!-- Sepet öğelerini sonlandırır -->


<section id="do_action"> <!-- İşlem yapma alanı (reklamlar vb. eklenebilir) -->
	<div class="container"> <!-- Ana konteyner başlatır -->

		<div class="row"> <!-- Satır başlatır -->
			
			<div class="col-sm-12"> <!-- 12 sütun genişliğinde bir sütun oluşturur -->
				<img src="images/adsens.png"> <!-- Reklam alanı (görsel) -->
			</div>
		</div>
	</div>
</section> <!--/#do_action--> <!-- İşlem yapma alanını sonlandırır -->

<?php include"footer.php" ?> <!-- Footer dosyasını dahil eder (sayfanın alt kısmı) -->
