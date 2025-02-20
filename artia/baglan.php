<?php 

try {
    // PDO kullanarak veritabanı bağlantısı kurma
    // Veritabanı sunucusuna bağlantı sağlamak için gerekli parametreler
    $db = new PDO("mysql:host=localhost;dbname=artia;charset=utf8", 'root', '');
    // Burada 'localhost' MySQL sunucusunun adresi, 'artia' ise veritabanı adı.
    // 'root' kullanıcı adı, boş bir şifre kullanılıyor. (bu yerel bir sunucu için geçerli olabilir)

} catch (PDOException $e) {
    // Eğer bağlantı sırasında bir hata meydana gelirse, hata mesajını yakalar
    echo $e->getMessage();
    // PDOException sınıfı, veritabanı bağlantı hatalarını yakalar ve mesajı ekrana yazdırır
}

?>
