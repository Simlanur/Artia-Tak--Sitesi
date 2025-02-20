


<div class="container">
	<div class="row">
		<div class="col-sm-3">
			<div class="left-sidebar">
				<h2 class="title"> Kategoriler </h2>
				

				<div class="categorybox">

					<ul>
						<li>

							<?php 

//bütün kayıtları bir kereye mahsus olmak üzere listeliyoruz; daha doğrusu, bir diziye aktarmak için verileri çekiyoruz

							$query = "SELECT * FROM tblkategori order by kategori_id";
							$goster = $db->prepare($query);
$goster->execute(); //queriyi tetikliyor

 $toplamSatirSayisi = $goster->rowCount(); // üzere sorgudan dönen satır sayısını öğreniyoruz
 
$tumSonuclar = $goster->fetchAll(); //DB'deki bütün satırları ve sutunları $tumSonuclar değişkenine dizi şeklinde aktarıyoruz


//alt kategorisi olmayan kategoriin sayısını öğreniyoruz:
$altKategoriSayisi = 0;
for ($i = 0; $i < $toplamSatirSayisi; $i++) {
	if ($tumSonuclar[$i]['kategori_ust'] == "0") {
		$altKategoriSayisi++;
	}
}



for ($i = 0; $i < $toplamSatirSayisi; $i++) {
	if ($tumSonuclar[$i]['kategori_ust'] == "0") {
		kategori($tumSonuclar[$i]['kategori_id'], $tumSonuclar[$i]['kategori_adi'], $tumSonuclar[$i]['kategori_ust']);
	}
}



function kategori($kategori_id, $kategori_adi, $kategori_ust) {

	global $tumSonuclar;
	global $toplamSatirSayisi;

    //kategorinin, alt kategori sayısını öğreniyoruz:
	$altKategoriSayisi = 0;
	for ($i = 0; $i < $toplamSatirSayisi; $i++) {
		if ($tumSonuclar[$i]['kategori_ust'] == $kategori_id) {
			$altKategoriSayisi++;
		}
	}
    ///////////////////////////////////////////

	?>

	<!-- Burda Başlıyoruz ana gövde -->

	<li>

		<a href="kategori-<?=seo($kategori_adi) ?>"><?php echo $kategori_adi ?></a>
		<?php 
		if ($altKategoriSayisi > 0) {
			echo "( $altKategoriSayisi )";
		}
		?>
	</a>

	<?php

    if ($altKategoriSayisi > 0) { //alt kategorisi varsa onları da listele
    	echo "<ul>";

    	for ($i = 0; $i < $toplamSatirSayisi; $i++) {

    		if ($tumSonuclar[$i]['kategori_ust'] == $kategori_id) {
    			
    			kategori($tumSonuclar[$i]['kategori_id'], $tumSonuclar[$i]['kategori_adi'], $tumSonuclar[$i]['kategori_ust']);
    		}
    	}

    	echo "</ul>";
    }
    ?>



</li> 
<!-- Burda Başlıyoruz ana gövde -->

<?php 
}
?>
<li><a href="urunler.php">Tüm Ürünler</a></li>

</ul>
</div>

</div>
</div>
</div>

