<?php include"header.php"; // header.php dosyasını dahil ediyoruz (sayfanın üst kısmı, stil ve menü içerir)

$ayaradi=$db->prepare("SELECT * FROM hakkimizda where hakkimizda_id=:id"); // Veritabanından hakkımızda tablosundaki veriyi seçiyoruz, id 0 olan veriyi çekiyoruz
$ayaradi->execute(array(
  'id' => 0)); // id'yi 0 olarak ayarlıyoruz

$ayaryaz=$ayaradi->fetch(PDO::FETCH_ASSOC); // Veritabanından gelen veriyi bir dizi olarak çekiyoruz

?>

<head>
<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script> <!-- CKEditor metin düzenleyicisini dahil ediyoruz -->
</head>

<div class="right_col" role="main"> <!-- Ana içerik bölümü -->
  <div class="page-title"> <!-- Sayfa başlığı kısmı -->
    <div class="title_left"> <!-- Sol başlık kısmı -->
      <h3>Üye İşlemleri <small> <!-- Sayfa başlığı "Üye İşlemleri" -->
        <?php 
        if ($_GET['durum']=='ok') {?> <!-- Eğer durum parametresi 'ok' ise -->
        <a style="color:green "> İşlem Başarılı</a> <!-- İşlem başarılı mesajı -->
        <?php }elseif ($_GET['durum']=='no') {?> <!-- Eğer durum parametresi 'no' ise -->
        <a style="color:red "> İşlem Başarısız</a> <!-- İşlem başarısız mesajı -->
        <?php } ?>
      </small></h3>
    </div>
  </div>

  <div class="row"> <!-- Sayfanın içerik kısmı, satır başlatma -->
   <div class=" col-xs-12"> <!-- Sayfanın genel kolon yapısı -->
    <div class="x_panel"> <!-- Panel başlatıyoruz -->

      <div class="clearfix"></div> <!-- Alanları temizliyoruz, hizalamak için -->

      <form action="../islemler.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"> <!-- Form başlatıyoruz, POST ile islemler.php'ye veri gönderilecek -->

        <div class="form-group"> <!-- Form elemanları için grup oluşturuyoruz -->
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">HAKKIMIZDA BAŞLIK <span class="required">*</span> <!-- Başlık alanı etiket -->
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="first-name" name="hakkimizda_baslik" value="<?php echo $ayaryaz['hakkimizda_baslik'] ?>" required="required" class="form-control col-md-7 col-xs-12"> <!-- Başlık girişi alanı -->
          </div>
        </div>
		  
        <!-- Ck Editör Başlangıç -->

        <div class="form-group"> <!-- İçerik için form alanı -->
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">İçerik <span class="required">*</span> <!-- İçerik etiket -->
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea  class="ckeditor" id="editor1" name="hakkimizda_icerik"><?php echo $ayaryaz['hakkimizda_icerik']; ?></textarea> <!-- CKEditor metin düzenleyicisi ile içerik alanı -->
          </div>
        </div>

        <script type="text/javascript"> <!-- CKEditor yapılandırması -->
          CKEDITOR.replace( 'editor1', { // CKEditor'ü editor1 alanına uygula
            filebrowserBrowseUrl : 'ckfinder/ckfinder.html', // Dosya seçimi için URL
            filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images', // Görsel seçimi için URL
            filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash', // Flash dosyası seçimi için URL
            filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files', // Dosya yükleme URL
            filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images', // Görsel yükleme URL
            filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash', // Flash yükleme URL
            forcePasteAsPlainText: true // Metni düz metin olarak yapıştırmayı zorunlu kılar
          });
        </script>

        <!-- Ck Editör Bitiş -->

        <div class="form-group"> <!-- Video alanı için form elemanı -->
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">HAKKIMIZDA VİDEO <span class="required">*</span> <!-- Video URL etiket -->
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="first-name" name="hakkimizda_video" value="<?php echo $ayaryaz['hakkimizda_video'] ?>" required="required" class="form-control col-md-7 col-xs-12"> <!-- Video URL girişi -->
          </div>
        </div>

        <div class="form-group"> <!-- Vizyon alanı için form elemanı -->
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">HAKKIMIZDA VİZYON <span class="required">*</span> <!-- Vizyon etiket -->
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="first-name" name="hakkimizda_vizyon" value="<?php echo $ayaryaz['hakkimizda_vizyon'] ?>" required="required" class="form-control col-md-7 col-xs-12"> <!-- Vizyon girişi -->
          </div>
        </div>

        <div class="ln_solid"></div> <!-- Yatay çizgi ile ayırma -->
        <div class="form-group "> <!-- Form elemanlarının alt kısmı -->
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 pull-right"> <!-- Butonun sağa yaslanması -->

            <button type="submit" class="btn btn-success" name="hakkimizdaduzenle">Guncelle</button> <!-- Gönder butonu -->

          </div>
        </div>

      </form>

    </div>
  </div>
</div>
</div>
</div>
</div>

<?php include"footer.php" ?> <!-- footer.php dosyasını dahil ediyoruz (sayfanın alt kısmı ve kapanış etiketleri) -->
