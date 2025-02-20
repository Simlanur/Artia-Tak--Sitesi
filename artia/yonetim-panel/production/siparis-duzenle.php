<?php include"header.php"; // header.php dosyasını dahil ediyoruz, bu genellikle sayfa başlıkları ve stil dosyaları içerir

// siparis_id'ye göre sipariş bilgilerini çekmek için sorgu oluşturuyoruz
$siparissor=$db->prepare("SELECT * FROM tblsiparis where siparis_id=:id");
$siparissor->execute(array(
  'id' => $_GET['siparis_id'] // URL'den gelen siparis_id'yi kullanarak veritabanından siparişi getiriyoruz
));

// Çekilen sipariş verisini bir dizi olarak alıyoruz
$sipariscek=$siparissor->fetch(PDO::FETCH_ASSOC);
?>

<div class="right_col" role="main"> <!-- Sayfanın ana içerik kısmı -->

  <div class="page-title"> <!-- Sayfa başlığı kısmı -->
    <div class="title_left">
      <h3>siparis Güncelleme İşlemleri <small>
        <?php 
        // URL parametrelerinden 'durum' değerine göre işlem başarısını bildiriyoruz
        if ($_GET['durum']=='ok') {?> 

          <a style="color:green "> İşlem Başarılı</a> <!-- Başarılı işlem mesajı -->

        <?php }elseif ($_GET['durum']=='no') {?> 

          <a style="color:red "> İşlem Başarısız</a> <!-- Başarısız işlem mesajı -->

        <?php } ?>
      </small></h3>
    </div>
  </div>

  <div class="row">
   <div class="col-xs-12"> <!-- 12 sütun genişliğinde bir alan -->
    <div class="x_panel"> <!-- İçerik paneli -->

      <ul class="nav navbar-right panel_toolbox"> <!-- Panel araç çubuğu -->
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li> <!-- Paneli yukarıya katlama butonu -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a> <!-- Diğer ayar menüsü -->
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a></li> <!-- Paneli kapatma butonu -->
      </ul>
      <div class="clearfix"></div> <!-- Boşlukları temizler -->

      <div class="x_content"> <!-- Panel içeriği -->

        <form action="../islemler.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"> <!-- Form başlatıyoruz -->

        <!-- Sipariş durumu güncelleme alanı -->
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Siparis Durum<span class="required">*</span></label> <!-- Durum seçme etiketinin başlığı -->
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select id="heard" class="form-control" name="siparis_durum" required> <!-- Sipariş durumu için bir dropdown (açılır menü) -->
              <!-- Sipariş durumu seçeneklerini oluşturuyoruz ve mevcut durumu seçili yapıyoruz -->
              <option value="4" <?php echo $sipariscek['siparis_durum'] == '4' ? 'selected=""' : ''; ?>>İptal edildi</option>
              <option value="3" <?php echo $sipariscek['siparis_durum'] == '3' ? 'selected=""' : ''; ?>>Kargo Teslim Edildi</option>
              <option value="2" <?php echo $sipariscek['siparis_durum'] == '2' ? 'selected=""' : ''; ?>>Kargoya Verildi</option>
              <option value="1" <?php echo $sipariscek['siparis_durum'] == '1' ? 'selected=""' : ''; ?>>Ödeme Onaylandı</option>
              <option value="0" <?php if ($sipariscek['siparis_durum']==0) { echo 'selected=""'; } ?>>Ödeme Bekleniyor</option>
            </select>
          </div>
        </div>

        <!-- Sipariş ID'sini gizli olarak form içinde gönderiyoruz -->
        <input type="hidden" name="siparis_id" value="<?php echo $sipariscek['siparis_id'] ?>">

        <div class="ln_solid"></div> <!-- Form ayırıcı çizgi -->

        <div class="form-group">
          <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <!-- Güncelle butonunu sağa hizalı olarak ekliyoruz -->
            <button type="submit" name="siparisduzenle" class="btn btn-success">Güncelle</button>
          </div>
        </div>

        </form> <!-- Form bitişi -->

      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>

<?php include"footer.php" ?> <!-- footer.php dosyasını dahil ediyoruz, genellikle sayfa alt bilgileri burada yer alır -->
