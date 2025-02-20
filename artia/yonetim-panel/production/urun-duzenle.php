<?php 
include "header.php"; // Sayfanın üst kısmında ortak header dosyasını ekliyoruz.

$urunadi = $db->prepare("SELECT * FROM tblurunler WHERE urun_id=:id"); // Veritabanından ürün bilgilerini çekmek için sorguyu hazırlıyoruz.
$urunadi->execute(array(
  'id' => $_GET['urun_id'] // GET ile gelen ürün ID'sini sorguya bağlıyoruz.
));

$urunyaz = $urunadi->fetch(PDO::FETCH_ASSOC); // Sorgudan dönen sonucu fetch() ile alıyoruz ve bir dizi olarak döndürüyoruz.
?>

<div class="right_col" role="main"> <!-- Ana içerik alanını belirliyoruz. -->

  <div class="page-title"> <!-- Sayfa başlık alanı -->
    <div class="title_left"> <!-- Başlık alanının sol kısmı -->
      <h3>Üye İşlemleri <small> <!-- Başlık ve alt başlık -->
        <?php 
        // İşlem sonucuna göre başarı ya da başarısızlık mesajı gösteriyoruz.
        if ($_GET['durum'] == 'ok') { ?>
          <a style="color:green "> İşlem Başarılı</a> <!-- Başarılı işlem mesajı -->
        <?php } elseif ($_GET['durum'] == 'no') { ?>
          <a style="color:red "> İşlem Başarısız</a> <!-- Başarısız işlem mesajı -->
        <?php } ?>
      </small></h3>
    </div>
  </div>

  <div class="row"> <!-- İçerik satırı başlangıcı -->
    <div class="col-xs-12"> <!-- Tam genişlikte sütun -->
      <div class="x_panel"> <!-- Panel başlangıcı -->

        <ul class="nav navbar-right panel_toolbox"> <!-- Panelin sağ üst köşesindeki araçlar -->
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li> <!-- Paneli küçültme butonu -->
          <li class="dropdown"> <!-- Ayarlar menüsü -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              <i class="fa fa-wrench"></i>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Settings 1</a></li> <!-- Ayar 1 -->
              <li><a href="#">Settings 2</a></li> <!-- Ayar 2 -->
            </ul>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a></li> <!-- Paneli kapatma butonu -->
        </ul>
        <div class="clearfix"></div> <!-- Düzeni sıfırlama -->

        <div class="x_content"> <!-- Panel içeriği -->
          <!-- Ürün düzenleme formu -->
          <form action="../islemler.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

            <div class="form-group"> <!-- Ürün adı alanı -->
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Adı<span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="urun_ad" value="<?php echo $urunyaz['urun_ad'] ?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <div class="form-group"> <!-- Kategori numarası alanı -->
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Numarası<span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="kategori_id" value="<?php echo $urunyaz['kategori_id'] ?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <div class="form-group"> <!-- Ürün fiyatı alanı -->
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Fiyat<span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="urun_fiyat" value="<?php echo $urunyaz['urun_fiyat'] ?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <div class="form-group"> <!-- Ürün stok bilgisi alanı -->
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Stok<span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="urun_stok" value="<?php echo $urunyaz['urun_stok'] ?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <div class="form-group"> <!-- Ürün detay bilgisi alanı -->
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Detay <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea class="form-control" id="first-name" name="urun_detay" required="required" class="form-control col-md-7 col-xs-12"><?php echo $urunyaz['urun_detay'] ?></textarea>
              </div>
            </div>

            <input type="hidden" name="urun_id" value="<?php echo $urunyaz['urun_id'] ?>"> <!-- Ürün ID'si gizli alan -->

            <div class="ln_solid"></div> <!-- Form bölümleri arasında ayırıcı çizgi -->
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 pull-right">
                <button type="submit" class="btn btn-success" name="urunduzenle">Güncelle</button> <!-- Güncelle butonu -->
              </div>
            </div>

          </form> <!-- Form sonu -->
        </div>
      </div>
    </div>
  </div>
</div>

<?php 
include "footer.php"; // Sayfanın alt kısmında ortak footer dosyasını ekliyoruz.
?>
