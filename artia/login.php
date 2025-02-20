<?php include"header.php"; ?> <!-- Header dosyasını dahil eder. Bu dosya genellikle sayfa üst bilgilerini içerir. -->
<?php 
ob_start(); // Sayfa yönlendirmelerinde sorun yaşanmaması için tamponlama başlatılır.
session_start(); // Kullanıcı oturumunu başlatır veya mevcut oturumu devam ettirir.
?>

<?php 
// Kullanıcı girişi kontrol işlemleri başlar
if (isset($_POST['kullanicigiris'])) { // Kullanıcı giriş formunun gönderilip gönderilmediğini kontrol eder.

    $kullanici_mail=$_POST['kullanici_mail']; // Formdan gelen kullanıcı e-posta adresini alır.
    $kullanici_password=md5($_POST['kullanici_password']); // Formdan gelen şifreyi MD5 algoritması ile şifreler.

    // Veritabanından kullanıcı bilgilerini kontrol etmek için bir sorgu hazırlanır.
    $kullanicisor=$db->prepare("select * from tbluyeler where kullanici_mail=:mail and kullanici_password=:password");
    $kullanicisor->execute(array( // Sorguyu e-posta ve şifre parametreleri ile çalıştırır.
        'mail' => $kullanici_mail, // Kullanıcı e-postası
        'password' => $kullanici_password // Kullanıcı şifresi
    ));

    $say=$kullanicisor->rowCount(); // Sorgudan dönen satır sayısını alır. (Kullanıcı var mı kontrol eder.)

    if ($say==1) { // Eğer sorgu sonucunda bir kayıt bulunursa
        $_SESSION['userkullanici_mail']=$kullanici_mail; // Kullanıcı oturumunu başlatır ve e-posta bilgisini oturum değişkenine kaydeder.
        header("Location:index.php?durum=basariligiris"); // Anasayfaya yönlendirir ve durum bilgisini iletir.
        exit; // Daha fazla kodun çalışmasını engeller.
    } else { // Eğer kullanıcı bulunamazsa
        header("Location:login.php?durum=basarisizgiris"); // Giriş sayfasına geri döner ve hata durumunu iletir.
    }
}
// Kullanıcı girişi kontrol işlemleri sonlanır
?>

<!-- HTML içeriği: Giriş yap formunu içerir. -->
<div class="container" style="background: linear-gradient(to bottom right, white, red); height: 500px;"> <!-- Ana container, arka plan renk geçişi ve yükseklik tanımlanır. -->
    <div class="row"> <!-- Sayfa düzlemi için bir satır tanımlar. -->
        <div class='col-sm-3'></div> <!-- Sol boşluk kolon -->
        <div class="col-sm-6"> <!-- Formun bulunduğu orta kolon -->
            <div class="login-box well"> <!-- Form kutusunu tanımlar. -->
                <form action="login.php" method="POST"> <!-- Form başlangıcı, gönderim metodu POST olarak ayarlanır. -->
                    <legend>Giriş Yap</legend> <!-- Form başlığı -->
                    <div class="form-group"> <!-- Kullanıcı e-postası girişi için grup -->
                        <label for="username-email">E-mail Giriniz</label> <!-- E-posta etiketi -->
                        <input type="text" id="username-email" placeholder="E-mail Giriniz" class="form-control" name="kullanici_mail" /> <!-- E-posta input alanı -->
                    </div>
                    <div class="form-group"> <!-- Kullanıcı şifresi girişi için grup -->
                        <label for="password">Şifre</label> <!-- Şifre etiketi -->
                        <input type="password" id="username-email" placeholder="Şifrenizi Giriniz" class="form-control" name="kullanici_password" /> <!-- Şifre input alanı -->
                    </div>

                    <div class="form-group"> <!-- Giriş yap butonu -->
                        <button type="submit" name="kullanicigiris" class="btn btn-default btn-login-submit btn-block m-t-md" value="Giris">Giriş Yap</button>
                    </div>

                    <div class="form-group"> <!-- Yeni hesap oluşturma linki -->
                        <p class="text-center m-t-xs text-sm">Hesabın Yok mu?</p> 
                        <a href="kayitol.php" class="btn btn-default btn-block m-t-md">Yeni Hesap Oluştur</a>
                    </div>
                </form>
            </div>
        </div>
        <div class='col-sm-3'></div> <!-- Sağ boşluk kolon -->
    </div>
</div>
<?php include"footer.php" ?> <!-- Footer dosyasını dahil eder. Bu dosya genellikle sayfa alt bilgilerini içerir. -->