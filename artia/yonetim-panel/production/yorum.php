<?php include "header.php"; // Header dosyasını dahil ediyoruz.

/* Yorumları çekmek için sorguyu hazırlıyoruz. Yorumları "yorum_onay" sırasına göre artan şekilde sıralıyoruz. */
$yorumsor = $db->prepare("SELECT * FROM tblyorum ORDER BY yorum_onay ASC");
$yorumsor->execute(array()); // Sorgumuzu çalıştırıyoruz.

?>

<div class="right_col" role="main"> <!-- Ana içeriği kapsayan sağ kolon başlangıcı -->
  <div class="">
    <div class="page-title"> <!-- Sayfa başlık kısmı -->
      <div class="title_left">
        <h3>Yorum İşlemleri <small></small></h3> <!-- Yorum işlemleri başlığı -->
      </div>
    </div>

    <div class="row"> <!-- İçerik satırı -->
     <div class="col-xs-12"> <!-- Tüm sütunu kapsayan kolon -->
      <div class="x_panel"> <!-- Panel başlangıcı -->

       <ul class="nav navbar-right panel_toolbox"> <!-- Panel araç kutusu -->
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> <!-- Paneli daraltma simgesi -->
        </li>
        <li class="dropdown"> <!-- Ayar menüsü -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Settings 1</a></li> <!-- Ayar seçeneği 1 -->
            <li><a href="#">Settings 2</a></li> <!-- Ayar seçeneği 2 -->
          </ul>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a> <!-- Paneli kapatma simgesi -->
        </li>
      </ul>
      <div class="clearfix"></div> <!-- Temizlik sınıfı, düzen için kullanılır. -->

      <div class="x_content"> <!-- Panel içeriği başlangıcı -->

        <table class="table table-bordered" style="text-align: center;"> <!-- Tablo başlangıcı -->
          <thead>
            <tr>
              <th>S.No</th> <!-- Sıra numarası sütunu -->
              <th>Yorum</th> <!-- Yorum sütunu -->
              <th>Kullanıcı</th> <!-- Kullanıcı sütunu -->
              <th>Ürün</th> <!-- Ürün sütunu -->
              <th>Durum</th> <!-- Durum sütunu -->
              <th></th> <!-- İşlem sütunu -->
            </tr>
          </thead>
          <tbody>

          <?php 
          $say = 0; // Sıra numarası için başlangıç değeri

          /* Yorum tablosundaki verileri tek tek çekiyoruz ve listeye ekliyoruz. */
          while ($yorumcek = $yorumsor->fetch(PDO::FETCH_ASSOC)) { 
            $say++; // Her satırda sıra numarasını bir artırıyoruz.
          ?>

          <tr>
            <td width="20"><?php echo $say; ?></td> <!-- Sıra numarasını yazdırıyoruz. -->
            <td><?php echo $yorumcek['yorum_detay']; ?></td> <!-- Yorum detayını yazdırıyoruz. -->
            <td>
              <?php 
              $kullanici_id = $yorumcek['kullanici_id']; // Yorumun kullanıcısının ID'sini alıyoruz.

              /* Kullanıcı bilgilerini çekiyoruz. */
              $kullanicisor = $db->prepare("SELECT * FROM tbluyeler WHERE kullanici_id = :id");
              $kullanicisor->execute(array('id' => $kullanici_id));
              $kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);

              echo $kullanicicek['kullanici_adsoyad']; // Kullanıcının adını ve soyadını yazdırıyoruz.
              ?>
            </td>
            <td>
              <?php 
              $urun_id = $yorumcek['urun_id']; // Yorumun ait olduğu ürünün ID'sini alıyoruz.

              /* Ürün bilgilerini çekiyoruz. */
              $urunsor = $db->prepare("SELECT * FROM tblurunler WHERE urun_id = :id");
              $urunsor->execute(array('id' => $urun_id));
              $uruncek = $urunsor->fetch(PDO::FETCH_ASSOC);

              echo $uruncek['urun_ad']; // Ürünün adını yazdırıyoruz.
              ?>
            </td>
            <td>
              <center>
                <?php 
                if ($yorumcek['yorum_onay'] == 0) { // Eğer yorum onaylanmamışsa
                ?>
                  <a href="../islemler.php?yorum_id=<?php echo $yorumcek['yorum_id']; ?>&yorum_one=1&yorum_onay=ok">
                    <button class="btn btn-success btn-xs">Onayla</button> <!-- Onayla butonu -->
                  </a>
                <?php 
                } elseif ($yorumcek['yorum_onay'] == 1) { // Eğer yorum onaylanmışsa
                ?>
                  <a href="../islemler.php?yorum_id=<?php echo $yorumcek['yorum_id']; ?>&yorum_one=0&yorum_onay=ok">
                    <button class="btn btn-warning btn-xs">Kaldır</button> <!-- Onayı kaldır butonu -->
                  </a>
                <?php 
                } 
                ?>
              </center>
            </td>
            <td>
              <center>
                <a href="../islemler.php?yorum_id=<?php echo $yorumcek['yorum_id']; ?>&yorumsil=ok">
                  <button class="btn btn-danger btn-xs">Sil</button> <!-- Sil butonu -->
                </a>
              </center>
            </td>
          </tr>

          <?php 
          } // while döngüsü sonu
          ?>

          </tbody>
        </table> <!-- Tablo sonu -->

      </div> <!-- Panel içeriği sonu -->
    </div> <!-- Panel sonu -->
  </div> <!-- Sütun sonu -->
</div> <!-- Satır sonu -->
</div> <!-- İçerik bölümü sonu -->
</div> <!-- Sağ kolon sonu -->

<?php include "footer.php"; // Footer dosyasını dahil ediyoruz. ?>
