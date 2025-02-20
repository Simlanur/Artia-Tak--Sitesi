<?php include"header.php"; // header.php dosyasını ekleriz, genellikle sayfa başlıkları ve stil dosyaları burada yer alır

// siparis tablosundaki verileri çekmek için sorgumuzu elde ettik
$siparissor=$db->prepare("SELECT * FROM tblsiparis ORDER BY siparis_id DESC "); 
$siparissor->execute(); // sorgumuzu execute yaparak çalıştırdık

?>

<div class="right_col" role="main"> <!-- Sayfanın ana içerik alanı -->
  <div class=""> <!-- Sayfa başlığı için boş bir alan -->
    <div class="page-title">
      <div class="title_left">
        <h3>siparis İşlemleri <small> <!-- Sipariş işlemleri başlığı -->
        </small></h3>
      </div>
    </div>

    <div class="row">
      <div class=" col-xs-12"> <!-- 12 sütun genişliğinde bir alan -->
        <div class="x_panel"> <!-- Sipariş işlemleri paneli -->

          <div class="clearfix"></div> <!-- Panel içindeki her türlü boşluğu temizler -->

          <div class="x_content"> <!-- İçerik kısmı -->

            <!-- Siparişleri listeleyecek bir tablo oluşturuyoruz -->
            <table class="table table-bordered" style="text-align: center;">
              <thead>
                <tr>
                  <!-- Tablo başlıkları -->
                  <th>Sipariş No</th>
                  <th>Tarih</th>
                  <th>Tutar</th>
                  <th>Ödeme Tip</th>
                  <th>Durum</th>
                  <th>Sipariş Detay</th>
                  <td></td> <!-- Boş hücre, başka içerik eklenebilir -->
                </tr>
              </thead>
              <tbody>
                <?php while ($sipariscek=$siparissor->fetch(PDO::FETCH_ASSOC)) {?> <!-- Veritabanındaki her siparişi döngüyle listele -->
                <tr>
                  <td><?php echo $sipariscek['siparis_id']; ?></td> <!-- Sipariş ID'si -->
                  <td><?php echo $sipariscek['siparis_zaman']; ?></td> <!-- Siparişin yapıldığı zaman -->
                  <td><?php echo $sipariscek['siparis_toplam']; ?></td> <!-- Siparişin toplam tutarı -->
                  <td><?php echo $sipariscek['siparis_tip']; ?></td> <!-- Siparişin ödeme tipi -->

                  <td>
                    <?php
                    // Sipariş durumunu kontrol edip uygun renkte mesaj gösteriyoruz
                    if ($sipariscek['siparis_durum']==0) {
                      echo "<b style='color:red'>Ödeme Bekleniyor</b>";
                    }elseif ($sipariscek['siparis_durum']==1) {
                      echo "<b style='color:#228B22'>Ödeme Onaylandı</b>";
                    }elseif ($sipariscek['siparis_durum']==2) {
                      echo "<b style='color:#7FFF00'>Kargoya Verildi</b>";
                    }elseif ($sipariscek['siparis_durum']==3) {
                      echo "<b style='color:blue'>Kargo Teslim Edildi</b>";
                    }elseif ($sipariscek['siparis_durum']==4) {
                      echo "<b style='color:#B22222'>İptal edildi</b>";
                    }
                    ?>
                  </td>

                  <!-- Sipariş detayına gitmek için bağlantı oluşturuyoruz -->
                  <td><center><a href="siparis-detay.php?siparis_id=<?php echo $sipariscek['siparis_id']?>"><button class="btn btn-warning btn-xs">Detay</button></center></a></td>

                  <!-- Sipariş durumunu güncellemek için bağlantı oluşturuyoruz -->
                  <td><center><a href="siparis-duzenle.php?siparis_id=<?php echo $sipariscek['siparis_id']?>"><button class="btn btn-success btn-xs">Sipariş Durum Güncelle</button></center></a></td>
                </tr>

              <?php } // Döngü bitişi ?>
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

<?php include"footer.php" ?> <!-- footer.php dosyasını ekleriz, genellikle sayfa alt bilgileri burada yer alır -->
