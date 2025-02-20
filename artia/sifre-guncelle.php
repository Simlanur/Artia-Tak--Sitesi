<?php include"header.php" ;// Header dosyasını dahil eder
$kullanicisor=$db->prepare("SELECT * FROM tbluyeler where kullanici_id=:id");// Kullanıcı bilgilerini veritabanından çeker
$kullanicisor->execute(array(// Sorguyu çalıştırır
	'id' => $_GET['kullanici_id']));// URL'den gelen kullanıcı ID'sini alır
$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);// Kullanıcı bilgilerini dizi olarak alır
if (isset($_POST['kullanicisifreguncelle'])) {// Şifre güncelleme formu gönderildiyse
	 $kullanici_eskipassword=$_POST['kullanici_eskipassword']; // Eski şifreyi formdan alır
	 $kullanici_passwordone=$_POST['kullanici_passwordone']; // Yeni şifreyi formdan alır
	 $kullanici_passwordtwo=$_POST['kullanici_passwordtwo']; // Yeni şifre tekrarını formdan alır
	$kullanici_password=md5($kullanici_eskipassword);// Eski şifreyi md5 ile şifreler
	$kullanicisor=$db->prepare("select * from tbluyeler where kullanici_password=:password");// Eski şifreyi kontrol etmek için sorgu
	$kullanicisor->execute(array(// Sorguyu çalıştırır
		'password' => $kullanici_password
		));
			//dönen satır sayısını belirtir
	$say=$kullanicisor->rowCount();// Eşleşen şifre sayısını kontrol eder
	if ($say==0) { // Eski şifre yanlışsa
		header("Location:sifre-guncelle?durum=eskisifrehata");// Hata sayfasına yönlendirir
	} else {// Eski şifre doğruysa
		if ($kullanici_passwordone==$kullanici_passwordtwo) {// Hata sayfasına yönlendirir
			if (strlen($kullanici_passwordone)>=6) {// Şifre uzunluğu 6 karakterden fazlaysa
				//md5 fonksiyonu şifreyi md5 şifreli hale getirir. 
				$password=md5($kullanici_passwordone);
				$kullanicikaydet=$db->prepare("UPDATE tbluyeler SET
					kullanici_password=:kullanici_password
					WHERE kullanici_id={$_POST['kullanici_id']}");	 // Şifre güncelleme sorgusu			
				$insert=$kullanicikaydet->execute(array( // Sorguyu çalıştırır
					'kullanici_password' => $password
					));
				if ($insert) {// Güncelleme başarılıysa
					header("Location:sifre-guncelle.php?durum=kullanici_id=kullanici_id=$kullanici_id&durum=ok");// Başarılı sayfasına yönlendirir
				
				} else {// Güncelleme başarısızsa
					header("Location:sifre-guncelle.php?durum=kullanici_id=kullanici_id=$kullanici_id&durum=no");// Hata sayfasına yönlendirir
				}
		// Bitiş
			} else { // Şifre 6 karakterden kısaysa
				header("Location:sifre-guncelle.php?durum=eksiksifre");// Hata sayfasına yönlendirir
			}
		} else {// Yeni şifreler eşleşmiyorsa
			header("Location:sifre-guncelle?durum=sifreleruyusmuyor");// Hata sayfasına yönlendirir
			exit;
		}
	}
	exit;
	if ($update) { // Güncelleme başarılıysa
		header("Location:sifre-guncelle?durum=kullanici_id=kullanici_id=$kullanici_id&durum=ok");//Başarılı sayfasına yönlendirir
	} else { // Güncelleme başarısızsa
		header("Location:sifre-guncelle?durum=kullanici_id=kullanici_id=$kullanici_id&durum=no");// Hata sayfasına yönlendirir
	}
}
?>
<section> //Ana bölüm başlangıcı
	<div class="container">// Ana kapsayıcı
		<div class="panel panel-default">// Panel başlangıcı
			<div class="panel-header"><CENTER><h1>ŞİFRE GÜNCELLE</h1></CENTER></div>// Panel başlığı
			<div class="panel-body">// Panel içeriği
				<div class="row">// Satır başlangıcı
					<form action="sifre-guncelle.php" method="POST" class="form-horizontal checkout" role="form"> // Şifre güncelleme formu
		<div class="row">// İç satır başlangıcı
			<div class="col-md-6"> // Sol kolon
				<div class="title-bg">// Başlık arka planı
					<div class="title">Şifre Güncelle</div> // Başlık metni
				</div>
				<div class="form-group dob">// Form grubu - Eski şifre
					<div class="col-sm-12">
						
						<input type="password" class="form-control"  required="" name="kullanici_eskipassword" placeholder="Eski Şifrenizi Giriniz">// Eski şifre input alanı
					</div>
				</div>
				<div class="form-group dob"> // Form grubu - Yeni şifre
					<div class="col-sm-6">
						<input type="password" class="form-control" name="kullanici_passwordone"    placeholder="Yeni Şifrenizi Giriniz">// Yeni şifre input alanı
					</div>
					<div class="col-sm-6">
						<input type="password" class="form-control" name="kullanici_passwordtwo"   placeholder="Yeni Şifrenizi Tekrar Giriniz">// Yeni şifre tekrar input alanı
					</div>
				</div>
				<input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>"> // Gizli kullanıcı ID alanı
				<button type="submit" name="kullanicisifreguncelle" class="btn btn-default btn-red">Şifre Değiştir</button>// Güncelleme butonu
			</div>
			<div class="col-md-6"> // Sağ kolon
				<div class="title-bg">// Başlık arka planı
					<div class="title">Şifrenizi mi Unuttunuz?</div> // Başlık metni
				</div>
				<center><a href="sifre-guncelle"><img width="400" src="http://www.emrahyuksel.com.tr/dimg/sifremi-unuttum.jpg"></a></center>// Şifremi unuttum resmi
			</div>
		</div>
	</div>
</form>
</div>
			</div>

			<div class="container-fluid bg-1 text-center">// Alt container alanı
</div>
		</div>
	</div>
</div>
</section>

<?php include"footer.php" ?> // Footer dosyasını dahil eder