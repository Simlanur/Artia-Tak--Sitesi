<?php include"header.php"; // Başlık kısmını ve diğer genel dosyaları dahil ediyoruz

// Eğer arama yapılmışsa
if (isset($_POST['arama'])) { 
    // Arama kutusuna girilen değer
    $aranan = $_POST['aranan']; 
    // Veritabanında 'urun_ad' sütununda arama yapıyoruz
    $urunsor = $db->prepare("SELECT * FROM tblurunler WHERE urun_ad LIKE ?"); 
    // Arama sorgusunu çalıştırıyoruz
    $urunsor->execute(array("%$aranan%")); 

    // Arama sonucu kaç adet ürün bulunduğunu alıyoruz
    $say = $urunsor->rowCount();

} else {
    // Eğer arama yapılmamışsa kullanıcıyı ana sayfaya yönlendiriyoruz
    Header("Location:index.php?durum=bos");
}
?>

<section> <!-- Sayfa içeriği başlıyor -->
    <div class="container"> <!-- Konteyner başlıyor -->
        <div class="row"> <!-- Satır başlıyor -->
            
            <div class="col-sm-9 padding-right"> <!-- Ürünlerin listeleneceği alan -->
                <div class="features_items"> <!-- Özellikli ürünler -->
                    <h2 class="title text-center">KİTAPLAR</h2> <!-- Sayfanın başlığı -->

                    <?php 
                    // Eğer arama sonucu hiçbir ürün bulunmazsa mesaj göster
                    if ($say == 0) {
                        echo "Bu kategoride ürün bulunamadı"; 
                    }

                    // Eğer ürünler bulunduysa, döngü ile her ürünü listele
                    while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) { ?>
                        <div class="col-sm-4"> <!-- Ürün kartı -->
                            <div class="product-image-wrapper"> <!-- Ürün resminin bulunduğu alan -->
                                <div class="single-products"> <!-- Ürün detayları -->
                                    <?php 
                                    // Ürün ID'sine göre ürün resmi sorgusu
                                    $urun_id = $uruncek['urun_id']; 
                                    $urunfotosor = $db->prepare("SELECT * FROM tblurun_resim WHERE urun_id=:id LIMIT 1"); 
                                    $urunfotosor->execute(array('id' => $urun_id));
                                    $urunfotocek = $urunfotosor->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    <div class="productinfo text-center"> <!-- Ürün bilginin yer aldığı alan -->
                                        <!-- Ürün fotoğrafı ve bilgileri -->
                                        <img src="images/urun/<?php echo $urunfotocek['urunfoto_resimyol']; ?>" alt="" height="225px" width="175px" />
                                        <h2><?php echo $uruncek['urun_fiyat']; ?>₺</h2> <!-- Ürün fiyatı -->
                                        <p><?php echo $uruncek['urun_ad']; ?></p> <!-- Ürün adı -->
                                    </div>
                                    <div class="product-overlay"> <!-- Ürün üzerine tıklanınca açılan detay alanı -->
                                        <div class="overlay-content"> 
                                            <!-- Ürün fotoğrafı ve bilgileri overlay'de tekrar gösteriliyor -->
                                            <img src="images/urun/<?php echo $urunfotocek['urunfoto_resimyol']; ?>" alt="" height="125px" />
                                            <h2><?php echo $uruncek['urun_fiyat']; ?>₺</h2>
                                            <p><?php echo $uruncek['urun_ad']; ?></p>

                                            <!-- Sepete ekleme formu -->
                                            <form action="yonetim-panel/islemler.php" method="POST">
                                                <input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>">
                                                <input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'] ?>"> 
                                            </form>

                                            <!-- Sepete eklemek için form -->
                                            <form action="yonetim-panel/islemler.php" method="POST">
                                                <input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>">
                                                <input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'] ?>">
                                                
                                                <div class="row">
                                                    <input type="hidden" class="form-control input-sm" value="1" name="urun_adet">
                                                </div>

                                                <!-- Kullanıcı giriş yapmamışsa giriş yapması gerektiğini belirtiyoruz -->
                                                <?php if (!isset($_SESSION['userkullanici_mail'])) { ?>
                                                    Sepete Ürün Eklemek İçin Lütfen <a href="login">GİRİŞ YAPIN</a>
                                                <?php } else { ?>
                                                    <!-- Kullanıcı giriş yaptıysa sepete ekleme butonu -->
                                                    <input type="submit" class="btn btn-default add-to-cart" name="sepeteekle" value="SEPETE EKLE">
                                                <?php } ?>
                                            </form>
                                        </div>
                                    </div>
                                    <img src="images/home/sale.png" class="new" alt="" /> <!-- İndirim etiketi -->
                                </div>
                                <div class="choose"> <!-- Ürün detaylarına yönlendiren bağlantı -->
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="urun-<?= seo($uruncek["urun_ad"]) ?>"><i class="fa fa-plus-square"></i>Detay İçin Tıklayınız</a></li> <!-- Detay sayfasına yönlendiren link -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div><!--features_items-->
            </div>
            <?php include "sidebar.php"; ?> <!-- Yan menü dahil ediliyor -->
        </div>
    </div>
</section>

<?php include"footer.php" ?> <!-- Sayfanın alt kısmını dahil ediyoruz -->
