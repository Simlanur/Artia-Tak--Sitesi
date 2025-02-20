<?php include"header.php" ?> <!-- header.php dosyasını dahil ediyoruz, sayfanın başlık ve stil dosyalarını içerir -->

<div class="right_col" role="main"> <!-- Sayfa içeriği başlıyor -->
  <div class=""> 
    <div class="page-title"> <!-- Sayfa başlığı kısmı -->
      <div class="title_left"> <!-- Başlık sol kısmı -->
        <h3>Admin Panel <small>Hoşgeldiniz</small></h3> <!-- Sayfa başlığı ve alt başlık -->
      </div>

    </div>

    <div class="clearfix"></div> <!-- Temizleme, sayfanın düzgün görünmesini sağlar -->

    <div class="row"> <!-- Yeni satır başlatılıyor -->
      <div class="col-md-12 col-sm-12 col-xs-12"> <!-- 12 kolon genişliğinde bir sütun başlatılıyor -->
        <div class="x_panel"> <!-- Panel başlatılıyor -->
          <div class="x_title"> <!-- Panel başlığı -->
            <h2>Kullanıcılar<small>Kullanıcı sayısı</small></h2> <!-- Başlık ve küçük alt başlık -->
            <ul class="nav navbar-right panel_toolbox"> <!-- Panel araçları -->
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> <!-- Paneli küçültme butonu -->
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a> <!-- Diğer seçenekler için menü -->
                <ul class="dropdown-menu" role="menu"> <!-- Menü öğeleri -->
                  <li><a href="#">Settings 1</a> <!-- Menü öğesi -->
                  </li>
                  <li><a href="#">Settings 2</a> <!-- Menü öğesi -->
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a> <!-- Paneli kapama butonu -->
              </li>
            </ul>
            <div class="clearfix"></div> <!-- Temizleme, panel öğelerinin düzgün hizalanması için -->
          </div>
          <div class="x_content"> <!-- İçerik kısmı başlıyor -->
           <div class="row tile_count"> <!-- Satırdaki her bir tile (kutucuk) için gruplama -->
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"> <!-- Kullanıcı sayısı kutusu -->
              <span class="count_top"><i class="fa fa-user"></i> Kayıtlı Kullanıcı Sayısı</span> <!-- Kayıtlı kullanıcı sayısını belirten etiket -->
              <?php
              // Veritabanından kayıtlı kullanıcı sayısını alıyoruz
              $kullanicisor=$db->prepare("SELECT * FROM tbluyeler");
              $kullanicisor->execute(); // Sorguyu çalıştırıyoruz
              $kullanicisay=$kullanicisor->rowCount(); // Satır sayısını alıyoruz (toplam kullanıcı sayısı)
              ?>
              <div class="count"><?php echo ("$kullanicisay"); ?></div> <!-- Kullanıcı sayısını ekrana yazdırıyoruz -->
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"> <!-- Sipariş sayısı kutusu -->
              <span class="count_top"><i class="fa fa-clock-o"></i> Toplam Sipariş</span> <!-- Toplam sipariş sayısını belirten etiket -->
              <?php
              // Veritabanından toplam sipariş sayısını alıyoruz
              $siparissor=$db->prepare("SELECT * FROM tblsiparis");
              $siparissor->execute(); // Sorguyu çalıştırıyoruz
              $siparissay=$siparissor->rowCount(); // Satır sayısını alıyoruz (toplam sipariş sayısı)
              ?>
              <div class="count"><?php echo ("$siparissay"); ?></div> <!-- Sipariş sayısını ekrana yazdırıyoruz -->
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"> <!-- Onay bekleyen siparişler kutusu -->
              <span class="count_top"><i class="fa fa-user"></i> Onay Bekleyen Siparişler</span> <!-- Onay bekleyen sipariş sayısını belirten etiket -->
              <?php
              // Veritabanından onay bekleyen siparişleri alıyoruz (sipariş durumu 0 ise)
              $siparissor=$db->prepare("SELECT * FROM tblsiparis where siparis_durum=:durum");
              $siparissor->execute(array(
                'durum'=>0 // Durumu 0 olan (onay bekleyen) siparişler
              ));
              $onaysay=$siparissor->rowCount(); // Satır sayısını alıyoruz (onay bekleyen sipariş sayısı)
              ?>
              <div class="count green"><?php echo ("$onaysay"); ?></div> <!-- Onay bekleyen sipariş sayısını ekrana yazdırıyoruz ve yeşil renkte gösteriyoruz -->
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"> <!-- Yorum sayısı kutusu -->
              <span class="count_top"><i class="fa fa-user"></i> Toplam Yorum Sayısı</span> <!-- Yorum sayısını belirten etiket -->
              <?php
              // Veritabanından toplam yorum sayısını alıyoruz
              $yorumsor=$db->prepare("SELECT * FROM tblyorum");
              $yorumsor->execute(); // Sorguyu çalıştırıyoruz
              $yorumsay=$yorumsor->rowCount(); // Satır sayısını alıyoruz (toplam yorum sayısı)
              ?>
              <div class="count"><?php echo ("$yorumsay"); ?></div> <!-- Yorum sayısını ekrana yazdırıyoruz -->
            </div>
          </div> <!-- tile_count sonu -->

        </div>
      </div>

    </div> <!-- X panel sonu -->
  </div>
</div>
</div>
</div> <!-- Sayfa içeriği bitişi -->

<?php include"footer.php" ?> <!-- footer.php dosyasını dahil ediyoruz -->
