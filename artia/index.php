<?php include"header.php"; // Header dosyasını dahil eder, genel üst yapı burada başlar
$urunsor=$db->prepare("SELECT * FROM tblurunler ORDER BY urun_id DESC LIMIT 0,3  "); // Ürünleri veritabanından alacak sorgu
$urunsor->execute(); // Sorguyu çalıştırır ve sonuçları alır
?>

<div class="container"> <!-- Ana içerik alanını başlatır -->
	<div class="row"> <!-- Satır oluşturur -->
		<div class="col-sm-12"> <!-- Tam genişlikte bir sütun oluşturur -->
			
			<!-- Slider için CSS kodları head etiketine eklenecek -->
<style>
    .slider-container { /* Slider'ın genel konteyner stilini ayarlar */
        position: relative; 
        max-width: 100%; 
        margin: auto; 
        overflow: hidden; 
        height: 400px; /* Slider yüksekliği */
    }
    
    .slides { /* Slider içeriğini taşır ve geçiş animasyonunu ayarlar */
        display: flex; 
        transition: transform 0.4s ease-in-out; 
        height: 100%;
    }
    
    .slide { /* Her bir slider öğesinin stilini ayarlar */
        min-width: 100%; 
        box-sizing: border-box; 
    }
    
    .slide img { /* Slider resimlerinin stilini ayarlar */
        width: 100%; 
        height: 400px; /* Resim yüksekliği */
        object-fit: cover; /* Resmi kutuya sığdırır */
    }
    
    .slider-nav { /* Slider navigasyon butonlarının stilini ayarlar */
        position: absolute; 
        top: 50%; 
        transform: translateY(-50%); 
        width: 100%; 
        display: flex; 
        justify-content: space-between; 
        padding: 0 20px; 
        box-sizing: border-box; 
        z-index: 2; 
    }
    
    .nav-button { /* Navigasyon butonlarının stilini ayarlar */
        background: rgba(0, 0, 0, 0.5); 
        color: white; 
        padding: 10px 15px; 
        border: none; 
        cursor: pointer; 
        border-radius: 4px; 
        transition: background 0.3s; 
    }
    
    .nav-button:hover { /* Buton hover efektini ayarlar */
        background: rgba(0, 0, 0, 0.8); 
    }
</style>

<!-- Slider HTML yapısı -->
<div class="slider-container"> <!-- Slider konteyneri -->
    <div class="slides"> <!-- Slider içerik alanı -->
        <?php  
        $slidersor=$db->prepare("SELECT * FROM tblslider ORDER BY slider_id DESC"); // Slider resimlerini veritabanından çeker
        $slidersor->execute(); // Veritabanından slider verilerini alır
        while ($slidercek=$slidersor->fetch(PDO::FETCH_ASSOC)) { // Verileri döngüyle getirir
        ?>
            <div class="slide"> <!-- Her bir slide için div -->
                <img src="images/Slider/<?php echo $slidercek['slider_resimyol'] ?>" alt="Slider Görsel"> <!-- Slider görselini ekler -->
            </div>
        <?php } ?>
    </div>
    
    <div class="slider-nav"> <!-- Navigasyon butonlarını içerir -->
        <button class="nav-button" onclick="previousSlide()">❮</button> <!-- Önceki slide butonu -->
        <button class="nav-button" onclick="nextSlide()">❯</button> <!-- Sonraki slide butonu -->
    </div>
</div>

<!-- Slider için JavaScript kodları body sonuna eklenecek -->
<script>
    let currentSlide = 0; // Başlangıçtaki slide indexi
    const slides = document.querySelector('.slides'); // Slider içerik alanı
    const totalSlides = document.querySelectorAll('.slide').length; // Toplam slide sayısını alır
    
    function updateSlidePosition() { // Slide geçişini günceller
        slides.style.transform = `translateX(-${currentSlide * 100}%)`;
    }
    
    function nextSlide() { // Sonraki slide'ı gösterir
        currentSlide = (currentSlide + 1) % totalSlides; // Bir sonraki slide'a geçer
        updateSlidePosition();
    }
    
    function previousSlide() { // Önceki slide'ı gösterir
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides; // Bir önceki slide'a geçer
        updateSlidePosition();
    }
    
    // 5 saniyede bir otomatik geçiş
    setInterval(nextSlide, 5000);
</script>

                      </div>
                    </div>
                  </div>

                  <section>
                   <div class="container">
                    <div class="row">
                     <div class="col-sm-3" style="margin-top:10px "> <!-- Sol menü alanı başlatılır -->

                      <?php include"sidebar.php" ?> <!-- Sidebar dosyasını dahil eder -->
                      <div class="col-sm-3" style="margin-top: 15px; margin-bottom: 15px;"> <!-- Reklam alanı -->

                       <img src="images/reklam.jpg"> <!-- Reklam görseli eklenir -->

                     </div>
                   </div>
                 </div>

                 <div class="col-sm-9 padding-right"> <!-- Sağ alan başlatılır -->
                   <div class="features_items"><!--features_items-->
                    <h2 class="title text-center" style="margin-top:10px ">Yeni Çıkan Ürünler</h2> <!-- Başlık ekler -->

                    <?php 
                    while ($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) { // Ürünleri döngüyle getirir
                    ?>
                      <?php 
                      $urun_id=$uruncek['urun_id']; // Ürün ID'sini alır
                      $urunfotosor=$db->prepare("SELECT* FROM tblurun_resim where urun_id=:id LIMIT 1"); // Ürün fotoğrafını alır
                      $urunfotosor->execute(array(
                        'id'=>$urun_id
                      ));
                      $urunfotocek=$urunfotosor->fetch(PDO::FETCH_ASSOC); // Fotoğraf verisini çeker
                      ?>

                      <div class="col-sm-4"> <!-- Ürün için sütun başlatır -->
                       <div class="product-image-wrapper"> <!-- Ürün görsel alanı -->
                        <div class="single-products"> <!-- Her bir ürün için alan -->
                         <div class="productinfo text-center"> <!-- Ürün bilgilerini gösterir -->
                          <img src="images/urun/<?php echo $urunfotocek['urunfoto_resimyol']; ?>" alt="" height="225px" width="175px" /> <!-- Ürün görseli ekler -->
                          <h1><?php echo $uruncek['urun_fiyat']; ?>₺</h1> <!-- Ürün fiyatını gösterir -->
                          <p><?php echo $uruncek['urun_ad']; ?></p> <!-- Ürün adını gösterir -->
                        </div>
                        <div class="product-overlay"> <!-- Ürün üzerine gelindiğinde gösterilen ek bilgi -->
                          <div class="overlay-content">
                           <img src="images/urun/<?php echo $urunfotocek['urunfoto_resimyol']; ?>" alt="" height="125px" /> <!-- Ürün küçük fotoğrafı -->
                           <h4 style="color:white"><?php echo $uruncek['urun_fiyat']; ?>₺</h4> <!-- Fiyat bilgisi -->
                           <p><?php echo $uruncek['urun_ad']; ?></p> <!-- Ürün adı -->
                           <form action="yonetim-panel/islemler.php" method="POST"> <!-- Ürün ekleme formu -->
                            <input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>"> <!-- Kullanıcı ID'si -->
                            <input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'] ?>"> <!-- Ürün ID'si -->
                          </form>

                          <form action="yonetim-panel/islemler.php" method="POST">
                            <input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>"> <!-- Kullanıcı ID'si -->
                            <input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'] ?>"> <!-- Ürün ID'si -->
                            <div class="row">
                             <input type="hidden" class="form-control input-sm" value="1" name="urun_adet"> <!-- Ürün miktarını gizler -->
                           </div>
                           <?php if (!isset($_SESSION['userkullanici_mail'])) {?> <!-- Kullanıcı giriş yapmamışsa uyarı gösterir -->
                             Sepete Ürün Eklemek İçin Lütfen <a href="login">GİRİŞ YAPIN</a> 
                           <?php } else{?> <!-- Giriş yapmışsa ürün sepete eklenebilir -->
                             <input type="submit" class="btn btn-default add-to-cart" name="sepeteekle" value="SEPETE EKLE"> <!-- Sepete ekle butonu -->
                           <?php }
                           ?>
                         </form>

                       </div>
                     </div>
                     <img src="images/home/sale.png" class="new" alt="" /> <!-- İndirim etiketi -->
                   </div>
                   <div class="choose"> <!-- Ürün detayına gitmek için bağlantı -->
                     <ul class="nav nav-pills nav-justified">
                      <li><a href="urun-<?=seo($uruncek["urun_ad"]) ?>"><i class="fa fa-plus-square"></i>Detay İçin Tıklayınız</a></li>
                    </ul>
                  </div>
                </div>
              </div>

            <?php }?>

          </div>

          <h2 class="title text-center" style="margin-top:10px; color: red">ÖNE ÇIKAN ÜRÜNLER</h2>

          <div class="container">
           <div class="row">
            <div class="col-sm-9" >
             <?php 
             $urunsor=$db->prepare("SELECT * FROM tblurunler where urun_onecikar=:urun_onecikar"); // Öne çıkan ürünleri alır
             $urunsor->execute(array(
              'urun_onecikar' => 1
            ));

            while ($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) { // Öne çıkan ürünler döngüsü
            ?>
              <div class="col-sm-4"> <!-- Ürün sütunu başlatır -->
               <div class="product-image-wrapper"> <!-- Ürün görseli -->
                <div class="single-products"> <!-- Ürün alanı -->
                 <div class="productinfo text-center"> <!-- Ürün bilgisi -->
                  <?php 

                  $urun_id=$uruncek['urun_id'];
                  $urunfotosor=$db->prepare("SELECT* FROM tblurun_resim where urun_id=:id LIMIT 1");
                  $urunfotosor->execute(array(

                    'id'=>$urun_id

                  ));
                  $urunfotocek=$urunfotosor->fetch(PDO::FETCH_ASSOC);
                  ?>
                  <img src="images/urun/<?php echo $urunfotocek['urunfoto_resimyol']; ?>" alt="" height="225px" width="175px" />
                  <h1><?php echo $uruncek['urun_fiyat']; ?>₺</h1>
                  <p><?php echo $uruncek['urun_ad']; ?></p>

                </div>
                <div class="product-overlay">
                  <div class="overlay-content">
                   <img src="images/urun/<?php echo $urunfotocek['urunfoto_resimyol']; ?>" alt="" height="125px" />
                   <h4 style="color:white"><?php echo $uruncek['urun_fiyat']; ?>₺</h4>
                   <p><?php echo $uruncek['urun_ad']; ?></p>

                <!--  form işlemleri   -->

                   <form action="yonetim-panel/islemler.php" method="POST">
                    <input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>">
                    <input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'] ?>">
                  </form>

                  <form action="yonetim-panel/islemler.php" method="POST">
                    <input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>">
                    <input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'] ?>">
                    <div class="row">
                     <input type="hidden" class="form-control input-sm" value="1" name="urun_adet">
                   </div>
                   <?php if (!isset($_SESSION['userkullanici_mail'])) {?> 
                     Sepete Ürün Eklemek İçin Lütfen <a href="login">GİRİŞ YAPIN</a> 
                   <?php } else{?>
                     <input type="submit" class="btn btn-default add-to-cart" name="sepeteekle" value="SEPETE EKLE">
                   <?php } ?>
                 </form>

               </div>
             </div>
             <img src="images/home/sale.png" class="new" alt="" />
           </div>
           <div class="choose">
             <ul class="nav nav-pills nav-justified">
              <li><a href="urun-<?=seo($uruncek["urun_ad"]) ?>"><i class="fa fa-plus-square"></i>Detay İçin Tıklayınız</a></li>
            </ul>
          </div>
        </div>
      </div>

    <?php } ?>

  </div>
</div>
</div>
</div>
</div>

<div class="container">
 <div class=""></div>
</div>

</div><!--features_items-->

</div>

<?php include"footer.php" ?> <!-- Footer dosyasını dahil eder, sayfanın alt kısmı burada tamamlanır -->
