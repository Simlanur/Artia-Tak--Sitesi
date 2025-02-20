<?php include"header.php"; // header.php dosyasını dahil ediyoruz, sayfa başlığı ve stil dosyalarını içerir

// tblmenu tablosundan tüm menüleri çekecek SQL sorgusunu hazırlıyoruz
$menusor=$db->prepare("SELECT * FROM tblmenu ");
$menusor->execute(); // Sorguyu çalıştırıyoruz, veritabanından menü verilerini çekiyoruz

?>

<div class="right_col" role="main"> <!-- Sayfanın ana içerik kısmı -->

  <div class=""> <!-- Sayfa başlık kısmı -->
    <div class="page-title">
      <div class="title_left">
        <h3>Menu İşlemleri <small></small></h3> <!-- Sayfa başlığını burada gösteriyoruz -->
      </div>
    </div>

    <div class="row"> <!-- Satır başlangıcı -->
      <div class="col-xs-12"> <!-- 12 sütun genişliğinde bir alan -->
        <div class="x_panel"> <!-- İçerik paneli -->
          <a href="menu-ekle.php" class="btn btn-primary pull-left" role="button">YENİ MENU EKLE</a> <!-- Yeni menü ekleme butonu -->
          
          <ul class="nav navbar-right panel_toolbox"> <!-- Panel aracılığıyla eklenen ayar menüsü -->
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li> <!-- Paneli küçültme butonu -->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a> <!-- Ayarlar menüsü -->
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Settings 1</a></li>
                <li><a href="#">Settings 2</a></li>
              </ul>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li> <!-- Paneli kapatma butonu -->
          </ul>

          <div class="clearfix"></div> <!-- Panelin alt kısmındaki boşlukları temizler -->

          <div class="x_content"> <!-- Panel içeriği -->
            <table class="table table-bordered" style="text-align: center;"> <!-- Menü verilerini tabloya yerleştiriyoruz -->
              <thead> <!-- Tablo başlıkları -->
                <tr>
                  <th>No</th>
                  <th>Menu Adı</th>
                  <th>Menu Url</th>
                  <th>Menu Seo Url</th>
                  <th>Menu Sıra</th>
                  <th>Menu Durum</th>
                  <th>Menu Ust</th>
                  <th>Duzenle</th> <!-- Düzenleme için buton -->
                  <th>Sil</th> <!-- Silme için buton -->
                </tr>
              </thead>
              <tbody>
                <?php 
                // Menüleri ekrana yazdırıyoruz
                while ($menucek=$menusor->fetch(PDO::FETCH_ASSOC)) { ?>
                  <tr> <!-- Her bir menü için bir satır oluşturuyoruz -->
                    <td><?php echo $menucek['menu_id'] ?></td> <!-- Menü ID'sini yazdırıyoruz -->
                    <td><?php echo $menucek['menu_adi'] ?></td> <!-- Menü adını yazdırıyoruz -->
                    <td><?php echo $menucek['menu_url'] ?></td> <!-- Menü URL'sini yazdırıyoruz -->
                    <td><?php echo $menucek['menu_seourl'] ?></td> <!-- Menü SEO URL'sini yazdırıyoruz -->
                    <td><?php echo $menucek['menu_sira'] ?></td> <!-- Menü sırasını yazdırıyoruz -->

                    <!-- Menü durumunu kontrol edip, Aktif/Pasif butonunu gösteriyoruz -->
                    <td><?php if($menucek['menu_durum'] == 1)
                    {?>
                        <button type="button " class="btn btn-success btn-xs">Aktif</button> <!-- Eğer menü durumu aktifse yeşil buton gösteriyoruz -->
                    <?php  }
                    else{ ?>
                        <button type="button " class="btn btn-danger btn-xs">Pasif</button> <!-- Eğer menü durumu pasifse kırmızı buton gösteriyoruz -->
                    <?php }
                    ?></td>
                    <td><?php echo $menucek['menu_ust'] ?></td> <!-- Menü üst bilgisini yazdırıyoruz -->
                    
                    <!-- Düzenleme butonuna link ekliyoruz, menu_id ile menü düzenleme sayfasına yönlendiriyoruz -->
                    <td><center><a href="menu-duzenle.php?menu_id=<?php echo $menucek['menu_id']?>"><button class="btn btn-success btn-xs">DÜZENLE</button></center></a></td>
                    
                    <!-- Silme butonuna link ekliyoruz, menu_id ile menüyü silme işlemini yapıyoruz -->
                    <td><center><a href="../islemler.php?menu_id=<?php echo $menucek['menu_id']; ?>&menusil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
                  </tr>

                <?php } // While döngüsünün sonu ?>
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
