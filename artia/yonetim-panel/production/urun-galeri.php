<?php 

include 'header.php'; // Sayfanın üst kısmında ortak header dosyasını ekliyoruz.

?>
<!-- Sayfa içeriği başlangıcı -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">

    </div>

    <div class="col-md-12">
      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <!-- Arama alanı için boş bir yer bırakılmış -->
        </div>
      </div>
    </div>

    <div class="clearfix"></div> <!-- Sayfa düzenini sıfırlamak için kullanılır -->

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel"> <!-- Panel başlangıcı -->
            <div class="x_title"> <!-- Panel başlık kısmı -->
             <div align="left" class="col-md-6">
              <h2>Resim Ürün Fotoğraf İşlemleri <small>
                <?php
                // Kayıt sayısını ve işlem durumunu ekrana yazdırıyoruz.
                echo $say." kayıt listelendi.";
                if ($_GET['durum']=='ok') {?> 
                
                <b style="color:green;">İşlem başarılı...</b>

                <?php } elseif ($_GET['durum']=='no')  {?>

                <b style="color:red;">İşlem Başarısız...</b>

                <?php } ?></small></h2><br>
              </div>
              <!-- Form başlangıcı -->
              <form  action="../islemler.php" method="POST" enctype="multipart/form-data">
              <!-- Ürün ID'sini gizli input ile gönderiyoruz -->
              <input type="hidden" name="urun_id" value="<?php echo $_GET['urun_id']; ?>">

                <div align="right" class="col-md-6">
                  <!-- Seçilen fotoğrafları sil butonu -->
                  <button type="submit" name="urunfotosil" class="btn btn-danger ">
                    <i class="fa fa-trash" aria-hidden="true"></i> Seçilenleri Sil
                  </button>
                  <!-- Yeni fotoğraf yükleme butonu -->
                  <a class="btn btn-success" href="urun-foto-yukle.php?urun_id=<?php echo $_GET['urun_id'];?>">
                    <i class="fa fa-plus" aria-hidden="true"></i> Ürün Fotoğraf Yükle
                  </a>
                </div>
                <div class="clearfix"></div>
              </div>

              <div class="x_content"> <!-- Panel içeriği başlangıcı -->

                <?php

                $sayfada = 25; // Her sayfada gösterilecek içerik miktarı.

                // Toplam ürün fotoğraf sayısını hesaplıyoruz.
                $sorgu=$db->prepare("select * from tblurun_resim");
                $sorgu->execute();
                $toplam_urunfoto=$sorgu->rowCount();

                $toplam_sayfa = ceil($toplam_urunfoto / $sayfada); // Toplam sayfa sayısını buluyoruz.

                $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1; // Mevcut sayfa numarasını alıyoruz.

                if($sayfa < 1) $sayfa = 1; // Sayfa numarası 1'den küçükse 1 yapıyoruz.
                if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; // Sayfa numarası toplam sayfadan büyükse son sayfaya yönlendiriyoruz.

                $limit = ($sayfa - 1) * $sayfada; // SQL sorgusunda kullanılacak limit başlangıç değeri.

                // Ürün fotoğraflarını sorguluyoruz.
                $urunfotosor=$db->prepare("select * from tblurun_resim where urun_id=:urun_id order by urunfoto_id DESC limit $limit,$sayfada");
                $urunfotosor->execute(array(
                  'urun_id' => $_GET['urun_id']
                ));

                // Her bir fotoğraf için döngü başlatıyoruz.
                while($urunfotocek=$urunfotosor->fetch(PDO::FETCH_ASSOC)) { ?>

                  <div class="col-md-55"> <!-- Fotoğraf kartı -->
                   <label>
                    <div class="image view view-first">
                      <!-- Fotoğraf görüntüleme -->
                      <img style="width: 150px; height: 100px; display: block;" src="../../images/urun/<?php echo $urunfotocek['urunfoto_resimyol']; ?>" alt="image" />
                      <div class="mask">
                        <p><?php echo $urunfotocek['urunfoto_ad']; ?> <?php echo $urunfotocek['urunfoto_id']; ?></p>
                      </div>
                    </div>
                    <!-- Fotoğraf seçimi için checkbox -->
                    <input type="checkbox" name="urunfotosec[]" value="<?php echo $urunfotocek['urunfoto_id']; ?>"> Seç
                  </label>
                </div>

                <?php } ?>

                <!-- Sayfalama işlemi -->
                <div align="right" class="col-md-12">
                  <ul class="pagination">
                    <?php
                    $s=0;
                    while ($s < $toplam_sayfa) {
                      $s++; ?>
                      <li class="<?php echo $s==$sayfa ? 'active' : ''; ?>">
                        <a href="urunfoto.php?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>
                      </li>
                    <?php } ?>
                  </ul>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<!-- Sayfa içeriği sonu -->

<?php include 'footer.php'; // Sayfanın alt kısmında ortak footer dosyasını ekliyoruz. ?>

