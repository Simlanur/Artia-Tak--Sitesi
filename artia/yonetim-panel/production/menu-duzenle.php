<?php include"header.php"; // header.php dosyasını dahil ediyoruz, sayfa başlığı ve stil dosyalarını içerir ?>

<?php
// Veritabanından menü bilgilerini almak için SQL sorgusu yazıyoruz, menu_id'yi GET parametresinden alıyoruz
$menuadi=$db->prepare("SELECT * FROM tblmenu where menu_id=:id");// Veritabanından ilgili menu_id'ye sahip veriyi seçmek için sorgu hazırlıyoruz
$menuadi->execute(array(
  'id' => $_GET['menu_id']));// $_GET ile gelen menu_id'yi sorguya gönderiyoruz
$menuyaz=$menuadi->fetch(PDO::FETCH_ASSOC);// Sorgu sonucunu fetch ile alıyoruz ve diziyi döndürüyoruz
?>

<div class="right_col" role="main"> <!-- Sayfanın ana içeriği -->

  <div class="page-title"> <!-- Sayfa başlık kısmı -->
    <div class="title_left">
      <h3>Menu Duzenleme İşlemleri <small> <!-- Sayfa başlığını ekliyoruz -->
      
        <?php 
        // Durum parametresi ile işlem sonucu mesajlarını görüntülüyoruz
        if ($_GET['durum']=='ok') {?>
          <a style="color:green "> İşlem Başarılı</a> <!-- İşlem başarılıysa yeşil mesaj -->
        <?php }elseif ($_GET['durum']=='no') {?>
          <a style="color:red "> İşlem Başarısız</a> <!-- İşlem başarısızsa kırmızı mesaj -->
        <?php } ?>

      </small></h3>
    </div>
  </div>

  <div class="row"> <!-- Satır başı -->
    <div class=" col-xs-12"> <!-- 12 sütun genişliğinde bir alan -->
      <div class="x_panel"> <!-- Panel başlık ve içeriğini barındırır -->

        <ul class="nav navbar-right panel_toolbox"> <!-- Panel araçları sağ tarafta yer alır -->
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li> <!-- Paneli küçültme butonu -->
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a> <!-- Diğer ayarlar butonu -->
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Settings 1</a></li> <!-- Ayar 1 -->
              <li><a href="#">Settings 2</a></li> <!-- Ayar 2 -->
            </ul>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a></li> <!-- Paneli kapama butonu -->
        </ul>
        
        <div class="clearfix"></div> <!-- Paneldeki boşlukları temizler -->

        <div class="x_content"> <!-- Panel içeriği -->
          <form action="../islemler.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"> <!-- Form açılışı -->

            <div class="form-group"> <!-- Menü adı için form alanı -->
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Menu Adı<span class="required">*</span> <!-- Menü adı için label -->
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12"> <!-- Menü adı input alanı -->
                <input type="text" id="first-name" name="menu_adi" value="<?php echo $menuyaz['menu_adi'] ?>" required="required" class="form-control col-md-7 col-xs-12"> <!-- Menü adını almak için text input -->
              </div>
            </div>

            <div class="form-group"> <!-- Menü URL'si için form alanı -->
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Menu Url<span class="required">*</span> <!-- Menü URL'si için label -->
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12"> <!-- Menü URL input alanı -->
                <input type="text" id="first-name" name="menu_url" value="<?php echo $menuyaz['menu_url'] ?>" required="required" class="form-control col-md-7 col-xs-12"> <!-- Menü URL'sini almak için text input -->
              </div>
            </div>

            <div class="form-group"> <!-- Menü üst bilgisi için form alanı -->
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Menu Ust<span class="required">*</span> <!-- Menü üst bilgisi için label -->
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12"> <!-- Menü üst input alanı -->
                <input type="text" id="first-name" name="menu_ust" value="<?php echo $menuyaz['menu_ust'] ?>" required="required" class="form-control col-md-7 col-xs-12"> <!-- Menü üst bilgisini almak için text input -->
              </div>
            </div>

            <div class="form-group"> <!-- Menü sıra bilgisi için form alanı -->
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Menu Sıra<span class="required">*</span> <!-- Menü sıra için label -->
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12"> <!-- Menü sıra input alanı -->
                <input type="text" id="first-name" name="menu_sira" value="<?php echo $menuyaz['menu_sira'] ?>" required="required" class="form-control col-md-7 col-xs-12"> <!-- Menü sırasını almak için text input -->
              </div>
            </div>

            <div class="form-group"> <!-- Menü durumu için form alanı -->
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Menu Durum<span class="required">*</span> <!-- Menü durumu için label -->
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12"> <!-- Menü durumu select alanı -->
               <select id="heard" class="form-control" name="menu_durum" required> <!-- Menü durumu dropdown -->

                  <!-- Menü durumu aktifse, "Aktif" seçeneği seçili olarak gelir -->
                  <option value="1" <?php echo $menuyaz['menu_durum'] == '1' ? 'selected=""' : ''; ?>>Aktif</option>
                  <!-- Menü durumu pasifse, "Pasif" seçeneği seçili olarak gelir -->
                  <option value="0" <?php if ($menuyaz['menu_durum']==0) { echo 'selected=""'; } ?>>Pasif</option>

                 </select>
              </div>
            </div>

            <input type="hidden" name="menu_id" value="<?php echo $menuyaz['menu_id'] ?>"> <!-- Menü id'si gizli alan olarak formda taşınır -->

            <div class="ln_solid"></div> <!-- Formu ayıran çizgi -->

            <div class="form-group "> <!-- Kaydetme alanı -->
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 pull-right"> <!-- Kaydetme butonunun konumu -->
                <button type="submit" class="btn btn-success" name="menuduzenle">Guncelle</button> <!-- Menü düzenleme butonu -->
              </div>
            </div>

          </form> <!-- Form kapanışı -->
        </div> <!-- x_content kapanışı -->
      </div> <!-- x_panel kapanışı -->
    </div> <!-- col-xs-12 kapanışı -->
  </div> <!-- row kapanışı -->
</div> <!-- main içerik kapanışı -->

<?php include"footer.php" ?> <!-- footer.php dosyasını dahil ediyoruz, sayfanın alt kısmındaki bilgileri buradan alıyoruz -->
