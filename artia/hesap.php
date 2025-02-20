<?php include"header.php"; ?> <!-- Header dosyasını dahil eder, sayfanın üst kısmını oluşturur. -->
<?php 
// Veritabanından kullanıcı bilgilerini çekmek için sorgu hazırlanır.
$kullanicisor=$db->prepare("SELECT * FROM tbluyeler where kullanici_id=:id"); 
// Kullanıcı ID'sine göre sorgu çalıştırılır.
$kullanicisor->execute(array(
    'id' => $_GET['kullanici_id']
)); 
// Sorgudan dönen sonuçlar bir dizi olarak alınır.
$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC); 
?>
<section> <!-- Ana içerik bölümü başlar. -->
    <div class="container"> <!-- İçeriği merkezlemek için bir konteyner kullanılır. -->
        <div class="panel panel-default"> <!-- Panel oluşturulur. -->
            <div class="panel-header"><CENTER><h1>HESABIM</h1></CENTER></div> <!-- Panel başlığı. -->
            <div class="panel-body"> <!-- Panel içeriği başlar. -->
                <div class="row"> <!-- Satır oluşturulur. -->
                    <!-- Kullanıcı resmi güncelleme formu başlar. -->
                    <form action="yonetim-panel/islemler.php" method="POST" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left"> 
                        <div class="form-group"> <!-- Yüklü resmin görüntülendiği grup. -->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yüklü Resim<br><span class="required"></span></label> 
                            <div class="col-md-6 col-sm-6 col-xs-12"> 
                                <?php  
                                // Eğer kullanıcı resmi varsa gösterilir, yoksa varsayılan resim gösterilir.
                                if (strlen($kullanicicek['kullanici_img'])>0) {?> 
                                    <img width="200" height="200" src="images/User/<?php echo $kullanicicek['kullanici_img']; ?>"> 
                                <?php } else {?> 
                                    <img width="200" height="200" src="images/noimage.jpg"> 
                                <?php } ?>
                            </div> 
                        </div> 
                        <div class="form-group"> <!-- Yeni resim seçme ve yükleme alanı. -->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Resim Seç<span class="required"></span></label> 
                            <div class="col-md-6 col-sm-6 col-xs-12"> 
                                <input type="file" id="first-name"  name="kullanici_img"  class="form-control col-md-7 col-xs-12"> 
                                <button type="submit" name="resimduzenle" class="btn btn-primary">Resim Güncelle</button> <!-- Resmi güncelleme butonu. -->
                            </div> 
                        </div> 
                        <input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'];?>"> <!-- Kullanıcı ID'si gizli bir input olarak gönderilir. -->
                    </form> 
                    <!-- Kullanıcı bilgilerini güncelleme formu başlar. -->
                    <form action="yonetim-panel/islemler.php" method="POST" data-parsley-validate class="form-horizontal form-label-left"> 
                        <div class="form-group"> <!-- Ad soyad güncelleme alanı. -->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ad Soyad<span class="required"></span></label> 
                            <div class="col-md-6 col-sm-6 col-xs-12"> 
                                <input type="text" id="first-name"  name="kullanici_adsoyad"  class="form-control col-md-7 col-xs-12" value="<?php echo $kullanicicek['kullanici_adsoyad'] ?>"> 
                            </div> 
                        </div> 
                        <div class="form-group"> <!-- E-posta güncelleme alanı. -->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">E MAİL<span class="required"></span></label> 
                            <div class="col-md-6 col-sm-6 col-xs-12"> 
                                <input type="mail" id="first-name"  name="kullanici_mail"  class="form-control col-md-7 col-xs-12" value="<?php echo $kullanicicek['kullanici_mail'] ?>"> 
                            </div> 
                        </div> 
                        <div class="form-group"> <!-- Adres güncelleme alanı. -->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Adres<span class="required">*</span></label> 
                            <div class="col-md-6 col-sm-6 col-xs-12"> 
                                <textarea id="first-name"  name="kullanici_adres"  class="form-control col-md-7 col-xs-12"><?php echo $kullanicicek['kullanici_adres'] ?></textarea> 
                            </div> 
                        </div>
                        <input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'];?>"> <!-- Kullanıcı ID'si gizli bir input olarak gönderilir. -->
                        <div align="left" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"> <!-- Güncelleme ve şifre değiştirme butonları. -->
                            <button type="submit" name="hesapduzenle" class="btn btn-primary">Güncelle</button> 
                            <a href="sifre-guncelle.php?kullanici_id=<?php echo $kullanicicek['kullanici_id']?>" type="submit" name="hesapduzenle" class="btn btn-primary">Şifre Güncelle</a> 
                        </div> 
                    </form> 
                </div> 
            </div> 
            <div class="container-fluid bg-1 text-center"> <!-- Ek görsel bir alan oluşturulur. -->
            </div> 
        </div> 
    </div> 
</section> <!-- Ana içerik bölümü sona erer. -->
<?php include"footer.php"; ?> <!-- Footer dosyasını dahil eder, sayfanın alt kısmını oluşturur. -->