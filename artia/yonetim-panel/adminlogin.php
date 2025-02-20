<?php include"../baglan.php"; ?> <!-- Veritabanı bağlantısını dahil eder. -->
<?php 
ob_start(); // Çıkış tamponlamayı başlatır, yönlendirmelerde hata alınmaması için.
session_start(); // Oturum yönetmek için oturumu başlatır.

if (isset($_POST['admingiris'])) { // Eğer "admingiris" formu gönderildiyse.
	$kullanici_adi=$_POST['kullanici_adi']; // Kullanıcı adını formdan alır.
	$kullanici_password=md5($_POST['kullanici_password']); // Şifreyi alır ve MD5 ile şifreler.
	
	// Kullanıcıyı veritabanında aramak için sorgu hazırlanır.
	$kullanicisor=$db->prepare("select * from tbluyeler where kullanici_adi=:kadi and kullanici_password=:kullanici_password and kullanici_yetki=:yetki");
	$kullanicisor->execute(array(
		'kadi' => $kullanici_adi, // Kullanıcı adını bağlar.
		'yetki'=> 1, // Yetkisi 1 olan (admin) kullanıcıları kontrol eder.
		'kullanici_password' => $kullanici_password, // Şifreyi bağlar.
	));
	
	// Kaç satır döndüğünü kontrol eder (aranan kullanıcı var mı?).
	$say=$kullanicisor->rowCount(); 
	
	if ($say==1) { // Eğer sonuç 1 satırsa (kullanıcı bulunduysa).
		echo $_SESSION['adminkullanici_adi']=$kullanici_adi; // Kullanıcı adını oturum değişkenine atar.
		header("Location:production/index.php?durum=basariligiris"); // Başarılı girişte yönlendirme yapar.
		exit; // Kodun devamını engeller.
	}
	else { // Kullanıcı bulunamazsa.
		header("Location:adminlogin.php?durum=basarisizgiris"); // Başarısız girişte yönlendirme yapar.
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> <!-- XHTML standartlarını belirler. -->
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- HTML belgesinin kök elemanını tanımlar. -->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <!-- Karakter setini UTF-8 olarak ayarlar. -->
	<title>Yönetim Paneli LOGİN</title> <!-- Sayfa başlığını belirler. -->
	<link href="style.css" rel="stylesheet" type="text/css" /> <!-- Harici CSS dosyasını bağlar. -->
</head>
<body>
	<form action="adminlogin.php" method="POST"> <!-- Formun gönderileceği adres ve metot belirtilir. -->
		<div id="site"> <!-- Sayfanın genel yapısını kapsayan div. -->
			<div id="sitebosluk"></div> <!-- Üstte boşluk bırakmak için kullanılan div. -->
			<div id="ortainput"> <!-- Giriş alanlarını kapsayan div. -->
				<div id="kullaniciadi"> <!-- Kullanıcı adı için alan. -->
					<label>Kullanıcı Adı</label> <!-- Kullanıcı adı etiketi. -->
					<div id="kullaniciadiinput"><input name="kullanici_adi" size="20px" type="text" /></div> <!-- Kullanıcı adı giriş kutusu. -->
				</div>

				<div id="sifre"> <!-- Şifre için alan. -->
					<label>Şifre</label> <!-- Şifre etiketi. -->
					<div id="sifreinput"><input type="password" name="kullanici_password" size="20px" /></div> <!-- Şifre giriş kutusu. -->
				</div>
				<div id="alt"> <!-- Alt kısımda hata mesajı ve buton alanını kapsayan div. -->
					<?php  
					// Eğer URL'deki "durum" parametresi "basarisizgiris" ise hata mesajı gösterir.
					if (@$_GET['durum']=="basarisizgiris") { ?>
						<div id="hata"><img src="img/hata.png" alt="" /> <a>Hata :</a> lütfen kullanıcı adı ve şifrenizi kontol edin</div> <!-- Hata mesajı ve resmi. -->
					<?php } else { ?>
						<div id="hata"></div> <!-- Boş hata mesajı alanı. -->
					<?php } ?>
					
					<div id="girisyap"><input type="submit" name="admingiris" /></div> <!-- Giriş yap butonu. -->
				</div>
			</div>
		</div>
	</form>
</body>
</html>

