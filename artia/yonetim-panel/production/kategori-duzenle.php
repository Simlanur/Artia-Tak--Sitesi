<?php include"header.php"; // header.php dosyasını dahil ediyoruz, sayfanın başlık ve stil dosyalarını içerir

// Kategori tablosundan güncellenmesi gereken kategoriye ait veriyi çekiyoruz, kategori_id parametresini alıyoruz
$kategorisor=$db->prepare("SELECT * FROM tblkategori where kategori_id=:id");
$kategorisor->execute(array(
  'id' => $_GET['kategori_id'] // URL'den gelen kategori_id'yi alarak veritabanına gönderiyoruz
));

$kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC); // Veritabanından çekilen sonucu dizi olarak alıyoruz
?>

<div class="right_col" role="main"> <!-- Sayfa içeriği başlıyor -->

  <div class="page-title"> <!-- Sayfa başlığı kısmı -->
    <div class="title_left"> <!-- Başlık sol kısmı -->
      <h3>Kategori Güncelleme İşlemleri <small> <!-- Başlık ve alt başlık -->

        <?php 
        // Durum kontrolü yapılıyor, işlem başarılı ya da başarısız mesajı gösteriliyor
        if ($_GET['durum']=='ok') {?>
          <a style="color:green "> İşlem Başarılı</a> <!-- Başarılı işlem mesajı -->
          <?php }elseif ($_GET['durum']=='no') {?>
            <a style="color:red "> İşlem Başarısız</a> <!-- Başarısız işlem mesajı -->
            <?php } ?>

          </small></h3>
        </div>
      </div>

      <div class="row"> <!-- Yeni satır başlatılıyor -->
        <div class=" col-xs-12"> <!-- 12 kolon genişliğinde bir sütun başlatılıyor -->
          <div class="x_panel"> <!-- Panel başlatılıyor -->

            <!-- Panel araçları, sağdaki butonlar -->
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> <!-- Paneli küçültme butonu -->
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a> <!-- Diğer seçenekler için menü -->
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a> <!-- Paneli kapatma butonu -->
              </li>
            </ul>
            <div class="clearfix"></div> <!-- Temizleme, panel öğelerinin düzgün hizalanması için -->

            <div class="x_content"> <!-- İçerik kısmı başlıyor -->
              <!-- Kategori güncelleme formu -->
              <form action="../islemler.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"> 

                <div class="form-group"> <!-- Kategori adı için form grubu -->
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Ad <span class="required">*</span> <!-- Etiket ve zorunlu alan simgesi -->
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12"> <!-- Formun girişi -->
                    <input type="text" id="first-name" name="kategori_adi" value="<?php echo $kategoricek['kategori_adi'] ?>" required="required" class="form-control col-md-7 col-xs-12"> <!-- Kategori adı için metin girişi -->
                  </div>
                </div>

                <div class="form-group"> <!-- Kategori sırası için form grubu -->
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Sıra <span class="required">*</span> <!-- Etiket ve zorunlu alan simgesi -->
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12"> <!-- Formun girişi -->
                    <input type="text" id="first-name" name="kategori_sira" value="<?php echo $kategoricek['kategori_sira'] ?>" required="required" class="form-control col-md-7 col-xs-12"> <!-- Kategori sırası için metin girişi -->
                  </div>
                </div>

                <div class="form-group"> <!-- Kategori durumu için form grubu -->
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Durum<span class="required">*</span> <!-- Etiket ve zorunlu alan simgesi -->
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12"> <!-- Formun girişi -->
                    <select id="heard" class="form-control" name="kategori_durum" required> <!-- Kategori durumu seçimi için açılır menü -->

                      <!-- Kategori durumu aktif ise 'Aktif' seçeneği işaretlenir -->
                      <option value="1" <?php echo $kategoricek['kategori_durum'] == '1' ? 'selected=""' : ''; ?>>Aktif</option>

                      <!-- Kategori durumu pasif ise 'Pasif' seçeneği işaretlenir -->
                      <option value="0" <?php if ($kategoricek['kategori_durum']==0) { echo 'selected=""'; } ?>>Pasif</option>

                    </select>
                  </div>
                </div>

                <!-- Kategori id'si gizli bir input ile form gönderiminde kullanılır -->
                <input type="hidden" name="kategori_id" value="<?php echo $kategoricek['kategori_id'] ?>">  

                <div class="ln_solid"></div> <!-- Bölücü çizgi -->
                <div class="form-group"> <!-- Formu gönderme butonunun grubu -->
                  <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"> <!-- Butonun konumu -->
                    <button type="submit" name="kategoriduzenle" class="btn btn-success">Güncelle</button> <!-- Kategori güncelleme butonu -->
                  </div>
                </div>

              </form> <!-- Form bitişi -->

            </div> <!-- İçerik bitişi -->
          </div> <!-- Panel bitişi -->
        </div> <!-- Sütun bitişi -->
      </div> <!-- Satır bitişi -->
    </div> <!-- Sayfa içeriği bitişi -->
</div> <!-- Sayfa içeriği bitişi -->

<?php include"footer.php" ?> <!-- footer.php dosyasını dahil ediyoruz -->
