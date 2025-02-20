<?php 
include"../baglan.php"; // Veritabanı bağlantısı sağlanır
include"../fonksiyon.php"; // Ekstra fonksiyonlar dahil edilir
error_reporting(E_ALL ^ E_NOTICE); // Hata raporlaması yapılır
ini_set('error_reporting', E_ALL ^ E_NOTICE); // Hata raporlaması devre dışı bırakılır

/*SİTE LOGO DUZENLEME ALANI*/
if (isset($_POST['logoduzenle'])) { // Eğer POST ile gelen 'logoduzenle' verisi varsa site logosunu güncelleme işlemi başlatılır

    $uploads_dir = '../images'; // Yükleme yapılacak dizin belirlenir

    @$tmp_name = $_FILES['ayar_logo']["tmp_name"]; // Dosyanın geçici ismi alınır
    @$name = $_FILES['ayar_logo']["name"]; // Dosyanın adı alınır

    $benzersizsayi4 = rand(20000, 32000); // Benzersiz bir sayı üretilir
    $refimgyol = $uploads_dir . DIRECTORY_SEPARATOR . $benzersizsayi4 . $name; // Dosyanın yolu belirlenir

    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4$name"); // Dosya belirtilen dizine yüklenir

    // Site logosu veritabanında güncellenir
    $duzenle = $db->prepare("UPDATE tblayar SET
        ayar_logo=:logo
        WHERE ayar_id=0");
    $update = $duzenle->execute(array(
        'logo' => $refimgyol
    )); // Veritabanında logo güncellenir

    if ($update) { // Eğer güncelleme başarılıysa
        $resimsilunlink = $_POST['eski_yol']; // Eski logo yolunu alır
        unlink("../../images/$resimsilunlink"); // Eski logo silinir
        Header("Location:production/site-ayar-duzenle.php?durum=ok"); // Başarıyla güncellenirse yönlendirilir
    } else {
        Header("Location:production/site-ayar-duzenle.php?durum=no"); // Hata durumunda yönlendirilir
    }
}

/*KULLANICI RESİM DUZENLEME*/
if (isset($_POST['resimduzenle'])) { // Eğer POST ile gelen 'resimduzenle' verisi varsa, kullanıcı resmi düzenleme işlemi başlatılır

    $uploads_dir = '../images/User'; // Yükleme yapılacak dizin belirlenir

    @$tmp_name = $_FILES['kullanici_img']["tmp_name"]; // Dosyanın geçici ismi alınır
    @$name = $_FILES['kullanici_img']["name"]; // Dosyanın adı alınır

    $benzersizsayi4 = rand(20000, 32000); // Benzersiz bir sayı üretilir
    $refimgyol = $uploads_dir . DIRECTORY_SEPARATOR . $benzersizsayi4 . $name; // Dosyanın yolu belirlenir

    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4$name"); // Dosya belirtilen dizine yüklenir

    // Kullanıcı resmi veritabanında güncellenir
    $duzenle = $db->prepare("UPDATE tbluyeler SET
        kullanici_img=:img
    ");
    $update = $duzenle->execute(array(
        'img' => $refimgyol
    )); // Veritabanında kullanıcı resmi güncellenir

    if ($update) { // Eğer güncelleme başarılıysa
        $resimsilunlink = $_POST['eski_yol']; // Eski resim yolunu alır
        unlink("../../images/$resimsilunlink"); // Eski resmi siler
        Header("Location:../hesap.php?durum&kullanici_id=$kullanici_id&durum=ok"); // Başarıyla güncellenirse yönlendirilir
    } else {
        Header("Location:../hesap.php?durum&kullanici_id=$kullanici_id&durum=no"); // Hata durumunda yönlendirilir
    }
}

/*ÜRÜN FOTOĞRAFI SİLME*/
if (isset($_POST['urunfotosil'])) { // Eğer ürün fotoğrafı silme işlemi yapılacaksa

    $urun_id = $_POST['urun_id']; // Ürün ID'si alınır

    echo $checklist = $_POST['urunfotosec']; // Seçilen ürün fotoğraflarının ID'leri alınır

    foreach ($checklist as $list) { // Seçilen her bir fotoğraf için
        $sil = $db->prepare("DELETE from tblurun_resim where urunfoto_id=:urunfoto_id"); // Veritabanından silme işlemi yapılır
        $kontrol = $sil->execute(array(
            'urunfoto_id' => $list // Fotoğraf ID'si ile silme işlemi yapılır
        ));
    }

    if ($kontrol) { // Eğer silme işlemi başarılıysa
        Header("Location:production/urun-galeri.php?urun_id=$urun_id&durum=ok"); // Başarıyla silinirse yönlendirilir
    } else {
        Header("Location:production/urun-galeri.php?urun_id=$urun_id&durum=no"); // Hata durumunda yönlendirilir
    }
}

/*SLİDER İŞLEMLERİ*/
if (isset($_POST['sliderkaydet'])) { // Eğer slider kaydetme işlemi yapılacaksa

    $uploads_dir = '../images/Slider'; // Yükleme yapılacak dizin belirlenir
    @$tmp_name = $_FILES['slider_resimyol']["tmp_name"]; // Dosyanın geçici ismi alınır
    @$name = $_FILES['slider_resimyol']["name"]; // Dosyanın adı alınır

    // Benzersiz bir isim oluşturulup dosya yolu belirlenir
    $benzersizsayi1 = rand(20000, 32000);
    $benzersizsayi2 = rand(20000, 32000);
    $benzersizsayi3 = rand(20000, 32000);
    $benzersizsayi4 = rand(20000, 32000);
    $benzersizad = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
    $refimgyol = $uploads_dir . DIRECTORY_SEPARATOR . $benzersizad . $name;

    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name"); // Dosya belirtilen dizine yüklenir

    // Slider bilgileri veritabanına kaydedilir
    $kaydet = $db->prepare("INSERT INTO tblslider SET
        slider_ad=:slider_ad,
        slider_link=:slider_link,
        slider_resimyol=:slider_resimyol
    ");
    $insert = $kaydet->execute(array(
        'slider_ad' => $_POST['slider_ad'],
        'slider_link' => $_POST['slider_link'],
        'slider_resimyol' => $refimgyol
    ));

    if ($insert) { // Eğer slider kaydetme başarılıysa
        Header("Location:production/slider.php?durum=ok"); // Başarıyla kaydedilirse yönlendirilir
    } else {
        Header("Location:production/slider.php?durum=no"); // Hata durumunda yönlendirilir
    }
}

/*SLIDER SİLME*/
if ($_GET['slidersil'] == "ok") { // Eğer GET ile gelen 'slidersil' parametresi varsa

    $sil = $db->prepare("DELETE from tblslider where slider_id=:id"); // Veritabanından slider silme işlemi yapılır
    $kontrol = $sil->execute(array(
        'id' => $_GET['slider_id'] // Slider ID'sine göre silme işlemi yapılır
    ));

    if ($kontrol) { // Eğer silme işlemi başarılıysa
        header("Location:production/slider.php?durum=ok"); // Başarıyla silinirse yönlendirilir
    } else {
        header("Location:production/slider.php?durum=no"); // Hata durumunda yönlendirilir
    }
}

/*MENU DUZENLEME KODLARI----------------------------------------*/
if (isset($_POST['menuduzenle'])) {// eğer postan gelen değer boş değil ise 
	$menu_id=$_POST['menu_id']; //kullanici id ye göre gelen değerleri yakalama işlemi gerçekleştiriyoruz
	$menu_seourl=seo($_POST['menu_adi']);
	//Tablo güncelleme işlemi kodları...
	$menukaydet=$db->prepare("UPDATE tblmenu SET
		menu_adi=:menu_adi,
		menu_url=:menu_url,
		menu_seourl=:menu_seourl,
		menu_ust=:menu_ust,
		menu_durum=:menu_durum,
		menu_sira=:menu_sira
		WHERE menu_id={$_POST['menu_id']}");

	$update=$menukaydet->execute(array(
		
		'menu_adi'=>$_POST['menu_adi'],
		'menu_url'=>$_POST['menu_url'],
		'menu_seourl'=> $menu_seourl,
		'menu_ust'=>$_POST['menu_ust'],
		'menu_durum'=>$_POST['menu_durum'],
		'menu_sira'=>$_POST['menu_sira']
		
		
	));


	if ($update) {

		header("Location:production/menu.php?menu_id=$menu_id&durum=ok");

	} else {

		header("Location:production/menu.php?menu_id=$menu_id&durum=no");
	}
	
}
/*MENU EKLEME KODLARI----------------------------------------*/
if (isset($_POST['menuekle'])) {// eğer postan gelen değer boş değil ise 
	$menu_seourl=seo($_POST['menu_adi']);// menu adını seo fonksiyonundan geçirerek seourl ye dönüştürüyoruz
	//Tablo güncelleme işlemi kodları...
	$menukaydet=$db->prepare("INSERT INTO tblmenu SET
		menu_adi=:menu_adi,
		menu_url=:menu_url,
		menu_seourl=:menu_seourl,
		menu_ust=:menu_ust,
		menu_durum=:menu_durum
		");
	$insert=$menukaydet->execute(array(
		'menu_adi'=>$_POST['menu_adi'],
		'menu_url'=>$_POST['menu_url'],
		'menu_seourl'=> $menu_seourl,
		'menu_ust'=>$_POST['menu_ust'],
		'menu_durum'=>$_POST['menu_durum']	
	));
	if ($insert) {
		header("Location:production/menu.php?durum=ok");
	} else {
		header("Location:production/menu.php?durum=no");
	}

}

/*---------------------MENU SİLME Alanı Kodları------------------*/
if ($_GET['menusil']=="ok") {
	$sil=$db->prepare("DELETE from tblmenu where menu_id=:id");// tbluyeler tablosundaki forumdan gelen gelen get değerine göre silme işlemini yaptırıyoruz.
	$kontrol=$sil->execute(array(
		'id' => $_GET['menu_id']//gelen ıd veri tabanındaki ıd eşit ise silme işlemi gerçekleşir.
	));
	if ($kontrol) {
		header("Location:production/menu.php?durum=ok");// silme işlemi tamamlandığında get işlemi ?.. yaparak geri döneceği konumu belirtiyoruz.
	} else {
		header("Location:production/menu.php?durum=no");
	}
}



/*--------------------- Ürün Silme Alanı Kodları ------------------*/

if ($_GET['urunsil'] == "ok") { // Eğer URL'den gelen 'urunsil' parametresi 'ok' ise silme işlemi başlatılır.
    $sil = $db->prepare("DELETE FROM tblurunler WHERE urun_id=:id"); // tblurunler tablosundaki ürünü ID'ye göre silmek için sorgu hazırlanır.
    
    // Silme işlemini gerçekleştirmek için ID parametresi hazırlanır ve execute ile çalıştırılır.
    $kontrol = $sil->execute(array(
        'id' => $_GET['urun_id'] // URL'den gelen ürün ID'si veritabanındaki ürün ID'siyle eşleşirse silme işlemi gerçekleşir.
    ));

    // Eğer silme işlemi başarılıysa yönlendirme yapılır, değilse hata durumunu belirten yönlendirme yapılır.
    if ($kontrol) {
        header("Location:production/urunler.php?durum=ok"); // Silme başarılı olduğunda ürünler sayfasına 'durum=ok' parametresiyle yönlendirilir.
    } else {
        header("Location:production/urunler.php?durum=no"); // Silme başarısız olduğunda ürünler sayfasına 'durum=no' parametresiyle yönlendirilir.
    }
}

/*--------------------- Ürün Düzenleme Alanı Kodları ------------------*/

if (isset($_POST['urunduzenle'])) { // Eğer formdan gelen 'urunduzenle' post değeri boş değilse işlemleri başlatır.
    $urun_id = $_POST['urun_id']; // Formdan gelen ürün ID'sini alır.
    $urun_seourl = seo($_POST['urun_ad']); // Ürün adını SEO uyumlu bir URL'ye dönüştürür.

    // Veritabanında ürün bilgilerini güncellemek için hazırlanan SQL sorgusu.
    $urunkaydet = $db->prepare("UPDATE tblurunler SET
        kategori_id = :kategori_id,  // Ürünün kategori ID'si.
        urun_ad = :urun_ad,          // Ürünün adı.
        urun_detay = :urun_detay,    // Ürün detay bilgisi.
        urun_fiyat = :urun_fiyat,    // Ürün fiyatı.
        urun_stok = :urun_stok,      // Ürün stok adedi.
        urun_seourl = :urun_seourl   // SEO uyumlu URL.
        WHERE urun_id = {$_POST['urun_id']}"); // Güncellenmesi istenen ürünün ID'si.

    // Sorguyu çalıştırır ve formdan gelen verileri kullanarak tabloyu günceller.
    $update = $urunkaydet->execute(array(
        'kategori_id' => $_POST['kategori_id'],  // Formdan gelen kategori ID'si.
        'urun_ad' => $_POST['urun_ad'],          // Formdan gelen ürün adı.
        'urun_detay' => $_POST['urun_detay'],    // Formdan gelen ürün detay bilgisi.
        'urun_fiyat' => $_POST['urun_fiyat'],    // Formdan gelen ürün fiyatı.
        'urun_stok' => $_POST['urun_stok'],      // Formdan gelen ürün stok adedi.
        'urun_seourl' => $urun_seourl            // Ürün için oluşturulan SEO URL.
    ));

    // Eğer güncelleme başarılıysa yönlendirme yapar, değilse hata durumunu belirler.
    if ($update) {
        header("Location:production/urunler.php?urun_id=$urun_id&durum=ok"); // Güncelleme başarılı ise.
    } else {
        header("Location:production/urunler.php?urun_id=$urun_id&durum=no"); // Güncelleme başarısız ise.
    }
}

if ($_GET['urun_onecikar'] == "ok") { // Eğer URL'den gelen 'urun_onecikar' parametresi 'ok' ise işlem başlatır.
    // Veritabanında ürünü öne çıkarma durumunu güncellemek için sorgu hazırlar.
    $duzenle = $db->prepare("UPDATE tblurunler SET
        urun_onecikar = :urun_onecikar  // Ürünün öne çıkarma durumu.
        WHERE urun_id = {$_GET['urun_id']}"); // Güncellenmesi istenen ürünün ID'si.

    // Sorguyu çalıştırır ve URL'den gelen 'urun_one' parametresini kullanarak günceller.
    $update = $duzenle->execute(array(
        'urun_onecikar' => $_GET['urun_one'] // Ürünün öne çıkarma durumu (örneğin 1 veya 0).
    ));

    // Eğer öne çıkarma durumu başarılı bir şekilde güncellendiyse yönlendirme yapar, değilse hata durumunu belirler.
    if ($update) {
        Header("Location:production/urunler.php?durum=ok"); // Güncelleme başarılı ise.
    } else {
        Header("Location:production/urunler.php?durum=no"); // Güncelleme başarısız ise.
    }
}

/*---------------------Kategori Ekleme Alanı Kodları------------------*/

if (isset($_POST['urunekle'])) {// eğer postan gelen değer boş değil ise 

	$urun_seourl=seo($_POST['urun_ad']);


	
	//Tablo güncelleme işlemi kodları...
	$urunekle=$db->prepare("INSERT INTO tblurunler SET /* KATEGORİ EKLEME*/
		kategori_id=:kategori_id,
		urun_ad=:urun_ad,
		urun_detay=:urun_detay,
		urun_fiyat=:urun_fiyat,
		urun_stok=:urun_stok,
		urun_seourl=:urun_seourl
		");

	$ekle=$urunekle->execute(array(
		'kategori_id'=>$_POST['kategori_id'],
		'urun_ad'=>$_POST['urun_ad'],
		'urun_detay'=>$_POST['urun_detay'],
		'urun_fiyat'=>$_POST['urun_fiyat'],
		'urun_stok'=>$_POST['urun_stok'],
		'urun_seourl'=>$urun_seourl
	));


	if ($ekle) {

		header("Location:production/urunler.php?durum=ok");

	} else {

		header("Location:production/urunler.php?durum=no");
	}
	
}



/*---------------------Kullanıcı SİLME Alanı Kodları------------------*/
if ($_GET['kullanicisil']=="ok") {

	$sil=$db->prepare("DELETE from tbluyeler where kullanici_id=:id");// tbluyeler tablosundaki forumdan gelen gelen get değerine göre silme işlemini yaptırıyoruz.
	$kontrol=$sil->execute(array(
		'id' => $_GET['kullanici_id']//gelen ıd veri tabanındaki ıd eşit ise silme işlemi gerçekleşir.
	));


	if ($kontrol) {


		header("Location:production/kullanici.php?sil=ok");// silme işlemi tamamlandığında get işlemi ?.. yaparak geri döneceği konumu belirtiyoruz.


	} else {

		header("Location:production/kullanici.php?sil=no");

	}

}

/*---------------------Kullanıcı Duzenleme Alanı Kodları------------------*/

if (isset($_POST['kullaniciduzenle'])) { // Eğer POST ile gelen 'kullaniciduzenle' verisi varsa, kullanıcı düzenleme işlemi başlat

    $kullanici_id = $_POST['kullanici_id']; // POST ile gelen kullanıcı ID'si alınır

    // Kullanıcı bilgilerini güncelleme için SQL sorgusu hazırlanır
    $ayarkaydet = $db->prepare("UPDATE tbluyeler SET
        kullanici_adsoyad=:kullanici_adsoyad, // Kullanıcı adı soyadı güncellenir
        kullanici_adres=:kullanici_adres, // Kullanıcı adresi güncellenir
        kullanici_mail=:kullanici_mail, // Kullanıcı e-posta adresi güncellenir
        kullanici_tel=:kullanici_tel, // Kullanıcı telefon numarası güncellenir
        kullanici_adi=:kullanici_adi, // Kullanıcı kullanıcı adı güncellenir
        kullanici_sifre=:kullanici_sifre, // Kullanıcı şifresi güncellenir
        kullanici_kayit_tarihi=:kullanici_kayit_tarihi, // Kullanıcı kayıt tarihi güncellenir
        kullanici_durum=:kullanici_durum // Kullanıcı durumu (aktif/pasif) güncellenir
        WHERE kullanici_id={$_POST['kullanici_id']}"); // Kullanıcı ID'sine göre hangi kullanıcının güncelleneceği belirlenir

    // SQL sorgusu çalıştırılır ve veritabanı güncellenir
    $update = $ayarkaydet->execute(array(
        'kullanici_adsoyad' => $_POST['kullanici_adsoyad'], // Kullanıcı adı soyadı, POST ile gelen veriden alınır
        'kullanici_adres' => $_POST['kullanici_adres'], // Kullanıcı adresi, POST ile gelen veriden alınır
        'kullanici_mail' => $_POST['kullanici_mail'], // Kullanıcı e-posta adresi, POST ile gelen veriden alınır
        'kullanici_tel' => $_POST['kullanici_tel'], // Kullanıcı telefon numarası, POST ile gelen veriden alınır
        'kullanici_adi' => $_POST['kullanici_adi'], // Kullanıcı adı, POST ile gelen veriden alınır
        'kullanici_sifre' => $_POST['kullanici_sifre'], // Kullanıcı şifresi, POST ile gelen veriden alınır
        'kullanici_kayit_tarihi' => $_POST['kullanici_kayit_tarihi'], // Kullanıcı kayıt tarihi, POST ile gelen veriden alınır
        'kullanici_durum' => $_POST['kullanici_durum'] // Kullanıcı durumu, POST ile gelen veriden alınır
    ));

    // Eğer güncelleme işlemi başarılı ise
    if ($update) {
        header("Location:production/kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=ok"); // Başarıyla güncellendiyse, kullanıcı düzenleme sayfasına yönlendir
    } else {
        header("Location:production/kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=no"); // Eğer güncelleme başarısız ise, hata mesajı ile yönlendir
    }

}

/*---------------------Hesap Duzenleme Alanı Kodları------------------*/

if (isset($_POST['hesapduzenle'])) { // Eğer POST ile gelen 'hesapduzenle' verisi varsa, hesap düzenleme işlemi başlat

    $kullanici_id = $_POST['kullanici_id']; // POST ile gelen kullanıcı ID'si alınır

    // Hesap bilgilerini güncelleme için SQL sorgusu hazırlanır
    $ayarkaydet = $db->prepare("UPDATE tbluyeler SET
        kullanici_adsoyad=:kullanici_adsoyad, // Kullanıcı adı soyadı güncellenir
        kullanici_mail=:kullanici_mail, // Kullanıcı e-posta adresi güncellenir
        kullanici_adres=:kullanici_adres // Kullanıcı adresi güncellenir
        WHERE kullanici_id={$_POST['kullanici_id']}"); // Kullanıcı ID'sine göre hangi kullanıcının güncelleneceği belirlenir

    // SQL sorgusu çalıştırılır ve veritabanı güncellenir
    $update = $ayarkaydet->execute(array(
        'kullanici_adsoyad' => $_POST['kullanici_adsoyad'], // Kullanıcı adı soyadı, POST ile gelen veriden alınır
        'kullanici_mail' => $_POST['kullanici_mail'], // Kullanıcı e-posta adresi, POST ile gelen veriden alınır
        'kullanici_adres' => $_POST['kullanici_adres'] // Kullanıcı adresi, POST ile gelen veriden alınır
    ));

    // Eğer güncelleme işlemi başarılı ise
    if ($update) {
        header("Location:../hesap.php?durum&kullanici_id=$kullanici_id&durum=ok"); // Başarıyla güncellendiyse, hesap sayfasına yönlendir
    } else {
        header("Location:../hesap.php?durum&kullanici_id=$kullanici_id&durum=no"); // Eğer güncelleme başarısız ise, hata mesajı ile yönlendir
    }

}


/*---------------------Kategori SİLME Alanı Kodları------------------*/
if ($_GET['kategorisil'] == "ok") { // Eğer URL'den gelen 'kategorisil' parametresi "ok" ise, kategori silme işlemini başlat

    // Kategori veritabanından silme işlemi için SQL sorgusu hazırlanır
    $sil = $db->prepare("DELETE from tblkategori where kategori_id=:id"); // 'kategori_id' ile belirtilen kategoriyi sil
    $kontrol = $sil->execute(array( // SQL sorgusunun çalıştırılması

        'id' => $_GET['kategori_id'] // URL'den gelen 'kategori_id' parametresine göre kategori silme işlemi yapılır
    ));

    // Eğer silme işlemi başarılı ise
    if ($kontrol) {
        header("Location:production/kategori.php?sil=ok"); // Silme işlemi başarılı, kategori sayfasına yönlendir
    } else {
        header("Location:production/kategori.php?sil=no"); // Silme işlemi başarısız, hata mesajı ile kategori sayfasına yönlendir
    }

}

/*---------------------Kategori Duzenleme Alanı Kodları------------------*/

if (isset($_POST['kategoriduzenle'])) { // Eğer 'kategoriduzenle' POST verisi varsa, kategori düzenleme işlemi başlat

    $kategori_id = $_POST['kategori_id']; // POST ile gelen kategori ID'si alınır
    $kategori_seourl = seo($_POST['kategori_adi']); // Kategori adı SEO uyumlu URL formatına dönüştürülür

    // SQL sorgusu ile kategori bilgilerini güncelleme işlemi yapılacak
    $kaydet = $db->prepare("UPDATE tblkategori SET
        kategori_adi=:adi, // Kategori adı güncellenir
        kategori_durum=:kategori_durum, // Kategori durumu (aktif/pasif) güncellenir
        kategori_seourl=:seourl, // SEO uyumlu kategori URL'si güncellenir
        kategori_sira=:sira // Kategori sırası güncellenir
        WHERE kategori_id={$_POST['kategori_id']}"); // Kategori ID'si üzerinden hangi kategorinin güncelleneceği belirlenir

    // SQL sorgusunu çalıştırarak veritabanındaki kategori bilgilerini güncelleriz
    $update = $kaydet->execute(array(
        'adi' => $_POST['kategori_adi'], // Kategori adı, POST ile gönderilen veriden alınır
        'kategori_durum' => $_POST['kategori_durum'], // Kategori durumu, POST ile gönderilen veriden alınır
        'seourl' => $kategori_seourl, // SEO URL'si, önceden dönüştürülen değer kullanılır
        'sira' => $_POST['kategori_sira'] // Kategori sırası, POST ile gönderilen veriden alınır
    ));

    // Eğer kategori güncelleme işlemi başarılı ise
    if ($update) {
        header("Location:production/kategori.php?kategori_id=$kategori_id&durum=ok"); // Kategori başarıyla güncellendi, kategori sayfasına yönlendir
    } else {
        header("Location:production/kategori-duzenle.php?kategori_id=$kategori_id&durum=no"); // Kategori güncelleme başarısız, hata mesajı ile düzenleme sayfasına yönlendir
    }

}


/*---------------------Kategori Ekleme Alanı Kodları------------------*/

if (isset($_POST['kategoriekle'])) { // Eğer 'kategoriekle' POST verisi varsa, kategori ekleme işlemine başla

    $kategori_seourl = seo($_POST['kategori_adi']); // Kategori adını SEO uyumlu URL formatına dönüştürmek için seo() fonksiyonu kullanılır
    
    // SQL sorgusu hazırlayarak kategori bilgilerini veritabanına ekleme işlemi yapılacak
    $kaydet = $db->prepare("INSERT INTO tblkategori SET
        kategori_adi=:adi, // Kategori adını veritabanına ekle
        kategori_durum=:kategori_durum, // Kategori durumunu (aktif/pasif) ekle
        kategori_seourl=:seourl, // SEO uyumlu kategori URL'sini ekle
        kategori_ust=:ust // Üst kategori ID'sini (varsa) ekle
    ");
    
    // SQL sorgusunu çalıştırarak verileri veritabanına ekliyoruz
    $insert = $kaydet->execute(array(
        'adi' => $_POST['kategori_adi'], // Kategori adı, POST ile gönderilen veriden alınır
        'kategori_durum' => $_POST['kategori_durum'], // Kategori durumu, POST ile gönderilen veriden alınır
        'seourl' => $kategori_seourl, // SEO URL'si, önceden dönüştürülen değer kullanılır
        'ust' => $_POST['kategori_ust'] // Üst kategori ID'si, POST ile gönderilen veriden alınır (gerektiğinde)
    ));

    // Eğer kategori başarıyla eklendiyse
    if ($insert) {
        header("Location:production/kategori.php?durum=ok"); // Kategori ekleme başarılı, kategori sayfasına yönlendir
    } else {
        header("Location:production/kategori.php?durum=no"); // Kategori ekleme başarısız, hata mesajı ile kategori sayfasına yönlendir
    }

}



// SEPET İŞLEMLERİ
if (isset($_POST['sepeteekle'])) { // Eğer 'sepeteekle' post verisi gönderilmişse, sepete ürün eklemeye başla

    // Sepet tablosuna yeni bir ürün eklemek için SQL sorgusu hazırlıyoruz
    $ayarekle=$db->prepare("INSERT INTO tblsepet SET
        urun_adet=:urun_adet, // Sepete eklenen ürünün adedini kaydediyoruz
        kullanici_id=:kullanici_id, // Sepeti ekleyen kullanıcının ID'sini kaydediyoruz
        urun_id=:urun_id // Sepete eklenen ürünün ID'sini kaydediyoruz
    ");

    // SQL sorgusunu çalıştırarak verileri veritabanına ekliyoruz
    $insert=$ayarekle->execute(array(
        'urun_adet' => $_POST['urun_adet'], // Post ile gönderilen ürün adedini alıyoruz
        'kullanici_id' => $_POST['kullanici_id'], // Post ile gönderilen kullanıcı ID'sini alıyoruz
        'urun_id' => $_POST['urun_id'] // Post ile gönderilen ürün ID'sini alıyoruz
    ));

    // Eğer ürün başarıyla sepete eklendiyse
    if ($insert) {
        $url = htmlspecialchars($_SERVER['HTTP_REFERER']); // Kullanıcının geldiği sayfayı alıyoruz
        Header("Location: ".$url."?ekle=ok"); // Başarılı ekleme işleminden sonra kullanıcıyı aynı sayfaya yönlendiriyoruz
    } else {
        Header("Location:../urunler.php?durum=no"); // Eğer işlem başarısız olursa, hata sayfasına yönlendiriyoruz
    }

}

if ($_GET['sepetsil']=="ok") { // Eğer 'sepetsil' GET parametresi gönderildiyse, sepetteki ürünü silmeye başla

    // Sepet tablosundan belirtilen 'sepet_id' ile ürün silme işlemi için SQL sorgusu hazırlıyoruz
    $sil=$db->prepare("DELETE from tblsepet where sepet_id=:id"); 
    // Seçilen 'sepet_id' değerine sahip ürünü silmek için execute fonksiyonunu kullanıyoruz
    $kontrol=$sil->execute(array(
        'id' => $_GET['sepet_id'] // GET ile gönderilen 'sepet_id' değerine göre silme işlemi gerçekleştiriyoruz
    ));

    // Eğer silme işlemi başarılı olduysa
    if ($kontrol) {
        header("Location:../sepet.php?durum=ok"); // Silme işlemi başarılı olursa, sepet sayfasına yönlendiriyoruz
    } else {
        header("Location:../sepet.php?durum=no"); // Silme işlemi başarısız olursa, hata sayfasına yönlendiriyoruz
    }

}






// SEPET İŞLEMLERİ

/*---------------------SİTE AYAR Duzenleme Alanı Kodları------------------*/

if (isset($_POST['ayarduzenle'])) { // Eğer post ile gelen 'ayarduzenle' değeri varsa, işlemi başlat

    $ayar_id=$_POST['ayar_id']; // Post'tan gelen 'ayar_id' değerini alıyoruz, hangi ayarın düzenleneceğini belirlemek için

    // Tablo güncelleme işlemi kodları...
    $ayarkaydet=$db->prepare("UPDATE tblayar SET
        ayar_title=:ayar_title, // Site başlığını güncelle
        ayar_url=:ayar_url, // Site URL'sini güncelle
        ayar_description=:ayar_description, // Site açıklamasını güncelle
        ayar_keywords=:ayar_keywords, // Site anahtar kelimelerini güncelle
        ayar_author=:ayar_author, // Site yazarını güncelle
        ayar_tel=:ayar_tel, // Site telefon numarasını güncelle
        ayar_gsm=:ayar_gsm, // Site GSM numarasını güncelle
        ayar_mail=:ayar_mail, // Site e-posta adresini güncelle
        ayar_ilce=:ayar_ilce, // Site ilçe bilgisini güncelle
        ayar_il=:ayar_il, // Site il bilgisini güncelle
        ayar_adres=:ayar_adres, // Site adresini güncelle
        ayar_mesai=:ayar_mesai, // Site mesai saatlerini güncelle
        ayar_maps=:ayar_maps, // Site harita linkini güncelle
        ayar_bakim=:ayar_bakim // Site bakım modunu güncelle
        WHERE ayar_id={$_POST['ayar_id']}"); // Hangi ayarın güncelleneceğini belirtiyoruz (ayar_id'ye göre)

    // Güncelleme işlemi için veritabanına verileri gönderiyoruz
    $update=$ayarkaydet->execute(array(
        'ayar_title' => $_POST['ayar_title'], // Post'tan gelen site başlığını alıyoruz
        'ayar_url' => $_POST['ayar_url'], // Post'tan gelen site URL'sini alıyoruz
        'ayar_description' => $_POST['ayar_description'], // Post'tan gelen site açıklamasını alıyoruz
        'ayar_keywords' => $_POST['ayar_keywords'], // Post'tan gelen site anahtar kelimelerini alıyoruz
        'ayar_author' => $_POST['ayar_author'], // Post'tan gelen site yazarını alıyoruz
        'ayar_tel' => $_POST['ayar_tel'], // Post'tan gelen site telefon numarasını alıyoruz
        'ayar_gsm' => $_POST['ayar_gsm'], // Post'tan gelen site GSM numarasını alıyoruz
        'ayar_mail' => $_POST['ayar_mail'], // Post'tan gelen site e-posta adresini alıyoruz
        'ayar_ilce' => $_POST['ayar_ilce'], // Post'tan gelen site ilçe bilgisini alıyoruz
        'ayar_il' => $_POST['ayar_il'], // Post'tan gelen site il bilgisini alıyoruz
        'ayar_adres' => $_POST['ayar_adres'], // Post'tan gelen site adresini alıyoruz
        'ayar_mesai' => $_POST['ayar_mesai'], // Post'tan gelen site mesai saatlerini alıyoruz
        'ayar_maps' => $_POST['ayar_maps'], // Post'tan gelen site harita linkini alıyoruz
        'ayar_bakim' => $_POST['ayar_bakim'] // Post'tan gelen site bakım modunu alıyoruz
    ));

    // Eğer güncelleme başarılı olduysa
    if ($update) {
        header("Location:production/site-ayar-duzenle.php?ayar_id=$ayar_id&durum=ok"); // Başarılı olduğunda belirli bir sayfaya yönlendir
    } else {
        header("Location:production/site-ayar-duzenle.php?ayar_id=$ayar_id&durum=no"); // Başarısız olduğunda hata sayfasına yönlendir
    }

}


// HAKKIMIZDA DUZENLEME İŞLEMLERİ

if (isset($_POST['hakkimizdaduzenle'])) { // Eğer post ile gelen 'hakkimizdaduzenle' değeri varsa, işlemi başlat

    $hakkimizda_id=$_POST['hakkimizda_id']; // Post'tan gelen 'hakkimizda_id' değerini alıyoruz, bu id'yi kullanarak hangi veriyi güncelleyeceğimizi belirleyeceğiz

    // Tablo güncelleme işlemi kodları...
    $hakkimizdakaydet=$db->prepare("UPDATE hakkimizda SET
        hakkimizda_baslik=:hakkimizda_baslik, // Hakkımızda başlığını güncelle
        hakkimizda_icerik=:hakkimizda_icerik, // Hakkımızda içerik kısmını güncelle
        hakkimizda_video=:hakkimizda_video, // Hakkımızda video bağlantısını güncelle
        hakkimizda_vizyon=:hakkimizda_vizyon // Hakkımızda vizyon kısmını güncelle
        WHERE hakkimizda_id=0"); // Hangi kaydın güncelleneceğini belirtiyoruz (şu an id=0 olarak yazılmış, burada dinamik bir id kullanılabilir)

    // Güncelleme işlemi için veritabanına verileri gönderiyoruz
    $update=$hakkimizdakaydet->execute(array(
        'hakkimizda_baslik'=>$_POST['hakkimizda_baslik'], // Post'tan gelen başlık
        'hakkimizda_icerik'=>$_POST['hakkimizda_icerik'], // Post'tan gelen içerik
        'hakkimizda_video'=>$_POST['hakkimizda_video'], // Post'tan gelen video
        'hakkimizda_vizyon'=>$_POST['hakkimizda_vizyon'] // Post'tan gelen vizyon
    ));

    // Eğer güncelleme başarılı olduysa
    if ($update) {
        header("Location:production/hakkimizda-ayar.php?hakkimizda_id=$hakkimizda_id&durum=ok"); // Başarılı olduğunda, belirli bir sayfaya yönlendir
    } else {
        header("Location:production/hakkimizda-ayar.php?hakkimizda_id=$hakkimizda_id&durum=no"); // Başarısız olduğunda, hata sayfasına yönlendir
    }

}

/*KULLANICI KAYIT İŞLEMLERİ*/
if (isset($_POST['kullanicikaydet'])) { // Eğer post ile gelen 'kullanicikaydet' değeri varsa, kullanıcı kayıt işlemi başlat

    // Post'tan gelen verileri alıyoruz ve ekrana yazdırıyoruz (htmlspecialchars ile güvenli hale getiriyoruz)
    echo $kullanici_adsoyad=htmlspecialchars($_POST['kullanici_adsoyad']); echo "<br>"; // Kullanıcı ad ve soyadını alıyoruz
    echo $kullanici_mail=htmlspecialchars($_POST['kullanici_mail']); echo "<br>"; // Kullanıcı mailini alıyoruz
    echo $kullanici_adres=htmlspecialchars($_POST['kullanici_adres']); echo "<br>"; // Kullanıcı adresini alıyoruz

    echo $kullanici_passwordone=trim($_POST['kullanici_passwordone']); echo "<br>"; // Kullanıcı şifresinin ilk kez girilen halini alıyoruz (boşlukları temizleyerek)
    echo $kullanici_passwordtwo=trim($_POST['kullanici_passwordtwo']); echo "<br>"; // Kullanıcı şifresinin ikinci kez girilen halini alıyoruz (boşlukları temizleyerek)

    // Şifreler birbirine eşitse işlemi devam ettir
    if ($kullanici_passwordone==$kullanici_passwordtwo) {

        // Şifre en az 6 karakter olmalı
        if (strlen($kullanici_passwordone)>=6) { // Eğer şifre uzunluğu 6 karakter veya daha fazla ise işlemi devam ettir



			

			


// Başlangıç

			$kullanicisor=$db->prepare("select * from tbluyeler where kullanici_mail=:mail");
			$kullanicisor->execute(array(
				'mail' => $kullanici_mail
			));

			//dönen satır sayısını belirtir
			$say=$kullanicisor->rowCount();



			if ($say==0) {

				//md5 fonksiyonu şifreyi md5 şifreli hale getirir.
				$password=md5($kullanici_passwordone);

				$kullanici_yetki=0;

			//Kullanıcı kayıt işlemi yapılıyor...
				$kullanicikaydet=$db->prepare("INSERT INTO tbluyeler SET
					kullanici_adsoyad=:kullanici_adsoyad,
					kullanici_mail=:kullanici_mail,
					kullanici_password=:kullanici_password,
					kullanici_adres=:kullanici_adres,
					kullanici_yetki=:kullanici_yetki
					");
				$insert=$kullanicikaydet->execute(array(
					'kullanici_adsoyad' => $kullanici_adsoyad,
					'kullanici_mail' => $kullanici_mail,
					'kullanici_password' => $password,
					'kullanici_yetki' => $kullanici_yetki,
					'kullanici_adres'=>$kullanici_adres
				));

				if ($insert) {


					header("Location:../login.php?durum=loginbasarili");
					exit;


				//Header("Location:../production/genel-ayarlar.php?durum=ok");

				} else {


					header("Location:../kayitol.php?durum=basarisiz");
					exit;
				}

			} else {
				header("Location:../kayitol.php?durum=mukerrerkayit");
				exit;
			}
			
		// Bitiş

		} else {
			header("Location:../kayitol.php?durum=eksiksifre");
			exit;
		}
	} else {
		header("Location:../kayitol.php?durum=farklisifre");
		exit;
	}
	
}

/* Yorum EKLEME KODLARI ---------------------------------------- */

// Yorum kaydetme işlemi başlıyor
if (isset($_POST['yorumkaydet'])) {

	$gelen_url=$_POST['gelen_url']; // Yorum gönderildikten sonra dönülecek URL

	// Yorum verilerini veritabanına eklemek için hazırlık yapılıyor
	$ayarekle=$db->prepare("INSERT INTO tblyorum SET
		yorum_detay=:yorum_detay,
		kullanici_id=:kullanici_id,
		urun_id=:urun_id	
	");

	// Veritabanına yorum ekleniyor
	$insert=$ayarekle->execute(array(
		'yorum_detay' => $_POST['yorum_detay'], // Yorum detayını alıyoruz
		'kullanici_id' => $_POST['kullanici_id'], // Kullanıcı ID'sini alıyoruz
		'urun_id' => $_POST['urun_id'] // Ürün ID'sini alıyoruz
	));

	// Yorum başarıyla eklendiyse
	if ($insert) {
		Header("Location:$gelen_url?durum=ok"); // Başarıyla işlem tamamlandı, belirtilen URL'ye yönlendiriyoruz
		exit;
	} else {
		Header("Location:$gelen_url?durum=no"); // Yorum ekleme başarısızsa hata mesajı ile yönlendiriyoruz
		exit;
	}
}

/* Yorum Düzenleme Kodu */
if ($_GET['yorum_onay']=="ok") {

	// Yorum onay durumunu güncelleme işlemi
	$duzenle=$db->prepare("UPDATE tblyorum SET
		yorum_onay=:yorum_onay
		WHERE yorum_id={$_GET['yorum_id']}");

	// Onay durumu güncelleniyor
	$update=$duzenle->execute(array(
		'yorum_onay' => $_GET['yorum_one'] // Onay durumu GET parametresinden alınıyor
	));

	// Eğer güncelleme başarılıysa
	if ($update) {
		Header("Location:production/yorum.php?durum=ok"); // Başarıyla işlem tamamlandı, yönlendirme
		exit;
	} else {
		Header("Location:production/yorum.php?durum=no"); // Başarısızsa hata mesajı ile yönlendirme
		exit;
	}
}

/* Yorum Silme Kodu */
if ($_GET['yorumsil']=="ok") {

	// Yorum silme işlemi
	$sil=$db->prepare("DELETE from tblyorum where yorum_id=:yorum_id"); // Yorum ID'sine göre yorum siliniyor
	$kontrol=$sil->execute(array(
		'yorum_id' => $_GET['yorum_id'] // Silinecek yorum ID'si GET parametresinden alınıyor
	));

	// Eğer silme işlemi başarılıysa
	if ($kontrol) {
		Header("Location:production/yorum.php?durum=ok"); // Başarıyla silindiyse yönlendirme
		exit;
	} else {
		Header("Location:production/yorum.php?durum=no"); // Başarısızsa hata mesajı ile yönlendirme
		exit;
	}
}

/* BANKA DUZENLEME KODLARI */

// Banka bilgilerini düzenleme işlemi
if (isset($_POST['bankaduzenle'])) {

	$banka_id=$_POST['banka_id']; // Banka ID'si alınır

	// Banka bilgileri güncelleniyor
	$kaydet=$db->prepare("UPDATE TBLbanka SET
		banka_ad=:ad,
		banka_durum=:banka_durum,	
		banka_hesap_adsoyad=:banka_hesap_adsoyad,
		banka_iban=:banka_iban
		WHERE banka_id={$_POST['banka_id']}");

	// Güncelleme işlemi yapılır
	$update=$kaydet->execute(array(
		'ad' => $_POST['banka_ad'], // Banka adı
		'banka_durum' => $_POST['banka_durum'], // Banka durumu
		'banka_hesap_adsoyad' => $_POST['banka_hesap_adsoyad'], // Banka hesap adı soyadı
		'banka_iban' => $_POST['banka_iban'] // Banka IBAN numarası
	));

	// Eğer güncelleme başarılıysa
	if ($update) {
		header("Location:production/banka.php?banka_id=$banka_id&durum=ok"); // Başarıyla güncellendiyse yönlendirme
		exit;
	} else {
		header("Location:production/banka.php?banka_id=$banka_id&durum=no"); // Başarısızsa hata mesajı ile yönlendirme
		exit;
	}
}

/* BANKA EKLEME ALANI KODLARI */

// Banka ekleme işlemi
if (isset($_POST['bankaekle'])) {

	// Banka bilgileri veritabanına ekleniyor
	$kaydet=$db->prepare("INSERT INTO tblbanka SET
		banka_ad=:banka_ad,
		banka_iban=:banka_iban,	
		banka_hesap_adsoyad=:banka_hesap_adsoyad
	");

	// Banka bilgileri veritabanına ekleniyor
	$update=$kaydet->execute(array(
		'banka_ad' => $_POST['banka_ad'], // Banka adı
		'banka_iban' => $_POST['banka_iban'], // Banka IBAN numarası
		'banka_hesap_adsoyad' => $_POST['banka_hesap_adsoyad'] // Banka hesap adı soyadı
	));

	// Eğer banka ekleme başarılıysa
	if ($update) {
		header("Location:production/banka.php?banka_id=$banka_id&durum=ok"); // Başarıyla eklendiyse yönlendirme
		exit;
	} else {
		header("Location:production/banka-duzenle.php?banka_id=$banka_id&durum=no"); // Başarısızsa hata mesajı ile yönlendirme
		exit;
	}
}

/* BANKA SİLME KODLARI */

// Banka silme işlemi
if ($_GET['bankasil']=="ok") {

	// Banka veritabanından siliniyor
	$sil=$db->prepare("DELETE from tblbanka where banka_id=:id"); // Banka ID'sine göre silme işlemi
	$kontrol=$sil->execute(array(
		'id' => $_GET['banka_id'] // Silinecek banka ID'si
	));

	// Eğer silme işlemi başarılıysa
	if ($kontrol) {
		header("Location:production/banka.php?durum=ok"); // Başarıyla silindiyse yönlendirme
		exit;
	} else {
		header("Location:production/banka.php?durum=no"); // Başarısızsa hata mesajı ile yönlendirme
		exit;
	}
}



// Sipariş düzenleme işlemi
if (isset($_POST['siparisduzenle'])) { // Eğer POST ile gelen 'siparisduzenle' verisi varsa

	$siparis_id=$_POST['siparis_id']; // Kullanıcıdan gelen sipariş ID'sini al

	// Tabloyu güncelleme işlemi
	$ayarkaydet=$db->prepare("UPDATE tblsiparis SET
		siparis_durum=:siparis_durum
		WHERE siparis_id={$_POST['siparis_id']}"); // Sipariş durumu güncelleniyor

	$update=$ayarkaydet->execute(array(
		'siparis_durum' => $_POST['siparis_durum'] // 'siparis_durum' parametresine POST'tan gelen veri atanıyor
	));

	// Eğer güncelleme başarılıysa
	if ($update) {
		header("Location:production/siparis.php?durum&siparis_id=$siparis_id&durum=ok"); // Başarı durumunda yönlendirme
	} else {
		header("Location:production/siparis-duzenle.php?durum&siparis_id=$siparis_id&durum=no"); // Başarısızsa yönlendirme
	}
}

// Eğer ödeme başarılıysa
if ($_GET['siparis_odeme']=="ok") {

	// Yorum güncelleme işlemi
	$duzenle=$db->prepare("UPDATE tblsiparis SET
		siparis_odeme=:siparis_odeme
		WHERE yorum_id={$_GET['yorum_id']}"); // Sipariş ödeme durumu güncelleniyor

	$update=$duzenle->execute(array(
		'yorum_onay' => $_GET['yorum_one'] // 'yorum_one' parametresine GET'ten gelen veri atanıyor
	));

	// Eğer güncelleme başarılıysa
	if ($update) {
		Header("Location:production/yorum.php?durum=ok"); // Başarı durumunda yönlendirme
		exit;
	} else {
		Header("Location:production/yorum.php?durum=no"); // Başarısızsa yönlendirme
		exit;
	}
}

// Eğer banka siparişi ekleniyorsa
if (isset($_POST['bankasiparisekle'])) {

	$siparis_tip="Banka Havalesi"; // Sipariş tipi banka havalesi olarak belirleniyor

	// Sipariş verisi kaydediliyor
	$kaydet=$db->prepare("INSERT INTO tblsiparis SET
		kullanici_id=:kullanici_id,
		siparis_tip=:siparis_tip,	
		siparis_banka=:siparis_banka,
		siparis_toplam=:siparis_toplam
		");
	$insert=$kaydet->execute(array(
		'kullanici_id' => $_POST['kullanici_id'], // Kullanıcı ID'si alınarak sipariş kaydediliyor
		'siparis_tip' => $siparis_tip, // Sipariş tipi banka havalesi
		'siparis_banka' => $_POST['siparis_banka'], // Banka bilgisi alınıyor
		'siparis_toplam' => $_POST['siparis_toplam'] // Toplam tutar alınıyor
	));

	// Eğer sipariş ekleme başarılıysa
	if ($insert) {

		// Sipariş ID'si alınıyor
		echo $siparis_id = $db->lastInsertId(); // En son eklenen siparişin ID'si
		echo "<hr>";

		$kullanici_id=$_POST['kullanici_id']; // Kullanıcı ID'si alınır
		$sepetsor=$db->prepare("SELECT * FROM tblsepet where kullanici_id=:id"); // Sepet verileri alınıyor
		$sepetsor->execute(array(
			'id' => $kullanici_id // Kullanıcı ID'sine göre sepet verisi sorgulanıyor
		));

		// Sepetteki ürünler döngüye alınır
		while($sepetcek=$sepetsor->fetch(PDO::FETCH_ASSOC)) {

			$urun_id=$sepetcek['urun_id']; // Ürün ID'si
			$urun_adet=$sepetcek['urun_adet']; // Ürün adeti

			$urunsor=$db->prepare("SELECT * FROM tblurunler where urun_id=:id"); // Ürün detayları alınıyor
			$urunsor->execute(array(
				'id' => $urun_id // Ürün ID'sine göre veri alınıyor
			));

			$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
			
			$urun_fiyat=$uruncek['urun_fiyat']; // Ürün fiyatı alınıyor

			// Sipariş detayları kaydediliyor
			$kaydet=$db->prepare("INSERT INTO tblsiparis_detay SET
				siparis_id=:siparis_id,
				urun_id=:urun_id,	
				urun_fiyat=:urun_fiyat,
				urun_adet=:urun_adet
			");
			$insert=$kaydet->execute(array(
				'siparis_id' => $siparis_id, // Sipariş ID'si
				'urun_id' => $urun_id, // Ürün ID'si
				'urun_fiyat' => $urun_fiyat, // Ürün fiyatı
				'urun_adet' => $urun_adet // Ürün adeti
			));
		}

		// Eğer sipariş detayları başarılıysa
		if ($insert) {
			// Sepet boşaltılıyor
			$sil=$db->prepare("DELETE from tblsepet where kullanici_id=:kullanici_id"); // Sepetteki ürünler siliniyor
			$kontrol=$sil->execute(array(
				'kullanici_id' => $kullanici_id // Kullanıcıya ait sepet verileri siliniyor
			));

			Header("Location:../siparislerim?durum=ok"); // Siparişler sayfasına yönlendirme
			exit;

		}

	} else {

		echo "başarısız"; // Sipariş ekleme başarısızsa hata mesajı

		// Header("Location:../production/siparis.php?durum=no"); // Sipariş sayfasına yönlendirme
	}

}
