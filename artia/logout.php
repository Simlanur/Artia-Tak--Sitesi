<?php 
session_start(); //Sessıon başlat

session_destroy(); // çalışan Sessıonu sonlandırır - Oturumu Kapatır.
header("Location:index.php?durum=exit");//Çıkış Yaptıktan sonra yönlendirme yap

 ?>