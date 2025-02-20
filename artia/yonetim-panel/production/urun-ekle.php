<?php include"header.php"; // Sayfanın üst kısmında ortak header dosyasını ekliyoruz. ?> 

<div class="right_col" role="main"> <!-- Sağ ana içeriğin bulunduğu ana alan -->

  <div class="page-title">
    <div class="title_left"> <!-- Sol tarafta başlık alanı -->
      <h3>Ürün Ekleme İşlemleri <small> <!-- Ürün ekleme işlemleri başlığı -->

        <?php 
        // Eğer "durum" parametresi "ok" ise işlem başarılı, "no" ise işlem başarısız mesajını gösteriyoruz.
        if ($_GET['durum']=='ok') {?>
          <a style="color:green "> İşlem Başarılı</a> <!-- İşlem başarılı mesajı -->
        <?php } elseif ($_GET['durum']=='no') { ?>
          <a style="color:red "> İşlem Başarısız</a> <!-- İşlem başarısız mesajı -->
        <?php } ?>

      </small></h3>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12"> <!-- Tam genişlikte bir sütun -->
      <div class="x_panel"> <!-- Panel başlangıcı -->

        <ul class="nav navbar-right panel_toolbox"> <!-- Panel araç çubuğu -->
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li> <!-- Paneli küçültme ikonu -->
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              <i class="fa fa-wrench"></i>
            </a> <!-- Araçlar menüsü -->
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a></li> <!-- Paneli kapatma ikonu -->
        </ul>
        <div class="clearfix"></div> <!-- Düzeni sıfırlama -->

        <div class="x_content">
          <!-- Ürün ekleme formu -->
          <form action="../islemler.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

            <div class="form-group"> <!-- Ürün adı alanı -->
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Adı<span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="urun_ad" value="<?php echo $urunyaz['urun_ad'] ?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <div class="form-group"> <!-- Kategori seçimi alanı -->
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Seç<span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-6">

                <?php  
                // Veritabanından kategori bilgilerini çekiyoruz.
                $urun_id=$uruncek['kategori_id']; 
                $kategorisor=$db->prepare("select * from tblkategori ");
                $kategorisor->execute();
                ?>

                <select class="select2_multiple form-control" required="" name="kategori_id">
                  <?php 
                  // Kategorileri döngüyle listeleme
                  while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) { 
                    $kategori_id=$kategoricek['kategori_id'];
                  ?>
                    <option value="<?php echo $kategoricek['kategori_id']; ?>">
                      <?php echo $kategoricek['kategori_adi']; ?>
                    </option>
                  <?php } ?>
                </select>
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
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Detay<span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea class="form-control" id="first-name" name="urun_detay" required="required"><?php echo $urunyaz['urun_detay'] ?></textarea>
              </div>
            </div>

            <div class="ln_solid"></div> <!-- Form içeriği ile buton arasında bir çizgi -->
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 pull-right">
                <!-- Formu gönder butonu -->
                <button type="submit" class="btn btn-success" name="urunekle">EKLE</button>
              </div>
            </div>

          </form> <!-- Form sonu -->
        </div> <!-- x_content sonu -->
      </div> <!-- x_panel sonu -->
    </div>
  </div>
</div>
</div>

<?php include"footer.php"; // Sayfanın alt kısmında ortak footer dosyasını ekliyoruz. ?>
