<?php 
include"baglan.php" ; // Veritabanı bağlantısını sağlayan dosya
include"fonksiyon.php"; // Ekstra fonksiyonları içeren dosya
error_reporting(E_ALL ^ E_NOTICE); // Hata raporlama seviyesini belirler, NOTICE hataları göstermez
ini_set('error_reporting', E_ALL ^ E_NOTICE); // PHP hata raporlama ayarlarını günceller
ob_start(); // Çıktı tamponlamayı başlatır
session_start(); // Oturum başlatır, kullanıcı oturumu için gerekli

$kullanicisor=$db->prepare("SELECT * FROM tbluyeler where kullanici_mail=:mail"); // Kullanıcı maili ile kullanıcı bilgilerini alır
$kullanicisor->execute(array(
  'mail' => $_SESSION['userkullanici_mail'] // Oturum açmış kullanıcının mail adresi
));
$say=$kullanicisor->rowCount(); // Sorgudan dönen satır sayısını alır

$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC); // Kullanıcı verilerini dizi olarak alır

$ayaradi=$db->prepare("SELECT * FROM tblayar where ayar_id=:id"); // Site ayarlarını çekmek için sorgu
$ayaradi->execute(array(
  'id' => 0 // Ayar id'si 0 olan veriyi çeker
));

$ayaryaz=$ayaradi->fetch(PDO::FETCH_ASSOC); // Site ayarlarını dizi olarak alır
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<title><?php echo $ayaryaz['ayar_title']; ?></title> <!-- Sayfanın başlığını ayar tablosundan alır -->
	<link rel="shortcut icon" href="images/title.png" /> <!-- Favicon ekler -->
	<link href="css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap stil dosyası -->
	<link href="css/font-awesome.min.css" rel="stylesheet"> <!-- Font awesome ikonları -->
	<link href="css/prettyPhoto.css" rel="stylesheet"> <!-- Pretty photo stil dosyası -->
	<link href="css/price-range.css" rel="stylesheet"> <!-- Fiyat aralığı stil dosyası -->
	<link href="css/animate.css" rel="stylesheet"> <!-- Animasyon stil dosyası -->
	<link href="css/main.css" rel="stylesheet"> <!-- Ana stil dosyası -->
	<link href="css/responsive.css" rel="stylesheet"> <!-- Responsive stil dosyası -->
	<link href="css/style.css" rel="stylesheet"> <!-- Ekstra stil dosyası -->
	<link rel="stylesheet" href="css/dikey.css"> <!-- Dikey stil dosyası -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> <!-- Bootstrap CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> <!-- Font Awesome -->
	
    <!--[if lt IE 9]> <!-- IE 9'dan düşük sürümler için HTML5 ve responsive uyumlu destek -->
    <script src="js/html5shiv.js"></script> <!-- HTML5 özellikleri için gerekli polyfill -->
    <script src="js/respond.min.js"></script> <!-- IE için responsive özellikleri -->
	<![endif]-->       

<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png"> <!-- Apple cihazları için simge -->
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png"> <!-- Apple cihazları için simge -->
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png"> <!-- Apple cihazları için simge -->
<link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png"> <!-- Apple cihazları için simge -->
</head><!--/head-->
<body>
	<header id="header" ><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<?php // Eğer oturum açmamışsa, giriş yap ve kayıt ol butonlarını göster
							if (!isset($_SESSION['userkullanici_mail'])){?>
								<ul class="nav nav-pills" style="margin-top: 5px;">
									<a href="login" class="btn btn-default btn-xs " role="button"><i class="fa fa-lock"></i>Giriş Yap</a> <!-- Giriş yap -->
									<a href="kayitol" class="btn btn-default btn-xs" role="button"><i class="fa fa-user"></i>Kayıt Ol</a> <!-- Kayıt ol -->
								</ul>
							<?php /*dolu ise*/ } else { ?>
								<ul class="nav nav-pills" style="margin-top: 2px;">
									<li><a href="#" style="font-weight:600"></i></a></li>
									<a href="hesap.php?kullanici_id=<?php echo $kullanicicek['kullanici_id']?>" class="btn btn-default btn-sm " role="button">Hoşgeldiniz ' <?php echo $kullanicicek["kullanici_adsoyad"]; ?></a> <!-- Kullanıcı adı ile hoşgeldiniz -->
								</ul>
							<?php }
							?>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li> <!-- Facebook linki -->
								<li><a href="#"><i class="fa fa-twitter"></i></a></li> <!-- Twitter linki -->
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li> <!-- LinkedIn linki -->
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li> <!-- Dribbble linki -->
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li> <!-- Google Plus linki -->
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->

		<div class="header-middle"><!--header-middle-->
			<div class="container" style="background-color: white">
				<div class="row">
					<div class="col-sm-2">
						<div class="logo pull-left">
							<a href="index"><img width="100" height="75" src="images/<?php echo $ayaryaz['ayar_logo']; ?>" style="margin-top: 2px; margin-left: 10px;"></a> <!-- Logo -->
						</div>

					</div>
					<div class="col-sm-6">
						<div id="custom-search-input ">
							<form action="arama" method="POST">
							<div class="input-group col-sm-12" style="margin-top: 17px">
								<input type="text" name="arama" class=" search-query form-control" placeholder="Ürün Ara" /> <!-- Ürün arama alanı -->
								<span class="input-group-btn">
									<a href="arama"><button class="btn btn-danger" type="button">
										<span class=" glyphicon glyphicon-search"></span> <!-- Arama butonu -->
									</button></a>
								</span>
							</div>
						</div>
					</form>
					</div>
					<div class="col-sm-4">
						<div class="shop-menu pull-right">
						<?php // Eğer oturum açmamışsa, menüdeki kullanıcı seçeneklerini gösterme
						if (!isset($_SESSION['userkullanici_mail'])){?>
							<ul class="nav navbar-nav" style="margin-top: 15px;">
							</ul>
						<?php } else { ?>
						<?php } ?>
						<?php /* Kullanıcı giriş yapmış ise yetkili alanları göster */
						if (isset($_SESSION['userkullanici_mail'])) {?>
							<ul class="nav navbar-nav" style="margin-top: 15px;">
								<li><a href="hesap.php?kullanici_id=<?php echo $kullanicicek['kullanici_id']?>"><i class="fa fa-user"></i> Hesabım</a></li> <!-- Kullanıcı hesabı -->
								<li><a href="siparislerim"><i class="fa fa-shopping-cart"></i> Siparişlerim</a></li> <!-- Siparişlerim -->
								<li><a href="logout"><i class="fa fa-shopping-cart"></i> Çıkış Yap</a></li> <!-- Çıkış yap -->
							</ul>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div><!--/header-middle-->
	<div class="header-bottom"><!--header-bottom Başlangıcı-->
	<div class="container"> <!-- Konteyner başlatılıyor -->
		<div class="row"> <!-- Satır başlatılıyor -->
			<div class="col-sm-12"> <!-- Tüm genişlik için sütun -->
				<nav class="navbar navbar-default"> <!-- Navbar başlatılıyor -->
					<div class="container-fluid"> <!-- Fluid konteyner, genişliğe göre ayarlanır -->
						<ul class="nav navbar-nav"> <!-- Menü elemanlarını barındıracak liste -->
							<li><a href="index">Anasayfa</a></li> <!-- Anasayfa bağlantısı -->
							<?php 
								// Menü verilerini veritabanından çekmek için sorgu
								$menusor=$db->prepare("SELECT * FROM tblmenu where menu_durum=:durum order by menu_sira ASC limit 5 ");
								$menusor->execute(array(
									'durum' => 1 // Durum değeri 1 olan menüler seçiliyor
								));
								// Veritabanından çekilen menüleri döngüyle listeye ekliyoruz
								while ($menucek=$menusor->fetch(PDO::FETCH_ASSOC)){
							?>	
								<li><a href="<?php echo $menucek['menu_url'] ?>"><?php echo $menucek['menu_adi'] ?></a></li> <!-- Menü elemanlarını dinamik olarak yazdırıyoruz -->
							<?php } ?>	
						</ul>
						<a class="btn btn-info navbar-btn pull-right" href="sepet"> <!-- Sepet butonuna tıklanabilir bağlantı -->
							<i class="fa fa-shopping-cart"></i> Sepetim <!-- Sepet simgesi ve metni -->
							<?php 
								// Kullanıcı ID'sini alıyoruz
								$kullanici_id=$kullanicicek['kullanici_id'];
								// Sepetteki ürünleri kontrol etmek için sorgu
								$sepetsor=$db->prepare("SELECT * FROM tblsepet where kullanici_id=:id");
								$sepetsor->execute(array(
									'id' => $kullanici_id // Kullanıcıya ait sepeti sorguluyoruz
								));
								// Sepet sayısını alıyoruz
								$say=$sepetsor->rowCount();
						    ?>
							<span class="badge badge-light"><?php echo ("$say") ?></span> <!-- Sepet içindeki ürün sayısını gösteren etiket -->
						</a>
					</div>
				</nav> <!-- Navbar bitiyor -->
			</div>
		</div>
	</div>
</div><!--/header-bottom Sonu-->
</header><!--/header Sonu-->
