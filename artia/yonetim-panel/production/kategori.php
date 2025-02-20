<?php include"header.php"; // header.php dosyasını dahil ediyoruz, sayfanın başlık ve stil dosyalarını içerir

// Kategori tablosundaki tüm verileri sırasıyla almak için SQL sorgusu hazırlıyoruz
$kategorisor=$db->prepare("SELECT * FROM tblkategori ORDER BY kategori_sira ASC "); 
$kategorisor->execute(); // SQL sorgusunu çalıştırıyoruz
?>

<div class="right_col" role="main"> <!-- Sayfa içeriği başlıyor -->
  <div class=""> <!-- Sayfa başlığı alanı -->
    <div class="page-title"> <!-- Sayfa başlığı kısmı -->
      <div class="title_left"> <!-- Başlık sol alanı -->
        <h3>Kategori İşlemleri <small> <!-- Başlık ve alt başlık -->
        </small></h3>
      </div>
    </div>

    <div class="row"> <!-- Yeni satır başlatılıyor -->
      <div class=" col-xs-12"> <!-- 12 kolon genişliğinde bir sütun başlatılıyor -->
        <div class="x_panel"> <!-- Panel başlatılıyor -->

          <!-- Yeni kategori eklemek için buton -->
          <a href="kategori-ekle.php">  <button type="button" class="btn btn-primary"> YENİ KATEGORİ EKLE</button></a>
          <div class="clearfix"></div> <!-- Temizleme, panel öğelerinin düzgün hizalanması için -->

          <div class="x_content" > <!-- İçerik kısmı başlıyor -->

            <table class="table table-bordered" style="text-align: center;" > <!-- Tablo başlatılıyor -->
              <thead > <!-- Tablo başlıkları -->
                <tr>
                  <th>Kategori Id</th> <!-- Kategori ID başlığı -->
                  <th>Kategori Adı</th> <!-- Kategori Adı başlığı -->
                  <th>Kategori Ust</th> <!-- Kategori Üst başlığı -->
                  <th>Kategori Sira</th> <!-- Kategori Sıra başlığı -->
                  <th>Kategori Durum</th> <!-- Kategori Durum başlığı -->
                  <th>Kategori Url</th> <!-- Kategori URL başlığı -->
                  <th>Kategori SeoUrl</th> <!-- Kategori SEO URL başlığı -->     
                  <th>Duzenle</th> <!-- Düzenle başlığı -->
                  <th>Sil</th> <!-- Sil başlığı -->
                </tr>
              </thead>
              <tbody> <!-- Tablo verilerini yerleştireceğimiz kısım -->
                <?php 
                // Kategoriler veritabanından çekilip satır satır döngü ile yazdırılıyor
                while ($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) { ?> <!-- Verileri döngü ile çekiyoruz -->

                <tr> <!-- Tablo satırı başlıyor -->
                  <td><?php echo $kategoricek['kategori_id'] ?></td> <!-- Kategori ID'sini tabloya ekliyoruz -->
                  <td><?php echo $kategoricek['kategori_adi'] ?></td> <!-- Kategori adını tabloya ekliyoruz -->
                  <td><?php echo $kategoricek['kategori_ust'] ?></td> <!-- Kategori üst bilgisini tabloya ekliyoruz -->
                  <td><?php echo $kategoricek['kategori_sira'] ?></td> <!-- Kategori sırasını tabloya ekliyoruz -->

                  <td><?php 
                  // Durum kontrolü yapılıyor, aktif veya pasif olarak gösteriliyor
                  if($kategoricek['kategori_durum'] == 1) { ?> 
                   <button type="button" class="btn btn-success btn-xs">Aktif</button> <!-- Aktif durumu için buton -->
                   <?php } else { ?>
                     <button type="button" class="btn btn-danger btn-xs">Pasif</button> <!-- Pasif durumu için buton -->
                     <?php }
                     ?>
                   </td>

                   <td><?php echo $kategoricek['kategori_url'] ?></td> <!-- Kategori URL'sini tabloya ekliyoruz -->
                   <td><?php echo $kategoricek['kategori_seourl'] ?></td> <!-- Kategori SEO URL'sini tabloya ekliyoruz -->

                   <!-- Düzenle butonu -->
                   <td><center><a href="kategori-duzenle.php?kategori_id=<?php echo $kategoricek['kategori_id']?>"><button class="btn btn-success btn-xs">DÜZENLE</button></center></a></td>

                   <!-- Silme işlemi için buton, işlemi "islemler.php" dosyasına yönlendiriyor -->
                   <td><center><a href="../islemler.php?kategori_id=<?php echo $kategoricek['kategori_id']; ?>&kategorisil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
                 </tr>

                 <?php } // Döngü bitişi ?>

               </tbody>
             </table> <!-- Tablo bitişi -->

           </div> <!-- İçerik bitişi -->
         </div> <!-- Panel bitişi -->
       </div> <!-- Sütun bitişi -->
     </div> <!-- Satır bitişi -->
   </div> <!-- Sayfa içeriği bitişi -->
</div> <!-- Sayfa içeriği bitişi -->

<?php include"footer.php" ?> <!-- footer.php dosyasını dahil ediyoruz -->
