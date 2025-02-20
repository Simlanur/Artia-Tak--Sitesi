/**
 * Resize function without multiple trigger
 * 
 * Usage:
 * $(window).smartresize(function(){  
 *     // kod buraya yazılabilir
 * });
 */
(function($, sr) {
    // John Hann'dan alınmış debouncing fonksiyonu
    // (Metotların gereksiz yere birden fazla tetiklenmesini önlemek için kullanılır)
    var debounce = function (func, threshold, execAsap) {
        var timeout;

        return function debounced() {
            var obj = this, args = arguments;
            function delayed() {
                if (!execAsap)
                    func.apply(obj, args); // Eğer hemen çalıştırılmayacaksa fonksiyonu çağır
                timeout = null; // Zamanlayıcıyı sıfırla
            }

            if (timeout)
                clearTimeout(timeout); // Eğer bir zamanlayıcı varsa, temizle
            else if (execAsap)
                func.apply(obj, args); // Eğer hemen çalıştırılması gerekiyorsa, fonksiyonu çağır

            timeout = setTimeout(delayed, threshold || 100); // Zamanlayıcıyı başlat
        };
    };

    // "smartresize" adında bir jQuery fonksiyonu ekler
    jQuery.fn[sr] = function(fn) {  
        return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); 
    };
})(jQuery, 'smartresize');

/**
 * URL değişkenlerini ayırmak için tanımlanan global değişkenler
 */
var CURRENT_URL = window.location.href.split('#')[0].split('?')[0],
    $BODY = $('body'),
    $MENU_TOGGLE = $('#menu_toggle'), // Menü geçiş butonu
    $SIDEBAR_MENU = $('#sidebar-menu'), // Yan menü
    $SIDEBAR_FOOTER = $('.sidebar-footer'), // Yan menü alt kısmı
    $LEFT_COL = $('.left_col'), // Sol kolon
    $RIGHT_COL = $('.right_col'), // Sağ kolon (ana içerik)
    $NAV_MENU = $('.nav_menu'), // Navigasyon menüsü
    $FOOTER = $('footer'); // Alt bilgi (footer)

// Yan menü işlemleri
$(document).ready(function() {
    // Ana içeriğin yüksekliğini ayarlamak için fonksiyon
    var setContentHeight = function () {
        // Yüksekliği sıfırla
        $RIGHT_COL.css('min-height', $(window).height());

        var bodyHeight = $BODY.outerHeight(), // Gövdenin dış yüksekliği
            footerHeight = $BODY.hasClass('footer_fixed') ? -10 : $FOOTER.height(), // Altbilgi yüksekliği
            leftColHeight = $LEFT_COL.eq(1).height() + $SIDEBAR_FOOTER.height(), // Sol kolon yüksekliği
            contentHeight = bodyHeight < leftColHeight ? leftColHeight : bodyHeight; // İçerik yüksekliği

        // İçeriği normalize et
        contentHeight -= $NAV_MENU.height() + footerHeight;

        $RIGHT_COL.css('min-height', contentHeight); // Sağ kolonun minimum yüksekliğini ayarla
    };

    // Yan menüdeki bağlantı tıklama işlemleri
    $SIDEBAR_MENU.find('a').on('click', function(ev) {
        var $li = $(this).parent(); // Tıklanan bağlantının üst öğesi (li)

        if ($li.is('.active')) {
            $li.removeClass('active active-sm'); // Aktif sınıfını kaldır
            $('ul:first', $li).slideUp(function() { // Alt menüyü kapat
                setContentHeight(); // Yüksekliği tekrar ayarla
            });
        } else {
            // Eğer alt menüde değilsek diğer açık menüleri kapat
            if (!$li.parent().is('.child_menu')) {
                $SIDEBAR_MENU.find('li').removeClass('active active-sm'); // Tüm aktif sınıfları kaldır
                $SIDEBAR_MENU.find('li ul').slideUp(); // Tüm alt menüleri kapat
            }
            
            $li.addClass('active'); // Aktif sınıfını ekle

            $('ul:first', $li).slideDown(function() { // Alt menüyü aç
                setContentHeight(); // Yüksekliği tekrar ayarla
            });
        }
    });

    // Yan menünün geniş/dar modunu değiştirmek için
    $MENU_TOGGLE.on('click', function() {
        if ($BODY.hasClass('nav-md')) {
            $SIDEBAR_MENU.find('li.active ul').hide(); // Aktif menülerin alt elemanlarını gizle
            $SIDEBAR_MENU.find('li.active').addClass('active-sm').removeClass('active'); // Dar moda geçir
        } else {
            $SIDEBAR_MENU.find('li.active-sm ul').show(); // Alt menüleri göster
            $SIDEBAR_MENU.find('li.active-sm').addClass('active').removeClass('active-sm'); // Geniş moda geçir
        }

        $BODY.toggleClass('nav-md nav-sm'); // Genişlik sınıflarını değiştir

        setContentHeight(); // Yüksekliği tekrar ayarla
    });

    // Aktif sayfa bağlantısını kontrol et
    $SIDEBAR_MENU.find('a[href="' + CURRENT_URL + '"]').parent('li').addClass('current-page'); // Mevcut sayfayı işaretle

    $SIDEBAR_MENU.find('a').filter(function () {
        return this.href == CURRENT_URL; // Şu anki URL'yi bul
    }).parent('li').addClass('current-page').parents('ul').slideDown(function() {
        setContentHeight(); // Alt menüyü aç
    }).parent().addClass('active');

    // Yeniden boyutlandırmada içeriği yeniden hesapla
    $(window).smartresize(function(){  
        setContentHeight();
    });

    setContentHeight(); // İlk yüklemede yüksekliği ayarla

    // Sabit yan menü için özel kaydırma çubuğu
    if ($.fn.mCustomScrollbar) {
        $('.menu_fixed').mCustomScrollbar({
            autoHideScrollbar: true, // Otomatik gizlenen kaydırma çubuğu
            theme: 'minimal', // Minimal tema
            mouseWheel: { preventDefault: true } // Mouse tekerleği varsayılanı engelle
        });
    }
});
// /Yan menü

// Kalan kodlarda da aynı tür açıklamalar eklenebilir.
