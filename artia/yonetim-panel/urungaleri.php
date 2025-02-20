<?php 

ob_start();  // Çıktı önbelleklemeyi başlatır, sayfa henüz çıkış yapmadan veri gönderilmesine olanak tanır.
session_start();  // Kullanıcı oturumu başlatır.

include '../baglan.php';  // Veritabanı bağlantı dosyasını dahil eder.

if (!empty($_FILES)) {  // Eğer dosya yükleme yapılmışsa (dosya boş değilse işlemi başlat).

	$uploads_dir = '../images/urun';  // Yüklenen dosyaların kaydedileceği dizini belirtir.
	@$tmp_name = $_FILES['file']["tmp_name"];  // Yüklenen dosyanın geçici adını alır.
	@$name = $_FILES['file']["name"];  // Yüklenen dosyanın gerçek adını alır.
	$benzersizsayi1=rand(20000,32000);  // Benzersiz bir sayı oluşturur, her dosyaya farklı bir isim vermek için.
	$benzersizsayi2=rand(20000,32000);  // Benzersiz bir sayı daha oluşturur.
	$benzersizsayi3=rand(20000,32000);  // Bir başka benzersiz sayı oluşturur.
	$benzersizsayi4=rand(20000,32000);  // Son bir benzersiz sayı daha oluşturur.

	$benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;  // Dört benzersiz sayıyı birleştirerek dosya adı oluşturur.
	$refimgyol = $uploads_dir . "/" . $benzersizad . $name;  // Yüklenen dosyanın tam yolunu oluşturur.

	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");  // Geçici dosyayı hedef dizine taşır.

	$urun_id=$_POST['urun_id'];  // POST isteği ile gelen ürün id'sini alır.

	// Veritabanına yüklenen dosya bilgilerini kaydeder.
	$kaydet=$db->prepare("INSERT INTO tblurun_resim SET
		urunfoto_resimyol=:resimyol,
		urun_id=:urun_id");
	$insert=$kaydet->execute(array(  // Veritabanına veri eklemek için sorguyu çalıştırır.
		'resimyol' => $refimgyol,  // Yüklenen resmin yolu
		'urun_id' => $urun_id  // İlgili ürünün ID'si
		));
}

?>
