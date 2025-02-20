<?php include "header.php"; // Header dosyasını dahil ediyoruz.

// Ürün tablosundaki verileri çekmek için bir sorgu hazırlıyoruz ve ürünleri "urun_id" azalan sırada sıralıyoruz.
$urunsor = $db->prepare("SELECT * FROM tblurunler ORDER BY urun_id DESC");
$urunsor->execute(); // Sorgumuzu çalıştırıyoruz.

?>

<div class="right_col" role="main"> <!-- Sayfanın sağ kolonundaki ana içerik bölümü -->
  <div class="">
    <div class="page-title"> <!-- Sayfa başlık bölümü -->
      <div class="title_left">
        <h3>Ürün İşlemleri <small>

          <?php 
          // Eğer işlem başarılı olduysa kullanıcıya yeşil mesaj gösteriyoruz.
          if ($_GET['durum'] == 'ok') { ?>

            <a style="color:green">İşlem Başarılı</a>

          <?php 
          // Eğer işlem başarısız olduysa kullanıcıya kırmızı mesaj gösteriyoruz.
          } elseif ($_GET['durum'] == 'no') { ?>

            <a style="color:red">İşlem Başarısız</a>

          <?php } ?>

        </small></h3>
      </div>
    </div>

    <div class="row"> <!-- İçerik satırı -->
      <div class="col-xs-12"> <!-- İçeriği kapsayan sütun -->
        <div class="x_panel"> <!-- Panel başlangıcı -->

          <!-- Yeni ürün ekleme butonu -->
          <a href="urun-ekle.php">
            <button type="button" class="btn btn-primary">YENİ ÜRÜN EKLE</button>
          </a>

          <div class="clearfix"></div> <!-- Temizlik sınıfı, düzen için kullanılır. -->

          <div class="x_content"> <!-- Panel içeriği -->

            <!-- Ürün bilgilerini göstermek için tablo -->
            <table class="table table-bordered" style="text-align: center;">
              <thead>
                <tr>
                  <th>ÜRÜN AD</th> <!-- Ürünün adı -->
                  <th>ÜRÜN FİYAT</th> <!-- Ürünün fiyatı -->
                  <th>ÜRÜN STOK</th> <!-- Ürünün stok miktarı -->
                  <th>ÜRÜN SEO URL</th> <!-- Ürünün SEO URL'si -->
                  <th>ÖNE ÇIKART</th> <!-- Ürünün öne çıkarılma durumu -->
                  <th>ÜRÜN RESİM</th> <!-- Ürünün resim galerisi -->
                  <th>DÜZENLE</th> <!-- Ürünü düzenleme -->
                  <th>SİL</th> <!-- Ürünü silme -->
                </tr>
              </thead>
              <tbody>
                <?php 
                // Ürün tablosundaki verileri döngü ile çekiyoruz.
                while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                  <td><?php echo $uruncek['urun_ad']; ?></td> <!-- Ürün adını yazdırıyoruz -->
                  <td><?php echo $uruncek['urun_fiyat']; ?></td> <!-- Ürün fiyatını yazdırıyoruz -->
                  <td><?php echo $uruncek['urun_stok']; ?></td> <!-- Ürün stok miktarını yazdırıyoruz -->
                  <td><?php echo $uruncek['urun_seourl']; ?></td> <!-- Ürün SEO URL'sini yazdırıyoruz -->
                  <td>
                    <center>
                      <?php 
                      // Eğer ürün öne çıkarılmamışsa "Ön Çıkar" butonunu gösteriyoruz.
                      if ($uruncek['urun_onecikar'] == 0) { ?>
                        <a href="../islemler.php?urun_id=<?php echo $uruncek['urun_id']; ?>&urun_one=1&urun_onecikar=ok">
                          <button class="btn btn-success btn-xs">Ön Çıkar</button>
                        </a>
                      <?php 
                      // Eğer ürün öne çıkarılmışsa "Kaldır" butonunu gösteriyoruz.
                      } elseif ($uruncek['urun_onecikar'] == 1) { ?>
                        <a href="../islemler.php?urun_id=<?php echo $uruncek['urun_id']; ?>&urun_one=0&urun_onecikar=ok">
                          <button class="btn btn-warning btn-xs">Kaldır</button>
                        </a>
                      <?php } ?>
                    </center>
                  </td>
                  <td>
                    <!-- Ürün resim galerisi bağlantısı -->
                    <center>
                      <a href="urun-galeri.php?urun_id=<?php echo $uruncek['urun_id']; ?>">
                        <button class="btn btn-info btn-xs">Ürün Resim Galeri</button>
                      </a>
                    </center>
                  </td>
                  <td>
                    <!-- Ürün düzenleme bağlantısı -->
                    <center>
                      <a href="urun-duzenle.php?urun_id=<?php echo $uruncek['urun_id']; ?>">
                        <button class="btn btn-success btn-xs">DÜZENLE</button>
                      </a>
                    </center>
                  </td>
                  <td>
                    <!-- Ürün silme bağlantısı -->
                    <center>
                      <a href="../islemler.php?urun_id=<?php echo $uruncek['urun_id']; ?>&urunsil=ok">
                        <button class="btn btn-danger btn-xs">Sil</button>
                      </a>
                    </center>
                  </td>
                </tr>
                <?php } // while döngüsü sonu ?>
              </tbody>
            </table> <!-- Tablo sonu -->

          </div> <!-- Panel içeriği sonu -->
        </div> <!-- Panel sonu -->
      </div> <!-- Sütun sonu -->
    </div> <!-- Satır sonu -->
  </div> <!-- İçerik sonu -->
</div> <!-- Sağ kolon sonu -->

<?php include "footer.php"; // Footer dosyasını dahil ediyoruz. ?>
