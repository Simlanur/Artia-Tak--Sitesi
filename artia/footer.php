<footer id="footer"><!--Footer Başlangıcı-->
    <div class="footer-widget"> <!-- Footer widget'ları alanı -->
        <div class="container"> <!-- Konteyner başlatılıyor -->
            <div class="row"> <!-- Satır başlatılıyor -->
                <div class="col-sm-2"> <!-- Sol bölmede sayfa linkleri -->
                    <div class="single-widget"> <!-- Widget başlatılıyor -->
                        <h2>Sayfalar</h2> <!-- Başlık: Sayfalar -->
                        <ul class="nav nav-pills nav-stacked"> <!-- Sayfa bağlantıları listesi -->
                            <li><a href="index">Anasayfa</a></li> <!-- Anasayfa bağlantısı -->
                            <li><a href="urunler">Ürünler</a></li> <!-- Ürünler sayfası bağlantısı -->
                            <li><a href="index">Hakkımızda</a></li> <!-- Hakkımızda sayfası bağlantısı -->
                            <li><a href="index">İletişim</a></li> <!-- İletişim sayfası bağlantısı -->
                        </ul>
                    </div>
                </div>
                
                <div class="col-sm-2"> <!-- Sağdaki iletişim bölmesi -->
                    <div class="single-widget">
                        <h2>İLETİŞİM</h2> <!-- Başlık: İletişim -->
                        <ul class="nav nav-pills nav-stacked"> <!-- İletişim bilgileri listesi -->
                            <li><a href="index">info@artia.com</a></li> <!-- E-posta adresi -->
                            <li><a href="index">TEL 0555 555 55 55</a></li> <!-- Telefon numarası -->
                        </ul>
                    </div>
                </div>

                <div class="col-sm-2"> <!-- Boş alan bırakılmış -->
                    <div class="single-widget">
                        <!-- İçerik yok -->
                    </div>
                </div>

                <div class="col-sm-2"> <!-- Boş alan bırakılmış -->
                    <div class="single-widget">
                        <ul class="nav nav-pills nav-stacked">
                            <!-- İçerik yok -->
                        </ul>
                    </div>
                </div>

                <div class="col-sm-2"> <!-- Boş alan bırakılmış -->
                    <div class="single-widget">
                        <ul class="nav nav-pills nav-stacked">
                            <!-- İçerik yok -->
                        </ul>
                    </div>
                </div>

                <div class="col-sm-2"> <!-- Kart bilgisi veya ödeme seçenekleri alanı -->
                    <div class="single-widget">
                        <ul class="nav nav-pills nav-stacked">
                            <!-- Visa kart logosu -->
                            <img class="pull-right" src="images/Visa.png" height="50px" width="125px" style="margin-top: 125px;">
                        </ul>
                    </div>
                </div>

                <div class="col-sm-2"> <!-- Boş alan bırakılmış -->
                    <div class="single-widget">
                        <ul class="nav nav-pills nav-stacked">
                            <!-- İçerik yok -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- Footer widget bitiyor -->
    
    <div class="footer-bottom"> <!-- Footer alt kısmı -->
        <div class="container"> <!-- Konteyner başlatılıyor -->
            <div class="row"> <!-- Satır başlatılıyor -->
                <p class="pull-left">Copyright © Artia</p> <!-- Telif hakkı metni -->
            </div>
        </div>
    </div> <!-- Footer alt kısmı bitiyor -->
</footer><!--/Footer Sonu-->

<!-- JavaScript Dosyaları -->
<script src="js/jquery.js"></script> <!-- jQuery kütüphanesi -->
<script src="js/bootstrap.min.js"></script> <!-- Bootstrap kütüphanesi -->
<script src="js/jquery.scrollUp.min.js"></script> <!-- Sayfayı yukarı kaydırma eklentisi -->
<script src="js/price-range.js"></script> <!-- Fiyat aralığı eklentisi -->
<script src="js/jquery.prettyPhoto.js"></script> <!-- Resim galerisi eklentisi -->
<script src="js/main.js"></script> <!-- Ana JavaScript dosyası -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> <!-- Eski jQuery kütüphanesi -->
<script src="jquery.velocity.min.js"></script> <!-- Hızlı animasyon kütüphanesi -->
<script type="text/javascript" src="jquery.touchSwipe.min.js"></script> <!-- Dokunmatik ekran desteği -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> <!-- Güncel jQuery kütüphanesi -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> <!-- Güncel Bootstrap kütüphanesi -->
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script> <!-- En son sürüm jQuery -->
<script src="js/script.js"></script> <!-- Özel JavaScript dosyası -->

<!-- Slider (Slayt gösterisi) için JavaScript -->
<script>
"use strict";
  var _slayt = document.getElementsByClassName("slayt"); // Slaytları seçiyoruz
  var slaytSayisi = _slayt.length; // Slayt sayısını alıyoruz
  var slaytNo = 0; // İlk slaytı gösteriyoruz
  var i = 0;

  slaytGoster(slaytNo); // İlk slaytı göster

  // Sonraki slayta geçiş fonksiyonu
  function sonrakiSlayt() {
    slaytNo++; // Slayt numarasını artırıyoruz
    slaytGoster(slaytNo); // Yeni slaytı göster
  }

  // Önceki slayta geçiş fonksiyonu
  function oncekiSlayt() {
    slaytNo--; // Slayt numarasını azaltıyoruz
    slaytGoster(slaytNo); // Yeni slaytı göster
  }

  // Slaytları göstermek için fonksiyon
  function slaytGoster(slaytNumarasi) {
    slaytNo = slaytNumarasi; // Slayt numarasını güncelliyoruz

    if (slaytNumarasi >= slaytSayisi) slaytNo = 0; // Eğer slayt numarası son slayttan büyükse, başa dön

    if (slaytNumarasi < 0) slaytNo = slaytSayisi - 1; // Eğer slayt numarası 0'dan küçükse, son slayta dön

    for (i = 0; i < slaytSayisi; i++) {
      _slayt[i].style.display = "none"; // Tüm slaytları gizle
    }

    _slayt[slaytNo].style.display = "block"; // Belirtilen slaytı göster
  }
</script>
</body>
</html>
