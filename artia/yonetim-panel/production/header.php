<?php 
include"../../baglan.php";
error_reporting(E_ALL ^ E_NOTICE);
ini_set('error_reporting', E_ALL ^ E_NOTICE);
ob_start();
session_start();

$kullanicisor=$db->prepare("SELECT * FROM tbluyeler where kullanici_adi=:adi");
$kullanicisor->execute(array(
  'adi' => $_SESSION['adminkullanici_adi']
));
$say=$kullanicisor->rowCount();
$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);



if ($say==0) {

  header("Location:../adminlogin.php?durum=izinsiz");
  exit;
}





?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Admin Panel </title>

  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- bootstrap-progressbar -->
  <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
  <!-- JQVMap -->
  <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
  <!-- bootstrap-daterangepicker -->
  <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">

   <!-- Dropzone.js -->

  <link href="../vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">



  <!-- Dropzone.js -->

  <script src="../vendors/dropzone/dist/min/dropzone.min.js"></script>
  <!-- Ck Editör -->
  <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.php" class="site_title"><i class="fa fa-star"></i> <span>Yönetim Paneli</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="images/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Hoşgeldin,</span>
              <h2><?php echo $kullanicicek['kullanici_adsoyad']; ?></h2>
            </div>
          </div>
          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>GENEL MENULER</h3>


              <ul class="nav side-menu">
                <li><a href="index.php"><i class="fa fa-home"></i>Anasayfa</a></li>

                <li><a href="siparis.php"><i class="fa fa-archive"></i>Siparis İşlemler</a></li>

                <li><a href="kullanici.php"><i class="fa fa-user"></i>Üye İşlemler</a></li>

                  <li><a href="slider.php"><i class="fa fa-image"></i>Slider İşlemleri</a></li>

                <li><a href="menu.php"><i class="fa fa-bookmark"></i>Menu İşlemler</a></li>

                <li><a href="kategori.php"><i class="fa fa-list"></i>Kategori İşlemler</a></li>

                <li><a href="banka.php"><i class="fa fa-university"></i>Banka İşlemler</a></li>

                <li><a href="urunler.php"><i class="fa fa-shopping-cart"></i>Ürün İşlemler</a></li>

                <li><a href="site-ayar-duzenle.php"><i class="fa fa-cog"></i>Site Ayarlar</a></li>

                <li><a href="yorum.php"><i class="fa fa-comment-o"></i>Yorum Ayarlar</a></li>

                <li><a href="hakkimizda-ayar.php"><i class="fa fa-info"></i>Hakkımızda Ayarlar</a></li>


              </ul>
            </div>
          </div>
          <!-- /sidebar menu -->

          
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <nav>
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                 <?php echo $kullanicicek['kullanici_adsoyad'];//Kullanici Adını Çeker ?>
                 <span class=" fa fa-angle-down"></span>
               </a>
               <ul class="dropdown-menu dropdown-usermenu pull-right">
                <li><a href="javascript:;"> Profile</a></li>    
                <li><a href="../logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
    </div><?php 
include"../../baglan.php"; // Veritabanı bağlantısını dahil ediyoruz
error_reporting(E_ALL ^ E_NOTICE); // Hata raporlama düzeyini belirliyoruz, NOTICE seviyesindeki hatalar hariç
ini_set('error_reporting', E_ALL ^ E_NOTICE); // PHP'nin hata raporlama ayarını yapıyoruz
ob_start(); // Çıktı tamponlamayı başlatıyoruz
session_start(); // Oturum başlatıyoruz

// Kullanıcı adıyla ilgili veriyi veritabanından çekiyoruz
$kullanicisor=$db->prepare("SELECT * FROM tbluyeler where kullanici_adi=:adi");
$kullanicisor->execute(array(
  'adi' => $_SESSION['adminkullanici_adi'] // Giriş yapan adminin kullanıcı adını alıyoruz
));
$say=$kullanicisor->rowCount(); // Gelen satır sayısını alıyoruz
$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC); // Kullanıcı bilgilerini çekiyoruz


if ($say==0) { // Eğer kullanıcı veritabanında yoksa
  header("Location:../adminlogin.php?durum=izinsiz"); // Giriş sayfasına yönlendiriyoruz
  exit; // Çalışmayı sonlandırıyoruz
}

?>

<!DOCTYPE html> <!-- HTML belgesinin başlangıcını belirtiyoruz -->
<html lang="en"> <!-- Sayfa dilini İngilizce olarak belirliyoruz -->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> <!-- Sayfa karakter setini UTF-8 olarak ayarlıyoruz -->
  <meta charset="utf-8"> <!-- Sayfanın karakter setini belirtir -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Internet Explorer uyumluluğu için -->
  <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Mobil uyumlu tasarım için -->
  <title>Admin Panel </title> <!-- Sayfa başlığı -->

  <!-- Bootstrap CSS -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap stil dosyasını dahil ediyoruz -->
  <!-- Font Awesome CSS -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet"> <!-- Font Awesome ikonları için stil dosyasını dahil ediyoruz -->
  <!-- NProgress CSS -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet"> <!-- NProgress yüklenme çubuğu için stil dosyasını dahil ediyoruz -->
  <!-- iCheck CSS -->
  <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet"> <!-- iCheck stil dosyasını dahil ediyoruz -->
  <!-- Bootstrap Progressbar CSS -->
  <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet"> <!-- İlerleme çubuğu için stil dosyası -->
  <!-- JQVMap CSS -->
  <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/> <!-- JQVMap harita stili -->
  <!-- Bootstrap Datepicker CSS -->
  <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet"> <!-- Tarih seçici stil dosyası -->

  <!-- Kendi özel stil dosyamız -->
  <link href="../build/css/custom.min.css" rel="stylesheet"> <!-- Sayfaya özel stiller -->

  <!-- Dropzone.js -->
  <link href="../vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet"> <!-- Dropzone için stil dosyası -->
  
  <!-- Dropzone.js -->
  <script src="../vendors/dropzone/dist/min/dropzone.min.js"></script> <!-- Dropzone.js kütüphanesini dahil ediyoruz -->
  <!-- CKEditor -->
  <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script> <!-- CKEditor metin düzenleyici kütüphanesini dahil ediyoruz -->
</head>

<body class="nav-md"> <!-- Sayfa gövdesi sınıfı belirleniyor -->
  <div class="container body"> <!-- Ana konteyner başlatılıyor -->
    <div class="main_container"> <!-- Ana konteyneri oluşturuyoruz -->
      <div class="col-md-3 left_col"> <!-- Sol menü için genişlik ayarı -->
        <div class="left_col scroll-view"> <!-- Sol menü içeriği -->
          <div class="navbar nav_title" style="border: 0;"> <!-- Menü başlığı -->
            <a href="index.php" class="site_title"><i class="fa fa-star"></i> <span>Yönetim Paneli</span></a> <!-- Ana sayfaya yönlendiren başlık -->
          </div>

          <div class="clearfix"></div> <!-- Temizleme, menü öğelerinin düzgün hizalanması için -->

          <!-- Kullanıcı bilgisi -->
          <div class="profile clearfix"> <!-- Profil kısmı başlatılıyor -->
            <div class="profile_pic"> <!-- Profil resmi -->
              <img src="images/img.jpg" alt="..." class="img-circle profile_img"> <!-- Kullanıcı profil resmi -->
            </div>
            <div class="profile_info"> <!-- Profil bilgisi -->
              <span>Hoşgeldin,</span> <!-- Hoşgeldin metni -->
              <h2><?php echo $kullanicicek['kullanici_adsoyad']; ?></h2> <!-- Giriş yapan kullanıcının adı soyadı -->
            </div>
          </div>
          <br />

          <!-- Menü -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu"> <!-- Sidebar menüsü -->
            <div class="menu_section"> <!-- Menü bölüm başlığı -->
              <h3>GENEL MENULER</h3> <!-- Menü başlığı -->

              <ul class="nav side-menu"> <!-- Menü öğeleri -->
                <li><a href="index.php"><i class="fa fa-home"></i>Anasayfa</a></li> <!-- Anasayfa menüsü -->
                <li><a href="siparis.php"><i class="fa fa-archive"></i>Siparis İşlemler</a></li> <!-- Sipariş işlemleri menüsü -->
                <li><a href="kullanici.php"><i class="fa fa-user"></i>Üye İşlemler</a></li> <!-- Üye işlemleri menüsü -->
                <li><a href="slider.php"><i class="fa fa-image"></i>Slider İşlemleri</a></li> <!-- Slider işlemleri menüsü -->
                <li><a href="menu.php"><i class="fa fa-bookmark"></i>Menu İşlemler</a></li> <!-- Menü işlemleri menüsü -->
                <li><a href="kategori.php"><i class="fa fa-list"></i>Kategori İşlemler</a></li> <!-- Kategori işlemleri menüsü -->
                <li><a href="banka.php"><i class="fa fa-university"></i>Banka İşlemler</a></li> <!-- Banka işlemleri menüsü -->
                <li><a href="urunler.php"><i class="fa fa-shopping-cart"></i>Ürün İşlemler</a></li> <!-- Ürün işlemleri menüsü -->
                <li><a href="site-ayar-duzenle.php"><i class="fa fa-cog"></i>Site Ayarlar</a></li> <!-- Site ayarları menüsü -->
                <li><a href="yorum.php"><i class="fa fa-comment-o"></i>Yorum Ayarlar</a></li> <!-- Yorum ayarları menüsü -->
                <li><a href="hakkimizda-ayar.php"><i class="fa fa-info"></i>Hakkımızda Ayarlar</a></li> <!-- Hakkımızda ayarları menüsü -->
              </ul>
            </div>
          </div>
          <!-- /sidebar menu -->

          
        </div>
      </div>

     