<?php include"header.php";?> <!-- Header dosyasını dahil eder, sayfanın üst kısmını oluşturur. -->
<section id="cart_items"> <!-- Sepet ürünlerinin yer aldığı bölüm başlar. -->
	<div class="container"> <!-- İçeriği merkezlemek için bir konteyner oluşturulur. -->
		<div class="breadcrumbs"> <!-- Sayfa yolunu göstermek için kullanılan alan. -->
			<ol class="breadcrumb"> <!-- Sayfa yolunu listelemek için bir liste. -->
				<li><a href="urunler.php">Urun</a></li> <!-- "Urunler" sayfasına yönlendiren link. -->
				<li class="active">Sepetim</li> <!-- Aktif olan sayfa ismi. -->
			</ol>
		</div>
		<div class="table-responsive cart_info"> <!-- Sepet bilgilerini göstermek için tablo alanı. -->
		</div>
	</div>
</section> 
<section id="do_action"> <!-- Sepet işlemleri için bir başka bölüm başlar. -->
	<div class="container mb-4"> <!-- İçeriği düzenlemek için bir konteyner oluşturulur. -->
		<div class="row"> <!-- Satır yapısı oluşturulur. -->
			<div class="col-12"> <!-- Tüm genişliği kaplayan bir sütun. -->
				<div class="table-responsive"> <!-- Tabloyu daha iyi görüntülemek için responsive yapı. -->
					<table class="table table-striped"> <!-- Çizgili bir tablo oluşturulur. -->
						<thead> <!-- Tablo başlıkları tanımlanır. -->
							<tr>
								<th scope="col"> </th> <!-- Resim sütunu. -->
								<th scope="col"> Adı</th> <!-- Ürün adı sütunu. -->
								<th></th> <!-- Boş sütun. -->
								<th scope="col" >Adet</th> <!-- Ürün adeti sütunu. -->
								<th scope="col" class="text-right">Fiyat</th> <!-- Ürün fiyatı sütunu. -->
								<th> </th> <!-- Silme işlemi için sütun. -->
							</tr>
						</thead>
						<tbody> <!-- Tablo gövdesi başlar. -->
							<?php 
							// Kullanıcı ID'si alınır.
							$kullanici_id=$kullanicicek['kullanici_id']; 
							// Sepet verilerini kullanıcı ID'sine göre çekmek için sorgu hazırlanır.
							$sepetsor=$db->prepare("SELECT * FROM tblsepet where kullanici_id=:id"); 
							// Sorgu çalıştırılır.
							$sepetsor->execute(array(
								'id' => $kullanici_id
							));
							// Sepet verileri döngüyle okunur.
							while($sepetcek=$sepetsor->fetch(PDO::FETCH_ASSOC)) {
								// Ürün ID'si alınır.
								$urun_id=$sepetcek['urun_id']; 
								// Ürün bilgilerini çekmek için sorgu hazırlanır.
								$urunsor=$db->prepare("SELECT * FROM tblurunler where urun_id=:urun_id"); 
								// Sorgu çalıştırılır.
								$urunsor->execute(array(
									'urun_id' => $urun_id
								));
								// Ürün bilgileri alınır.
								$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC); 
								// Toplam fiyat hesaplanır.
								$toplamfiyat+=$uruncek['urun_fiyat']*$sepetcek['urun_adet']; 
								// Ürün resmi için sorgu hazırlanır.
								$resimsor=$db->prepare("SELECT * FROM tblurun_resim where urun_id=:rid"); 
								// Sorgu çalıştırılır.
								$resimsor->execute(array(
									'rid'=>$urun_id
								));
								// Ürün resmi bilgisi alınır.
								$resimcek=$resimsor->fetch(PDO::FETCH_ASSOC); 
								?>
								<tr> <!-- Tablo satırı oluşturulur. -->
									<td><img width="50" height="50" src="images/urun/<?php echo $resimcek['urunfoto_resimyol']; ?>"> </td> <!-- Ürün resmi gösterilir. -->
									<td><?php echo $uruncek['urun_ad'] ?></td> <!-- Ürün adı gösterilir. -->
									<td></td> <!-- Boş sütun. -->
									<td><?php echo $sepetcek['urun_adet'] ?></td> <!-- Ürün adeti gösterilir. -->
									<td class="text-right"><?php echo $uruncek['urun_fiyat'] ?></td> <!-- Ürün fiyatı gösterilir. -->
									<td class="text-right"><a href="yonetim-panel/islemler.php?sepet_id=<?php echo $sepetcek['sepet_id']; ?>&sepetsil=ok"><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </button></a> </td> <!-- Silme işlemi butonu. -->
								</tr>
							<?php }
							?>
							<tr> <!-- Toplam fiyat satırı. -->
								<td></td> <!-- Boş sütun. -->
								<td></td> <!-- Boş sütun. -->
								<td></td> <!-- Boş sütun. -->
								<td></td> <!-- Boş sütun. -->
								<td><strong>Toplam</strong></td> <!-- Toplam yazısı. -->
								<td class="text-right"><strong><?php echo $toplamfiyat; ?> ₺</strong></td> <!-- Toplam fiyat gösterilir. -->
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col mb-2"> <!-- Butonlar için alan. -->
				<div class="row"> <!-- Satır yapısı oluşturulur. -->
					<div class="col-sm-12  col-md-6"> <!-- "Alışverişe Devam Et" butonu sütunu. -->
						<a href="index"></a><button class="btn btn-block btn-light btn-sm">Alışverişe Devam Et</button>
					</div>
					<div class="col-sm-12 col-md-6 text-right"> <!-- "Sepeti Onayla" butonu sütunu. -->
						<a href="odeme"><button class="btn btn-lg btn-block btn-success text-uppercase btn-sm">Sepeti Onayla</button></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php include"footer.php"; ?> <!-- Footer dosyasını dahil eder, sayfanın alt kısmını oluşturur. -->
