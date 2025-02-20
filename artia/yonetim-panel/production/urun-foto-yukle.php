<?php 

include 'header.php'; // Sayfanın üst kısmında ortak header dosyasını ekliyoruz.

?>

<!-- Sayfa içeriği -->
<div class="right_col" role="main"> <!-- Sağ ana içeriğin bulunduğu alan -->
  <div class="">
    <div class="page-title"> <!-- Sayfa başlık alanı -->
      <!-- Başlık için boş bir yer bırakılmış -->
    </div>

    <div class="col-md-12">
      <div class="title_right"> <!-- Sağ üst kısımda bir başlık veya arama kutusu alanı -->
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <!-- Sağ üst köşede arama kutusu için boş bir alan -->
        </div>
      </div>
    </div>

    <div class="clearfix"></div> <!-- Sayfa düzenini sıfırlamak için kullanılır -->

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12"> <!-- İçerik alanı -->
        <div class="col-md-12 col-sm-12 col-xs-12"> <!-- Tüm genişlikte içerik -->
          <div class="x_panel"> <!-- Panel başlangıcı -->
            <div class="x_title"> <!-- Panel başlık kısmı -->

              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12"> <!-- İçerik alanı -->
                  <div class="x_panel"> <!-- Panel başlangıcı -->
                    <div class="x_title"> <!-- Panel başlık kısmı -->
                      <h2>Çoklu resim yükleme işlemleri</h2> <!-- Başlık yazısı -->

                      <div align="right" class="col-md-9"> <!-- Sağ tarafa hizalanmış buton -->
                        <!-- Yüklenen resimleri gör butonu -->
                        <a class="btn btn-success" href="urun-galeri.php?urun_id=<?php echo $_GET['urun_id'];?>">
                          <i class="fa fa-plus" aria-hidden="true"></i> Yüklenen Resimleri Gör
                        </a>
                      </div>

                      <div class="clearfix"></div> <!-- Düzeni sıfırlama -->
                    </div>
                    <div class="x_content"> <!-- Panel içeriği -->
                      <p>Yüklenecek resimlerin bulunduğu klasöre giderek tamamını tek seferde seçerek yükleyebilirsiniz.</p> <!-- Bilgilendirme metni -->

                      <!-- Dropzone.js kullanılarak çoklu dosya yükleme formu -->
                      <form action="../urungaleri.php" class="dropzone"> 
                        <!-- Ürün ID'sini gizli input ile formdan gönderiyoruz -->
                        <input type="hidden" name="urun_id" value="<?php echo $_GET['urun_id'];  ?>">
                      </form>

                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
</div>
</div>
<!-- Sayfa içeriği sonu -->

<?php include 'footer.php'; // Sayfanın alt kısmında ortak footer dosyasını ekliyoruz. ?>
