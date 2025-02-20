<?php include"header.php"; ?> <!-- Sayfanın üst kısmındaki header.php dosyasını dahil eder -->

<section id="cart_items"> <!-- Sepet öğeleri için bir bölüm başlatır -->
	<div class="container"> <!-- Ana konteyneri oluşturur -->
		<div class="breadcrumbs"> <!-- Breadcrumb (izleme çubuğu) bölümünü oluşturur -->
			<ol class="breadcrumb"> <!-- Breadcrumb için sıralama listesi -->
				<li><a href="urunler.php">Urun</a></li> <!-- Ürünler sayfasına giden link -->
				<li class="active">Sepetim</li> <!-- Şu anda aktif olan sayfa, Sepetim -->
			</ol>
		</div>
		<div class="table-responsive cart_info"> <!-- Sepet bilgilerini tutacak tabloyu oluşturur -->
		</div>
	</div>
</section> <!-- Sepet öğeleri bölümünü sonlandırır -->

<section id="do_action"> <!-- Sipariş ödeme kısmı için bir bölüm başlatır -->
	<div class="container mb-4"> <!-- Ana konteyneri oluşturur ve alt boşluk (margin-bottom) ekler -->
		<div class="row"> <!-- Satır oluşturur -->
			<div class="col-12"> <!-- Tam genişlikte bir sütun oluşturur -->
				<div class="table-responsive"> <!-- Tabloyu duyarlı yapar -->
					<table class="table table-striped"> <!-- Tabloyu oluşturur ve stripe (çizgili) yapar -->
						<thead> <!-- Tablo başlık kısmını başlatır -->
							<tr> <!-- Satır başlatır -->
								<th>Ürün Resim</th> <!-- Ürün resminin başlık hücresi -->
								<th>Ürün ad</th> <!-- Ürün adının başlık hücresi -->
								<th>Ürün Kodu</th> <!-- Ürün kodunun başlık hücresi -->
								<th>Adet</th> <!-- Ürün adedinin başlık hücresi -->
								<th class="text-right">Toplam Fiyat</th> <!-- Toplam fiyat başlık hücresi, sağa hizalanmış -->
								<th> </th> <!-- Boş bir hücre (gerekirse işlem için) -->
							</tr>
						</thead>
						<form action="yonetim-panel/islemler.php" method="POST"> <!-- Formu başlatır, işlemler.php dosyasına gönderir -->
							<tbody> <!-- Tablo gövdesi başlatır -->
								<?php 
								$kullanici_id=$kullanicicek['kullanici_id']; // Kullanıcı ID'sini alır
								$sepetsor=$db->prepare("SELECT * FROM tblsepet where kullanici_id=:id"); // Sepet tablosundaki verileri çeker
								$sepetsor->execute(array(
									'id' => $kullanici_id // Kullanıcı ID'sine göre verileri filtreler
								));

								while($sepetcek=$sepetsor->fetch(PDO::FETCH_ASSOC)) { // Sepet verilerini döngüyle işler
									$urun_id=$sepetcek['urun_id']; // Ürün ID'sini alır
									$urunsor=$db->prepare("SELECT * FROM tblurunler where urun_id=:urun_id"); // Ürünleri çeker
									$urunsor->execute(array(
										'urun_id' => $urun_id // Ürün ID'sine göre verileri filtreler
									));

									$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC); // Ürün bilgilerini alır
									$toplamfiyat+=$uruncek['urun_fiyat']*$sepetcek['urun_adet']; // Toplam fiyatı hesaplar
									$resimsor=$db->prepare("SELECT * FROM tblurun_resim where urun_id=:rid"); // Ürün resmini çeker
									$resimsor->execute(array(
										'rid'=>$urun_id // Ürün ID'sine göre resimleri filtreler
									));
									$resimcek=$resimsor->fetch(PDO::FETCH_ASSOC); // Ürün resmini alır
									?>
									<tr> <!-- Tablo satırını başlatır -->
										<td><img width="50" height="50" src="images/urun/<?php echo $resimcek['urunfoto_resimyol']; ?>"> </td> <!-- Ürün resmini gösterir -->
										<td><?php echo $uruncek['urun_ad'] ?></td> <!-- Ürün adını gösterir -->
										<td><?php echo $uruncek['urun_id'] ?></td> <!-- Ürün ID'sini gösterir -->
										<td><?php echo $sepetcek['urun_adet'] ?></td> <!-- Sepetteki ürün adedini gösterir -->
										<td class="text-right"><?php echo $uruncek['urun_fiyat']; ?>₺</td> <!-- Ürün fiyatını gösterir, sağa hizalanmış -->
										<td class="text-right"> </td> <!-- Boş bir hücre -->
									</tr>
								<?php }
								?>
								<tr> <!-- Toplam fiyat satırını başlatır -->
									<td></td> <!-- Boş hücre -->
									<td></td> <!-- Boş hücre -->
									<td></td> <!-- Boş hücre -->
									<td></td> <!-- Boş hücre -->
									<td><strong>Toplam :</strong></td> <!-- Toplam etiketi -->
									<td class="text-right"><strong><?php echo $toplamfiyat; ?> ₺</strong></td> <!-- Toplam fiyatı gösterir -->
								</tr>
							</tbody>
						</table>
					</div>
					<div class="container"> <!-- Yeni bir konteyner başlatır -->
						<div class="category-tab shop-details-tab"> <!-- Ödeme sekmeleri için bir kategori tabı oluşturur -->
							<div class="col-sm-12"> <!-- 12 sütun genişliğinde bir sütun oluşturur -->
								<ul class="nav nav-tabs"> <!-- Sekme başlıkları için bir liste oluşturur -->
									<li class="active"><a href="#reviews" data-toggle="tab">BANKA HAVALESİ</a></li> <!-- Banka havalesi sekmesi, aktif olarak başlatılır -->
								</ul>
							</div>
							<div class="tab-content"> <!-- Sekme içeriği başlatır -->
								<div class="tab-pane fade active in" id="reviews" > <!-- Banka havalesi içerik kısmı -->
									<div class="col-sm-12"> <!-- 12 sütun genişliğinde bir sütun başlatır -->
										<p><b>Ödeme yapacağınız bankayı seçtip  belirtilen İban Numarasına parayı yatırdıktan sonra</b></p> <!-- Ödeme açıklaması -->
										<p><b style="color: red;">artia@gmail.com</b>'a aldığınız makbuzu atınız</p> <!-- İletişim için e-posta adresi -->
										<label>İşlem Yapan :<?php echo $kullanicicek['kullanici_adsoyad']; ?></label> <!-- İşlem yapan kullanıcının adını gösterir -->

										<?php 
						$bankasor=$db->prepare("SELECT * FROM tblbanka  "); // Banka tablosundaki verileri çeker
                        $bankasor->execute(); // Sorguyu çalıştırır
                        while ($bankacek=$bankasor->fetch(PDO::FETCH_ASSOC)) {?> <!-- Banka verilerini döngüyle işler -->
                        	<div class="checkbox"> <!-- Checkbox inputunu oluşturur -->
                        		<label><input type="radio" name="siparis_banka" value="<?php echo $bankacek['banka_ad']; ?>"> <!-- Banka seçeneği -->
                        			<?php echo $bankacek['banka_ad']; ?> <!-- Banka adını gösterir -->
                        			<?php echo"--->IBAN NUMARASI "; ?> <!-- IBAN numarasını ekler -->
                        			<?php echo"<b style='color:red'>"; echo $bankacek['banka_iban']; echo"</b>"; ?> <!-- IBAN numarasını kırmızı renkte gösterir -->
                        		</label>
                        	</div>
                        <?php }?>
                        <input type="hidden" name="siparis_toplam" value="<?php  echo $toplamfiyat ?> "> <!-- Sipariş toplamını gizli bir inputla gönderir -->
                        <input type="hidden" name="kullanici_id" value="<?php  echo $kullanicicek['kullanici_id'] ?> "> <!-- Kullanıcı ID'sini gizli bir inputla gönderir -->
                        <button class="btn btn-success" type="submit" name="bankasiparisekle">Sipariş Ver</button> <!-- Sipariş verme butonunu oluşturur -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</section>

<?php include"footer.php"; ?> <!-- Sayfanın alt kısmındaki footer.php dosyasını dahil eder -->
