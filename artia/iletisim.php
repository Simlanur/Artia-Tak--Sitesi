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
            <div class="col-sm-8"> <!-- Sayfanın sol kısmını kaplayan sütun. -->
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d12055.443505444273!2d29.156508600000002!3d40.9407162!3m2!1i1024!2i768!4f13.1!5e0!3m2!1str!2str!4v1527286505964" 
                    width="700" height="450" frameborder="0" style="border:0" allowfullscreen>
                </iframe> <!-- Google Haritalar iframe ile entegre edilir. -->
            </div>
            <div class="col-sm-4"> <!-- Sayfanın sağ kısmını kaplayan sütun. -->
                <div class="contact-info"> <!-- İletişim bilgilerini kapsayan div. -->
                    <h2 class="title text-center">İletişim Bilgileri</h2> <!-- İletişim bilgileri başlığı. -->
                    <address> <!-- İletişim adres bilgilerini içeren HTML etiketi. -->
                        <p>Artia.</p> <!-- Şirket adı. -->
                        <p>TURKİYE TR</p> <!-- Ülke adı. -->
                        <p>Mobile: +0555 555 55 55</p> <!-- Telefon numarası. -->
                        <p>Fax: +0555 555 55 55</p> <!-- Faks numarası. -->
                        <p>Email: info@artia.com</p> <!-- E-posta adresi. -->
                    </address>
                    <div class="social-networks"> <!-- Sosyal ağ bağlantılarını kapsayan div. -->
                        <h2 class="title text-center">Sosyal Ağlar</h2> <!-- Sosyal ağlar başlığı. -->
                        <ul> <!-- Sosyal medya bağlantılarını listeleyen HTML etiketi. -->
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a> <!-- Facebook bağlantısı. -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a> <!-- Twitter bağlantısı. -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-google-plus"></i></a> <!-- Google Plus bağlantısı. -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-youtube"></i></a> <!-- YouTube bağlantısı. -->
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>  
    </div>	
</div><!--/#contact-page--> <!-- İletişim sayfasını kapatan yorum. -->

<?php include'footer.php'; // Footer dosyasını sayfaya dahil eder. ?>
