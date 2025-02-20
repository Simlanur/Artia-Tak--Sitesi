<?php include"header.php"; ?><!-- Header dosyasını dahil eder. Sayfanın üst kısmını tanımlar. -->
 <?php 
 // Duruma göre uyarı mesajları gösterilir.
        if ($_GET['durum']=="farklisifre") {?>
            <script type="text/javascript">
                alert("Farklı Şifre Girdiniz");// Kullanıcıya şifrelerin uyumsuz olduğunu bildirir.
            </script>
            <?php } elseif ($_GET['durum']=="eksiksifre") {?>
                <script type="text/javascript">
                    alert("Eksik Şifre Girdiniz");// Kullanıcıya eksik şifre girdiğini bildirir.
                </script>
                <?php } elseif ($_GET['durum']=="mukerrerkayit") {?>
                 <script type="text/javascript">

                    alert("Daha Önceden Kayıt olunmuş. Lütfen Farklı Bir mail ile kayıt olunuz"); // Kullanıcıya e-posta adresinin daha önce kullanıldığını bildirir.
                </script>
                <?php } elseif ($_GET['durum']=="basarisiz") {?>
                   <script type="text/javascript">
                    alert("Kayıt Olma Başarısız");// Kullanıcıya kaydın başarısız olduğunu bildirir.
                </script>
                <?php }
                ?>
 <!-- HTML içeriği: Kayıt formunu içerir. -->
<div class="container" style=" background: linear-gradient(to bottom right, white, gray);  height: 750px;  ">
    <div class="row"> <!-- Satır oluşturulur. -->
                <div class='col-sm-3'></div> <!-- Sol boşluk kolon. -->
                <div class="col-sm-6"><!-- Orta kolon: Formun bulunduğu alan. -->
                    <div class="login-box well"><!-- Form kutusu -->
                       <form action="yonetim-panel/islemler.php" method="POST"><!-- Form başlangıcı. Veriler POST metodu ile gönderilir. -->
                        <legend>KAYIT OL</legend><!-- Form başlığı -->
                        <div class="form-group"> <!-- Ad-Soyad girişi için grup. -->
                            <label for="username-email">Ad-Soyad</label><!-- Ad-Soyad etiketi -->
                            <input type="text" class="form-control"  required="" name="kullanici_adsoyad" placeholder="Ad ve Soyadınızı Giriniz..."> <!-- Ad-Soyad input alanı -->
                        </div>
                        <div class="form-group"><!-- E-posta girişi için grup. -->
                            <label for="username-email">E-mail Giriniz</label><!-- E-posta etiketi -->
                            <input type="email" class="form-control" required="" name="kullanici_mail"  placeholder="Dikkat! Mail adresiniz kullanıcı adınız olacaktır."><!-- E-posta input alanı -->
                        </div><div class="form-group"><!-- Adres girişi için grup. -->
                            <label for="username-email">Adres Giriniz</label><!-- Adres etiketi -->
                            <textarea class="form-control" required="" name="kullanici_adres"  placeholder="Dikkat! Kargonuz kayıtlı Olan adresinize gönderilecektir."></textarea><!-- Adres metin alanı -->
                        </div>
                        <div class="form-group"><!-- Şifre girişi için grup. -->
                            <label for="username-email">Sifre Giriniz</label><!-- Şifre tekrar etiketi -->
                            <input type="password" class="form-control" name="kullanici_passwordone"    placeholder="Şifrenizi Giriniz..."> <!-- Şifre tekrar input alanı -->
                        </div>
                        <div class="form-group"><!-- Şifre tekrar girişi için grup. -->
                            <label for="username-email">Sifre Tekrar</label><!-- Şifre tekrar etiketi -->
                            <input type="password" class="form-control" name="kullanici_passwordtwo"   placeholder="Şifrenizi Tekrar Giriniz..."><!-- Şifre tekrar input alanı -->
                        </div>
                        <div class="form-group"><!-- Kayıt ol butonu. -->
                            <button type="submit" name="kullanicikaydet" class="btn btn-default btn-login-submit btn-block m-t-md" >Kayıt ol</button>
                        </div>
                        <div class="form-group"> <!-- Giriş yap linki. -->
                            <p class="text-center m-t-xs text-sm">Zaten bir hesabın varmı ?</p> 
                            <a href="login.php" class="btn btn-default btn-block m-t-md">Giriş Yap</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class='col-sm-3'></div><!-- Sağ boşluk kolon. -->
        </div>
    </div>
    <?php include"footer.php" ?><!-- Footer dosyasını dahil eder. Sayfanın alt kısmını tanımlar. -->