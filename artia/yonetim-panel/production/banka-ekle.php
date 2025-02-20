<?php include"header.php";  // header.php dosyasını dahil ederek sayfa başlığını ve üst kısmı ekliyoruz
?>

<div class="right_col" role="main">  <!-- Sayfanın ana içeriğini başlatıyoruz -->

  <div class="page-title">  <!-- Sayfa başlık kısmı -->
    <div class="title_left">  <!-- Başlık kısmının sol kısmı -->
      <h3>Banka Ekleme İşlemleri <small>  <!-- Sayfanın başlığı -->

        <?php 
        // Durum parametresine göre işlem sonucunu kullanıcıya gösteriyoruz
        if ($_GET['durum']=='ok') {?>  <!-- Eğer URL'de 'durum' parametresi 'ok' ise başarılı mesajı göster -->
        <a style="color:green "> İşlem Başarılı</a>  <!-- Yeşil renkte "İşlem Başarılı" mesajı -->
        <?php }elseif ($_GET['durum']=='no') {?>  <!-- Eğer 'durum' parametresi 'no' ise başarısız mesajı göster -->
        <a style="color:red "> İşlem Başarısız</a>  <!-- Kırmızı renkte "İşlem Başarısız" mesajı -->
        <?php } ?>

      </small></h3>
    </div>
  </div>

  <div class="row">  <!-- Sayfa içeriğinin satırlarını oluşturuyoruz -->
   <div class=" col-xs-12">  <!-- Sayfa alanını 12 kolon genişliğinde yapıyoruz -->
    <div class="x_panel">  <!-- İçerik için bir panel başlatıyoruz -->

      <ul class="nav navbar-right panel_toolbox">  <!-- Panel araç kutusu başlatıyoruz -->
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>  <!-- Paneli küçültme butonu -->
        </li>
        <li class="dropdown">  <!-- Diğer araçlar için dropdown menüsü -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>  <!-- Ayarlar ikonuna tıklama -->
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>  <!-- Paneli kapatma butonu -->
        </li>
      </ul>
      <div class="clearfix"></div>  <!-- Panelin altında kalan boşluğu temizliyoruz -->

      <div class="x_content">  <!-- Panel içeriği başlıyor -->
        <form action="../islemler.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">  <!-- Form başlatıyoruz ve işlemler.php dosyasına veri göndereceğiz -->

          <!-- Banka Adı form alanı -->
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Banka Adı <span class="required">*</span>  <!-- Banka adı etiketi -->
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">  <!-- Form alanının genişliğini ayarlıyoruz -->
              <input type="text" id="first-name" name="banka_ad" value="<?php echo $bankacek['banka_ad'] ?>" required="required" class="form-control col-md-7 col-xs-12">  <!-- Banka adı input alanı -->
            </div>
          </div>

          <!-- Banka IBAN form alanı -->
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Banka İBAN <span class="required">*</span>  <!-- Banka IBAN etiketi -->
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">  <!-- Form alanının genişliğini ayarlıyoruz -->
              <input type="text" id="first-name" name="banka_iban" value="<?php echo $bankacek['banka_iban'] ?>" required="required" class="form-control col-md-7 col-xs-12">  <!-- Banka IBAN input alanı -->
            </div>
          </div>

          <!-- Banka Hesap Ad Soyad form alanı -->
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Banka Hesap Ad Soyad <span class="required">*</span>  <!-- Banka hesap sahibinin adı ve soyadı etiketi -->
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">  <!-- Form alanının genişliğini ayarlıyoruz -->
              <input type="text" id="first-name" name="banka_hesap_adsoyad" value="<?php echo $bankacek['banka_hesap_adsoyad'] ?>" required="required" class="form-control col-md-7 col-xs-12">  <!-- Hesap sahibinin adı ve soyadı input alanı -->
            </div>
          </div>

          <div class="ln_solid"></div>  <!-- Görsel bir ayrım çizgisi ekliyoruz -->

          <!-- Form gönderme butonu -->
          <div class="form-group">
            <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">  <!-- Butonu sağa hizalıyoruz -->
              <button type="submit" name="bankaekle" class="btn btn-success">EKLE</button>  <!-- "EKLE" butonunu ekliyoruz -->
            </div>
          </div>

        </form>  <!-- Formu sonlandırıyoruz -->

      </div>  <!-- Panel içeriğini bitiriyoruz -->
    </div>  <!-- Paneli kapatıyoruz -->
  </div>  <!-- 12 kolonluk alanı kapatıyoruz -->
</div>  <!-- Satır içeriğini bitiriyoruz -->

</div>  <!-- Sayfa içeriğini kapatıyoruz -->

<?php include"footer.php" ?>  <!-- footer.php dosyasını dahil ederek sayfanın alt kısmını ekliyoruz -->
