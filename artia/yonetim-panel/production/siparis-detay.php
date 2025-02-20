<?php include"header.php"; // header.php dosyasını dahil ediyoruz, genellikle sayfa başlıkları ve stil dosyaları içerir

// siparis_id'ye göre sipariş detaylarını çekmek için sorgu oluşturuyoruz
$siparissor=$db->prepare("SELECT * FROM tblsiparis_detay where siparis_id=:id ");
$siparissor->execute(array(
  'id'=>$_GET['siparis_id'] // URL'den gelen siparis_id parametresine göre veritabanı sorgusunu çalıştırıyoruz
));

// Kullanıcı bilgilerini çekmek için sorgu oluşturuyoruz
$kullanicisor=$db->prepare("SELECT * FROM tbluyeler where kullanici_mail=:mail");
$kullanicisor->execute(array(
  'mail' => $_SESSION['userkullanici_mail'] // Oturum açan kullanıcının mail adresi ile sorguyu çalıştırıyoruz
));
$say=$kullanicisor->rowCount(); // Dönen satır sayısını alıyoruz (kullanıcı var mı diye kontrol etmek için)

$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC); // Kullanıcı bilgilerini diziyi fetch ile alıyoruz
?>

<div class="right_col" role="main"> <!-- Sayfanın ana içerik kısmı -->

  <div class=""> <!-- Sayfa başlığı kısmı -->
    <div class="page-title">
      <div class="title_left">
        <h3>siparis İşlemleri <small></small></h3> <!-- Sayfa başlığını ve küçük açıklamayı burada gösteriyoruz -->
      </div>
    </div>

    <div class="row"> <!-- Satır başlangıcı -->
      <div class="col-xs-12"> <!-- 12 sütun genişliğinde bir alan -->
        <div class="x_panel"> <!-- İçerik paneli -->

          <div class="clearfix"></div> <!-- Boşlukları temizler -->

          <div class="x_content"> <!-- Panel içeriği -->

            <table class="table table-bordered" style="text-align: center;"> <!-- Sipariş verilerini tablodan göstereceğiz -->
              <thead>
                <tr>
                  <!-- Tablo başlıkları -->
                  <th>Sipariş No</th>
                  <th>Urun Adı</th>
                  <th>Tutar</th>
                  <th>Adet</th>
                  <th>Adres</th>
                  <th>Sipariş Veren Ad Soyad</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // siparis detaylarını alıp ekrana yazdırıyoruz
                while ($sipariscek=$siparissor->fetch(PDO::FETCH_ASSOC)) {
                  // her bir siparişin ürün bilgilerini almak için ek bir sorgu çalıştırıyoruz
                  $dsiparissor=$db->prepare("SELECT * FROM tblurunler where urun_id =".$sipariscek['urun_id']);
                  $dsiparissor->execute(); // Ürün sorgusunu çalıştırıyoruz
                  $dsipariscek=$dsiparissor->fetch(PDO::FETCH_ASSOC); // Ürün bilgilerini çekiyoruz
                  ?>

                  <!-- Satırları oluşturuyoruz -->
                  <tr>
                    <td><?php echo $sipariscek['siparis_id']; ?></td> <!-- Sipariş ID'sini ekrana yazdırıyoruz -->
                    <td><?php echo $dsipariscek['urun_ad']; ?></td> <!-- Ürün adı -->
                    <td><?php echo $sipariscek['urun_fiyat']; ?></td> <!-- Ürün fiyatı -->
                    <td><?php echo $sipariscek['urun_adet']; ?></td> <!-- Ürün adeti -->
                    <td><?php echo $kullanicicek['kullanici_adres']; ?></td> <!-- Kullanıcı adresi -->
                    <td><?php echo $kullanicicek['kullanici_adsoyad']; ?></td> <!-- Kullanıcı adı ve soyadı -->
                  </tr>

                <?php } // while döngüsünün sonu ?>
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php include"footer.php" ?> <!-- footer.php dosyasını dahil ediyoruz, sayfanın alt kısmındaki bilgileri buradan alıyoruz -->
