<?php include"header.php"; // Header dosyasını dahil et (sayfanın üst kısmındaki genel yapı ve stil dosyalarını ekler)

$slidersor=$db->prepare("SELECT * FROM tblslider "); // Veritabanından slider tablosundaki tüm verileri seçmek için hazırlanan sorgu
$slidersor->execute(); // Sorguyu çalıştırarak veritabanından sonuçları getir

?>

<div class="right_col" role="main"> <!-- Sayfa içeriği bölümünü başlat -->
  <div class=""> <!-- Boş bir div, sayfa başlığını ve başlık düzenini barındırır -->
    <div class="page-title"> <!-- Sayfa başlığı div'i -->
      <div class="title_left"> <!-- Sayfa başlığının sol kısmı -->
        <h3>Slider İşlemleri <small></small></h3> <!-- Sayfa başlığı -->
      </div>
    </div>

    <div class="row"> <!-- Sayfa içeriğinde bulunan öğeleri satırlara yerleştiren bir yapı -->
     <div class=" col-xs-12"> <!-- 12 kolonlu genişlikte bir içerik -->
      <div class="x_panel"> <!-- Panel içeriği, altındaki tablonun bulunduğu panel -->
        <a href="slider-ekle" class="btn btn-primary pull-left" role="button">YENİ SLİDER EKLE</a> <!-- Yeni slider ekleme sayfasına yönlendiren buton -->

        
        <div class="clearfix"></div> <!-- Sayfa içeriğindeki elemanları hizalamak için boşluk bırakır -->

        <div class="x_content" "> <!-- İçeriği barındıran bölüm -->

          <table class="table table-bordered" style="text-align: center;" > <!-- Tablonun görünümünü ve hizalanmasını ayarlayan yapı -->
            <thead > <!-- Tablo başlığı kısmı -->
              <tr> <!-- Tablo başlık satırı -->

                <th>Slider Adı</th> <!-- Slider'ın adını gösteren başlık -->
                <th>Slider Resim</th> <!-- Slider'ın resmini gösteren başlık -->
                <th>Sil</th> <!-- Slider'ı silmek için buton başlığı -->
              </tr>
            </thead>
            <tbody> <!-- Tablo verilerini barındıran bölüm -->
              <?php while ($slidercek=$slidersor->fetch(PDO::FETCH_ASSOC)) {?><!-- Veritabanındaki her bir slider kaydını döngü ile alıyoruz -->

              <tr> <!-- Tablo satırı -->
                <td><?php echo $slidercek['slider_ad'] ?></td> <!-- Slider adını tabloya yazdır -->
                <td><img src=" ../../images/Slider<?php echo $slidercek['slider_resimyol'] ?>" width="100" height="100"></td> <!-- Slider resmini tabloya ekler, yolunu veritabanından alır -->

                <td><center><a href="../islemler.php?slider_id=<?php echo $slidercek['slider_id']; ?>&slidersil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td> <!-- Slider silme işlemi için buton. Silme işlemi, ilgili slider_id ile işlemler sayfasına yönlendirilir -->
              </tr>

            <?php } 

            ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>

<?php include"footer.php" ?>  <!-- Footer dosyasını dahil et (sayfanın alt kısmındaki genel yapı ve stil dosyalarını ekler) -->
