<?php include"header.php"; // Header dosyasını dahil et (sayfanın üst kısmındaki genel yapı ve stil dosyalarını ekler) ?>

<div class="right_col" role="main"> <!-- Sayfa içeriği bölümünü başlat -->

  <div class="page-title"> <!-- Sayfa başlığı bölümünü başlat -->
    <div class="title_left"> <!-- Sayfa başlığının sol kısmı -->
      <h3>Slider İşlemleri <small> <!-- Slider işlemleri başlığı ve küçük açıklama -->

        <?php 
        if ($_GET['durum']=='ok') {?> <!-- URL parametresi durumu 'ok' ise işlem başarılı mesajı -->
          <a style="color:green "> İşlem Başarılı</a> <!-- Yeşil renkli başarılı mesajı -->
        <?php }elseif ($_GET['durum']=='no') {?> <!-- URL parametresi durumu 'no' ise işlem başarısız mesajı -->
          <a style="color:red "> İşlem Başarısız</a> <!-- Kırmızı renkli başarısız mesajı -->
        <?php } ?>

      </small></h3> <!-- Başlık sonu -->
    </div>
  </div>

  <div class="row"> <!-- Sayfa içeriğini satırlara yerleştiren bir yapı -->
   <div class=" col-xs-12"> <!-- 12 kolonlu genişlikte bir içerik -->
    <div class="x_panel"> <!-- İçeriğin paneli -->

      <ul class="nav navbar-right panel_toolbox"> <!-- Panel araçları menüsü -->
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li> <!-- Paneli küçültme butonu -->
        <li class="dropdown"> <!-- Dropdown menüsü -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a> <!-- Ayarlar menüsünü açma butonu -->
          <ul class="dropdown-menu" role="menu"> <!-- Dropdown menü içeriği -->
            <li><a href="#">Settings 1</a></li> <!-- Menünün birinci seçeneği -->
            <li><a href="#">Settings 2</a></li> <!-- Menünün ikinci seçeneği -->
          </ul>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a></li> <!-- Paneli kapama butonu -->
      </ul>
      <div class="clearfix"></div> <!-- Elemanları hizalamak için boşluk bırakır -->

      <div class="x_content"> <!-- Panel içeriği -->
        <form action="../islemler.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data"> <!-- Formu oluşturur, verilerin gönderileceği URL ve diğer özellikleri ayarlar -->

          <div class="form-group"> <!-- Resim seçme input alanı -->
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Resim Seç<span class="required">*</span> <!-- Resim seçme alanının başlığı -->
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12"> <!-- Input alanı -->
              <input type="file" id="first-name" name="slider_resimyol" class="form-control col-md-7 col-xs-12"> <!-- Dosya yükleme alanı -->
            </div>
          </div>

          <div class="form-group"> <!-- Slider adı input alanı -->
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Slider Adı<span class="required">*</span> <!-- Slider adı alanının başlığı -->
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12"> <!-- Input alanı -->
              <input type="text" id="first-name" name="slider_ad" required="required" class="form-control col-md-7 col-xs-12"> <!-- Slider adı input alanı -->
            </div>
          </div>
          
          <div class="form-group"> <!-- Slider linki input alanı -->
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Slider Link<span class="required">*</span> <!-- Slider linki alanının başlığı -->
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12"> <!-- Input alanı -->
              <input type="text" id="first-name" name="slider_link" class="form-control col-md-7 col-xs-12"> <!-- Slider linki input alanı -->
            </div>
          </div>

          <div class="ln_solid"></div> <!-- Formun alt kısmında ayrıcı çizgi -->

          <div class="form-group "> <!-- Kaydetme butonu -->
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 pull-right"> <!-- Butonun hizalanması -->

              <button type="submit" class="btn btn-success" name="sliderkaydet">Kaydet</button> <!-- Kaydet butonu -->

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
</div>

<?php include"footer.php" ?>  <!-- Footer dosyasını dahil et (sayfanın alt kısmındaki genel yapı ve stil dosyalarını ekler) -->
