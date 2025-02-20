<?php include"header.php"; // header.php dosyasını dahil ediyoruz, sayfanın başlık ve stil dosyalarını içerir

// Kategori tablosundaki tüm verileri çekmek için SQL sorgusu hazırlıyoruz
$kategorisor=$db->prepare("SELECT * FROM tblkategori  "); 
$kategorisor->execute(); // SQL sorgusunu çalıştırıyoruz
?>

<div class="right_col" role="main"> <!-- Sayfa içeriği başlıyor -->

  <div class="page-title"> <!-- Sayfa başlığı kısmı -->
    <div class="title_left"> <!-- Başlık sol kısmı -->
      <h3>Kategori Ekleme İşlemleri <small> <!-- Başlık ve alt başlık -->
        
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
              <!-- Kategori ekleme formu -->
              <form action="../islemler.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"> 
              
                <div class="form-group"> <!-- Kategori adı için form grubu -->
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Ad <span class="required">*</span> <!-- Etiket ve zorunlu alan simgesi -->
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12"> <!-- Formun girişi -->
                    <input type="text" id="first-name" name="kategori_adi" required="required" class="form-control col-md-7 col-xs-12"> <!-- Kategori adı için metin girişi -->
                  </div>
                </div>

                <div class="form-group"> <!-- Kategori üst adı için form grubu -->
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Ust Adı<span class="required">*</span> <!-- Etiket ve zorunlu alan simgesi -->
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12"> <!-- Formun girişi -->
                   <select id="heard" class="form-control" name="kategori_ust" required> <!-- Kategori üst seçimi için açılır menü -->

                    <option value="0">ANA KATEGORİ</option> <!-- Ana kategori seçeneği -->
                    <?php while ($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)){?> <!-- Veritabanındaki kategoriler döngü ile çekiliyor -->

                      <option value="<?php echo $kategoricek['kategori_id'] ?>"><?php echo $kategoricek['kategori_adi']; ?></option> <!-- Kategori seçeneği -->

                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="form-group"> <!-- Kategori durumu için form grubu -->
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Durum<span class="required">*</span> <!-- Etiket ve zorunlu alan simgesi -->
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12"> <!-- Formun girişi -->
                 <select id="heard" class="form-control" name="kategori_durum" required> <!-- Kategori durumu seçimi için açılır menü -->

                   <option value="0">Pasif</option> <!-- Pasif seçenek -->
                   <option value="1">Aktif</option> <!-- Aktif seçenek -->

                 </select>
               </div>
             </div>

             <div class="ln_solid"></div> <!-- Bölücü çizgi -->
             <div class="form-group "> <!-- Formu gönderme butonunun grubu -->
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 pull-right"> <!-- Butonun konumu -->

                <button type="submit" class="btn btn-primary" name="kategoriekle">Kategori Ekle</button> <!-- Kategori ekleme butonu -->
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
