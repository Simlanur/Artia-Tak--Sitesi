<?php include'header.php'; // Header dosyasını sayfaya dahil eder. ?>

<?php 
// Hakkımızda bilgilerini veritabanından çekmek için sorgu hazırlanıyor.
$hakkimizdasor=$db->prepare("SELECT * FROM hakkimizda where hakkimizda_id=:id"); // "hakkimizda" tablosundan belirli bir id'ye sahip veriyi seçer.
$hakkimizdasor->execute(array(
  'id' => 0 // ID değeri 0 olan veriyi çekmek için sorguya parametre olarak gönderilir.
));

// Veritabanından dönen veriyi bir diziye alır.
$hakkimizdacek=$hakkimizdasor->fetch(PDO::FETCH_ASSOC); // Veriyi fetch methodu ile döndürür ve PDO::FETCH_ASSOC ile sadece sütun adlarıyla bir dizi oluşturur.
?>

<div id="contact-page" class="container"> <!-- Sayfa ana yapısını kapsayan div. -->
    <div class="bg"> <!-- Sayfaya arka plan stili uygulamak için kullanılan div. -->
        <div class="row"> <!-- Bootstrap grid sistemine göre bir satır oluşturur. -->
            <div class="col-sm-12"> <!-- Satırın tamamını kaplayan sütun. -->
                <h2 class="title text-center">
                    <strong><?php echo $hakkimizdacek['hakkimizda_baslik']; ?></strong> <!-- Veritabanından çekilen başlığı ekrana yazdırır. -->
                </h2>
                <div id="gmap" class="contact-map"> <!-- İletişim haritasını veya içerik bölümünü kapsayan div. -->
                    <div class="col-sm-6"> <!-- Sayfanın sol yarısını kaplayan sütun. -->
                        <h1><?php echo $hakkimizdacek['hakkimizda_baslik']; ?></h1> <!-- Veritabanından gelen başlığı yazdırır. -->
                        <?php echo $hakkimizdacek['hakkimizda_icerik']; ?> <!-- Hakkımızda içeriğini veritabanından çekip ekrana yazdırır. -->
                    </div>
                    <div class="col-sm-6"> <!-- Sayfanın sağ yarısını kaplayan sütun. -->
                        <iframe width="550" height="315" 
                            src="https://www.youtube.com/embed/<?php echo $hakkimizdacek['hakkimizda_video']; ?>"> 
                        </iframe> <!-- Veritabanından gelen video kodunu kullanarak bir YouTube videosu embed eder. -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--/#contact-page--> <!-- İletişim sayfasını kapatan yorum. -->

<?php include'footer.php'; // Footer dosyasını sayfaya dahil eder. ?>
