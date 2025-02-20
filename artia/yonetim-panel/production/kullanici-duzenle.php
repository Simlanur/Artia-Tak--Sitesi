<?php include"header.php"; // header.php dosyasını dahil ediyoruz, sayfanın başlık ve stil dosyalarını içerir ?>

<?php
// Kullanıcı bilgilerini veritabanından çekmek için sorgu hazırlanıyor
$kullaniciadi=$db->prepare("SELECT * FROM tbluyeler where kullanici_id=:id"); // tbluyeler tablosundan, id'ye göre kullanıcıyı çekiyoruz
$kullaniciadi->execute(array(
  'id' => $_GET['kullanici_id'])); // gelen GET parametresi ile kullanıcı id'sini alıp sorguyu çalıştırıyoruz

$kullaniciyaz=$kullaniciadi->fetch(PDO::FETCH_ASSOC); // Kullanıcı bilgilerini fetch() ile alıyoruz ve dizi olarak getiriyoruz
?>

<div class="right_col" role="main"> <!-- Sayfanın ana içerik alanı -->

  <div class="page-title"> <!-- Sayfa başlığı alanı -->
    <div class="title_left"> <!-- Sayfa başlığı sol alanı -->
      <h3>Üye İşlemleri <small> <!-- Üye işlemleri başlığı ve alt başlık -->
        <?php 
        if ($_GET['durum']=='ok') { ?> <!-- Eğer durum "ok" ise işlem başarılı -->
        <a style="color:green "> İşlem Başarılı</a> <!-- İşlem başarılı mesajı -->
        <?php }elseif ($_GET['durum']=='no') { ?> <!-- Eğer durum "no" ise işlem başarısız -->
        <a style="color:red "> İşlem Başarısız</a> <!-- İşlem başarısız mesajı -->
        <?php } ?>
      </small></h3>
    </div>
  </div>

  <div class="row"> <!-- Satır başlatılıyor -->
   <div class="col-xs-12"> <!-- 12 kolon genişliğinde bir sütun başlatılıyor -->
    <div class="x_panel"> <!-- Panel başlatılıyor -->

      <ul class="nav navbar-right panel_toolbox"> <!-- Menü araç kutusu -->
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> <!-- Paneli küçültme simgesi -->
        </li>
        <li class="dropdown"> <!-- Menü öğesi -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a> <!-- Dropdown menüsü -->
          <ul class="dropdown-menu" role="menu"> <!-- Menü içeriği -->
            <li><a href="#">Settings 1</a></li> <!-- Ayar 1 -->
            <li><a href="#">Settings 2</a></li> <!-- Ayar 2 -->
          </ul>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a> <!-- Paneli kapama simgesi -->
        </li>
      </ul>
      <div class="clearfix"></div> <!-- Temizleme (diğer öğelerin düzgün hizalanması için) -->

      <div class="x_content"> <!-- İçerik kısmı başlıyor -->
        <form action="../islemler.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"> <!-- Form başlatılıyor, veri gönderme işlemi islemler.php'ye yapılacak -->

          <div class="form-group"> <!-- Form grubu başlatılıyor -->
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">AD SOYAD <span class="required">*</span></label> <!-- Etiket kısmı (Ad Soyad) -->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="first-name" name="kullanici_adsoyad" value="<?php echo $kullaniciyaz['kullanici_adsoyad'] ?>" required="required" class="form-control col-md-7 col-xs-12"> <!-- Kullanıcının ad ve soyadını input alanında gösteriyoruz -->
            </div>
          </div>

          <div class="form-group"> <!-- Form grubu başlatılıyor -->
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ADRES <span class="required">*</span></label> <!-- Etiket kısmı (Adres) -->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea class="form-control" id="first-name" name="kullanici_adres" rows="5" required="required" id="comment" class="form-control col-md-7 col-xs-12"><?php echo $kullaniciyaz['kullanici_adres'] ?></textarea> <!-- Kullanıcının adresini textarea alanında gösteriyoruz -->
            </div>
          </div>

          <div class="form-group"> <!-- Form grubu başlatılıyor -->
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">MAİL <span class="required">*</span></label> <!-- Etiket kısmı (Mail) -->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="first-name" name="kullanici_mail" value="<?php echo $kullaniciyaz['kullanici_mail'] ?>" required="required" class="form-control col-md-7 col-xs-12"> <!-- Kullanıcının mail adresini input alanında gösteriyoruz -->
            </div>
          </div>

          <div class="form-group"> <!-- Form grubu başlatılıyor -->
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">TELEFON <span class="required">*</span></label> <!-- Etiket kısmı (Telefon) -->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="tel" id="first-name" placeholder="(0000)-(000)-(00)-(00)" name="kullanici_tel" value="<?php echo $kullaniciyaz['kullanici_tel'] ?>" required="required" class="form-control col-md-7 col-xs-12"> <!-- Kullanıcının telefon numarasını input alanında gösteriyoruz -->
            </div>
          </div>

          <div class="form-group"> <!-- Form grubu başlatılıyor -->
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">KULLANICI ADI <span class="required">*</span></label> <!-- Etiket kısmı (Kullanıcı Adı) -->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="first-name" name="kullanici_adi" value="<?php echo $kullaniciyaz['kullanici_adi'] ?>" required="required" class="form-control col-md-7 col-xs-12"> <!-- Kullanıcının adını input alanında gösteriyoruz -->
            </div>
          </div>

          <div class="form-group"> <!-- Form grubu başlatılıyor -->
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">SİFRE <span class="required">*</span></label> <!-- Etiket kısmı (Şifre) -->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="first-name" name="kullanici_sifre" value="<?php echo $kullaniciyaz['kullanici_sifre'] ?>" required="required" class="form-control col-md-7 col-xs-12"> <!-- Kullanıcının şifresini input alanında gösteriyoruz -->
            </div>
          </div>

          <div class="form-group"> <!-- Form grubu başlatılıyor -->
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">KAYIT TARİHİ <span class="required">*</span></label> <!-- Etiket kısmı (Kayıt Tarihi) -->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="datetime" id="first-name" name="kullanici_kayit_tarihi" value="<?php echo $kullaniciyaz['kullanici_kayit_tarihi'] ?>" required="required" class="form-control col-md-7 col-xs-12"> <!-- Kullanıcının kayıt tarihini input alanında gösteriyoruz -->
            </div>
          </div>

          <div class="form-group"> <!-- Form grubu başlatılıyor -->
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanıcı Durum<span class="required">*</span></label> <!-- Etiket kısmı (Kullanıcı Durumu) -->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select id="heard" class="form-control" name="kullanici_durum" required> <!-- Durum seçimi dropdown menüsü -->
                <option value="1" <?php echo $kullaniciyaz['kullanici_durum'] == '1' ? 'selected=""' : ''; ?>>Aktif</option> <!-- Eğer kullanıcı aktifse Aktif seçeneği seçili olacak -->
                <option value="0" <?php if ($kullaniciyaz['kullanici_durum']==0) { echo 'selected=""'; } ?>>Pasif</option> <!-- Eğer kullanıcı pasifse Pasif seçeneği seçili olacak -->
              </select>
            </div>
          </div>

          <input type="hidden" name="kullanici_id" value="<?php echo $kullaniciyaz['kullanici_id'] ?>"> <!-- Kullanıcı ID'si gizli olarak gönderiliyor -->
          
          <div class="ln_solid"></div> <!-- Bir yatay çizgi -->
          <div class="form-group "> <!-- Form grubu başlatılıyor -->
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 pull-right"> <!-- Formu sağa yaslıyoruz -->

              <button type="submit" class="btn btn-success" name="kullaniciduzenle">Güncelle</button> <!-- Formu göndermek için buton -->
            </div>
          </div>

        </form> <!-- Form bitişi -->
      </div> <!-- İçerik bitişi -->
    </div> <!-- Panel bitişi -->
  </div> <!-- Sütun bitişi -->
</div> <!-- Satır bitişi -->
</div> <!-- Sayfa içeriği bitişi -->

<?php include"footer.php" ?> <!-- footer.php dosyasını dahil ediyoruz -->
