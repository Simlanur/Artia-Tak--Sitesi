<?php include"header.php"; // header.php dosyasını dahil ediyoruz, sayfanın başlık ve stil dosyalarını içerir ?>

<?php
// Kullanıcı verilerini çekmek için SQL sorgusu hazırlıyoruz
$kullanicisor=$db->prepare("SELECT * FROM tbluyeler ");// tbluyeler tablosundaki tüm verileri seçiyoruz
$kullanicisor->execute(); // Sorguyu çalıştırıyoruz
?>

<div class="right_col" role="main"> <!-- Sayfanın ana içeriği -->

  <div class=""> <!-- Sayfa başlık kısmı -->
    <div class="page-title">
      <div class="title_left">
        <h3>Üye İşlemleri <small></small></h3> <!-- Sayfa başlığı "Üye İşlemleri" -->
      </div>
    </div>

    <div class="row"> <!-- Satır başı -->
      <div class=" col-xs-12"> <!-- 12 sütun genişliğinde bir alan -->
        <div class="x_panel"> <!-- Panel başlık ve içeriğini barındırır -->

          <ul class="nav navbar-right panel_toolbox"> <!-- Panel araçları sağ tarafta yer alır -->
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li> <!-- Paneli küçültme butonu -->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a> <!-- Diğer ayarlar butonu -->
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Settings 1</a></li> <!-- Ayar 1 -->
                <li><a href="#">Settings 2</a></li> <!-- Ayar 2 -->
              </ul>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li> <!-- Paneli kapama butonu -->
          </ul>
          
          <div class="clearfix"></div> <!-- Paneldeki boşlukları temizler -->
          
          <div class="x_content"> <!-- Panel içeriği -->

            <table class="table table-bordered" style="text-align: center;"> <!-- Üyeleri listelemek için tablo -->
              <thead>
                <tr>
                  <th>No</th> <!-- Sıra numarası -->
                  <th>Adı Soyadı</th> <!-- Üye adı soyadı -->
                  <th>e Mail</th> <!-- Üye e-maili -->
                  <th>Telefon</th> <!-- Üye telefonu -->
                  <th>Kullanici Adı</th> <!-- Üye kullanıcı adı -->
                  <th>Sifre</th> <!-- Üye şifresi -->
                  <th>Duzenle</th> <!-- Düzenle butonu -->
                  <th>Sil</th> <!-- Sil butonu -->
                </tr>
              </thead>
              <tbody>
                <?php while ($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC)) {?><!-- Veritabanından gelen kullanıcı bilgilerini döngü ile alıyoruz ve ekrana yazdırıyoruz -->

                  <tr>
                    <td><?php echo $kullanicicek['kullanici_id'] ?></td> <!-- Kullanıcı ID'sini gösteriyoruz -->
                    <td><?php echo $kullanicicek['kullanici_adsoyad'] ?></td> <!-- Kullanıcı adı soyadı -->
                    <td><?php echo $kullanicicek['kullanici_mail'] ?></td> <!-- Kullanıcı maili -->
                    <td><?php echo $kullanicicek['kullanici_tel'] ?></td> <!-- Kullanıcı telefonu -->
                    <td><?php echo $kullanicicek['kullanici_adi'] ?></td> <!-- Kullanıcı adı -->
                    <td><?php echo $kullanicicek['kullanici_sifre'] ?></td> <!-- Kullanıcı şifresi -->
                    
                    <!-- Düzenleme butonu: Kullanıcıyı düzenlemek için kullanılır -->
                    <td><center><a href="kullanici-duzenle.php?kullanici_id=<?php echo $kullanicicek['kullanici_id']?>"><button class="btn btn-success btn-xs">DÜZENLE</button></center></a></td>
                    
                    <!-- Silme butonu: Kullanıcıyı silmek için kullanılır -->
                    <td><center><a href="../islemler.php?kullanici_id=<?php echo $kullanicicek['kullanici_id']; ?>&kullanicisil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
                  </tr>

                <?php } ?>

              </tbody>
            </table>

          </div> <!-- x_content kapanışı -->
        </div> <!-- x_panel kapanışı -->
      </div> <!-- col-xs-12 kapanışı -->
    </div> <!-- row kapanışı -->
  </div> <!-- Sayfa içeriği kapanışı -->
</div> <!-- main içerik kapanışı -->

<?php include"footer.php" ?> <!-- footer.php dosyasını dahil ediyoruz, sayfanın alt kısmındaki bilgileri buradan alıyoruz -->
