<?php include"header.php"; // Header dosyasını dahil et, sayfanın üst kısmındaki genel yapı ve stil dosyalarını ekler

$ayaradi=$db->prepare("SELECT * FROM tblayar where ayar_id=:id"); // Veritabanından ayarları çekmek için hazırlanan sorgu
$ayaradi->execute(array(
  'id' => 0)); // 'id' parametresi ile veritabanı sorgusu çalıştırılır

$ayaryaz=$ayaradi->fetch(PDO::FETCH_ASSOC); // Veritabanından alınan veriler dizide saklanır ve ekrana yazdırılır

?>

<div class="right_col" role="main"> <!-- Sayfa içeriği bölümünü başlat -->

  <div class="page-title"> <!-- Sayfa başlığı kısmı -->
    <div class="title_left"> <!-- Sayfa başlığının sol kısmı -->
      <h3>Üye İşlemleri <small> <!-- Başlık ve küçük açıklama -->

        <?php 
        if ($_GET['durum']=='ok') {?> <!-- URL parametresi durumu 'ok' ise işlem başarılı mesajı -->
          <a style="color:green "> İşlem Başarılı</a> <!-- Başarılı işlem mesajı yeşil renkte -->
        <?php }elseif ($_GET['durum']=='no') {?> <!-- URL parametresi durumu 'no' ise işlem başarısız mesajı -->
            <a style="color:red "> İşlem Başarısız</a> <!-- Başarısız işlem mesajı kırmızı renkte -->
        <?php } ?>

      </small></h3> <!-- Başlık ve küçük açıklama sonu -->
    </div>
  </div>

  <div class="row"> <!-- Sayfa içeriğini satırlara yerleştiren bir yapı -->
   <div class=" col-xs-12"> <!-- 12 kolonlu genişlikte bir içerik -->
    <div class="x_panel"> <!-- İçeriğin paneli -->
      <div class="clearfix"></div> <!-- Paneli hizalamak için boşluk bırakır -->
        <br />

        <form action="../islemler.php" method="POST" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left"> <!-- Logo güncelleme formu -->

            <div class="form-group"> <!-- Logo seçme alanı -->
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yüklü Logo<br><span class="required">*</span> <!-- Yüklü logo başlığı -->
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12"> <!-- Logo görüntüleme alanı -->
                <?php 
                if (strlen($ayaryaz['ayar_logo'])>0) {?> <!-- Eğer logo varsa, resmi göster -->
                <img width="200"  src="../../images/<?php echo $ayaryaz['ayar_logo']; ?>"> <!-- Yüklü olan logo resmi göster -->
                <?php } else {?> <!-- Logo yoksa varsayılan resim göster -->
                <img width="200"  src="../../images/noimage.jpg"> <!-- Varsayılan logo resmi -->
                <?php } ?>
              </div>
            </div>

            <div class="form-group"> <!-- Resim yükleme alanı -->
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Resim Seç<span class="required">*</span> <!-- Resim seçme başlığı -->
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12"> <!-- Input alanı -->
                <input type="file" id="first-name" name="ayar_logo" class="form-control col-md-7 col-xs-12"> <!-- Dosya yükleme alanı -->
              </div>
            </div>

            <input type="hidden" name="eski_yol" value="<?php echo $ayaryaz['ayar_logo']; ?>"> <!-- Eski logo yolunu gizli alan olarak gönder -->

            <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"> <!-- Butonun sağa hizalanması -->
              <button type="submit" name="logoduzenle" class="btn btn-primary">Güncelle</button> <!-- Logo güncelleme butonu -->
            </div>

          </form>

          <hr> <!-- Formlar arasına yatay çizgi ekler -->

          <form action="../islemler.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"> <!-- Diğer site ayarlarını güncelleme formu -->

            <div class="form-group"> <!-- Site başlığı input alanı -->
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">SİTE BAŞLIK <span class="required">*</span> <!-- Site başlığı başlığı -->
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12"> <!-- Input alanı -->
                <input type="text" id="first-name" name="ayar_title" value="<?php echo $ayaryaz['ayar_title'] ?>" required="required" class="form-control col-md-7 col-xs-12"> <!-- Site başlığı input alanı -->
              </div>
            </div>

            <div class="form-group"> <!-- Site URL input alanı -->
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">SİTE URL <span class="required">*</span> <!-- Site URL başlığı -->
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12"> <!-- Input alanı -->
                <input type="text" id="first-name" name="ayar_url" value="<?php echo $ayaryaz['ayar_url'] ?>" required="required" class="form-control col-md-7 col-xs-12"> <!-- Site URL input alanı -->
              </div>
            </div>
            
            <div class="form-group"> <!-- Site açıklaması input alanı -->
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">SİTE AÇIKLAMA <span class="required">*</span> <!-- Site açıklaması başlığı -->
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12"> <!-- Input alanı -->
                <input type="text" id="first-name" name="ayar_description" value="<?php echo $ayaryaz['ayar_description'] ?>" required="required" class="form-control col-md-7 col-xs-12"> <!-- Site açıklaması input alanı -->
              </div>
            </div>
            
            <div class="form-group"> <!-- Site anahtar kelimeleri input alanı -->
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">SİTE ANAHTAR KELİME <span class="required">*</span> <!-- Site anahtar kelimeleri başlığı -->
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12"> <!-- Input alanı -->
                <input type="text" id="first-name" name="ayar_keywords" value="<?php echo $ayaryaz['ayar_keywords'] ?>" required="required" class="form-control col-md-7 col-xs-12"> <!-- Site anahtar kelimeleri input alanı -->
              </div>
            </div>
            
            <div class="form-group"> <!-- Site yazar adı input alanı -->
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">SİTE YAZAR <span class="required">*</span> <!-- Site yazar adı başlığı -->
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12"> <!-- Input alanı -->
                <input type="text" id="first-name" name="ayar_author" value="<?php echo $ayaryaz['ayar_author'] ?>" required="required" class="form-control col-md-7 col-xs-12"> <!-- Site yazar adı input alanı -->
              </div>
            </div>

            <!-- Diğer form alanları ve inputları aynı şekilde devam eder... -->

            <input type="hidden" name="ayar_id" value="<?php echo $ayaryaz['ayar_id'] ?>"> <!-- Gizli olarak ayar ID'sini gönderir -->

            <div class="ln_solid"></div> <!-- Formun alt kısmında ayrıcı çizgi -->
            <div class="form-group "> <!-- Güncelleme butonu -->
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 pull-right"> <!-- Butonun hizalanması -->
                <button type="submit" class="btn btn-success" name="ayarduzenle">Guncelle</button> <!-- Güncelleme butonu -->
              </div>
            </div>

          </form> <!-- Form bitişi -->
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php include"footer.php" ?>  <!-- Footer dosyasını dahil et, sayfanın alt
