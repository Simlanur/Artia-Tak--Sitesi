<?php include"header.php";

$urunsor=$db->prepare("SELECT* FROM tblurunler where urun_seourl=:seourl");
$urunsor->execute(array(

	'seourl'=>$_GET['sef']

));

$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);

?>
<section>
	<div class="container">
		<div class="row">
			
			
			<div class="col-sm-12 ">
				<div class="product-details"><!--product-details-->
					<div class="col-sm-5">
						
						<?php 
						$urun_id=$uruncek['urun_id'];
						$urunfotosor=$db->prepare("SELECT* FROM tblurun_resim where urun_id=:id LIMIT 1");
						$urunfotosor->execute(array(

							'id'=>$urun_id

						));
						$urunfotocek=$urunfotosor->fetch(PDO::FETCH_ASSOC);



						?>
							<center><img src="images/urun/<?php echo $urunfotocek['urunfoto_resimyol']; ?>"></center>


					</div>
					<div class="col-sm-7">
						<div class="product-information"><!--/product-information-->
							<div class="row" style="margin-bottom:15px;">
								<div class="col-sm-6"><b>Ürün Kodu:</b></div>
								<div class="col-sm-6"><?php echo $uruncek['urun_id']?></div>
							</div>
							<div class="row" style="margin-bottom:15px;">
								<div class="col-sm-6"><b>Ürün Adı:</b></div>
								<div class="col-sm-6"><?php echo $uruncek['urun_seourl']?></div>
							</div>
							
							<div class="row" style="margin-bottom:15px;">
								<div class="col-sm-6"><b>Stok:</b></div>
								<div class="col-sm-6"><?php 
								if ($uruncek['urun_stok']>=1) {

									echo"Stokta Var  ";
								}else
								{

									echo "Stokta Kalmadı";
								}



								?></div>
							</div>
							
							<div class="row" style="margin-bottom:15px;">
								<div class="col-sm-6"><b>Ürün Fiyat:</b></div>
								<div class="col-sm-6">₺<?php echo $uruncek['urun_fiyat']?></div>
							</div>
							
							<form action="yonetim-panel/islemler.php" method="POST">
								<input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>">

								<input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'] ?>">
								
								<div class="row" style="margin-bottom:15px;">
									<div class="col-sm-6"><b>Adet Giriniz:</b></div>
									<div class="col-sm-3">
										<input type="text" class="form-control input-sm" value="1" name="urun_adet">
									</div>
									<div class="col-sm-3"></div>
									
								</div>
								<?php if (!isset($_SESSION['userkullanici_mail'])) {?>

									<div class="row" style="margin-bottom:15px;">
										<div class="col-sm-6">Sepete Ürün Eklemek İçin Lütfen <a href="login">GİRİŞ YAPIN</a> </div>
										<div class="col-sm-6"></div>
									</div>
									

								<?php } else{?>
									<div class="row" style="margin-bottom:15px;">
										<div class="col-sm-6"><input type="submit" name="sepeteekle" class="btn btn-danger " value="SEPETE EKLE"></div>
										<div class="col-sm-6"></div>
									</div>
								<?php }



								?>


							</form>

						</div><!--/product-information-->
					</div>
				</div><!--/product-details-->
				<div class="category-tab shop-details-tab"><!--category-tab-->
					<div class="col-sm-12">
						<ul class="nav nav-tabs">
							<li><a href="#details" data-toggle="tab">Detay</a></li>
							<?php 
							$kullanici_id=$kullanicicek['kullanici_id'];
							$urun_id=$uruncek['urun_id'];
										$yorumsor=$db->prepare("SELECT * FROM tblyorum where kullanici_id=:id and urun_id=:urun_id and yorum_onay=:onay");// prepare ile sorguyu hazırlıyoruz
										$yorumsor->execute(array(
											'id' => $kullanici_id,
											'urun_id' => $urun_id,
											'onay' => 1 
										));?>

										<li class="active"><a href="#reviews" data-toggle="tab">Yorumlar (<?php echo $yorumsor->rowCount();?>)</a></li>
									</ul>
								</div>
								<div class="tab-content">
									<div class="tab-pane fade" id="details" >
										<h3>Açıklama</h3>

										<p><?php echo $uruncek['urun_detay']; ?></p>

									</div>





									<div class="tab-pane fade active in" id="reviews" >
										<div class="col-sm-12">

											<?php 
										// gelen get değerini diziye alarak çekiyoruz.

											while ($yorumcek=$yorumsor->fetch(PDO::FETCH_ASSOC)) {

												$ykullanici_id=$yorumcek['kullanici_id'];
                                             	$ykullanicisor=$db->prepare("SELECT * FROM tbluyeler where kullanici_id=:id");// prepare ile sorguyu hazırlıyoruz
                                             	$ykullanicisor->execute(array(
                                                   'id' => $kullanici_id ));// gelen get değerini diziye alarak çekiyoruz.

                                                  $ykullanicicek=$ykullanicisor->fetch(PDO::FETCH_ASSOC);// fetch methodu ile ekrana yazdırıyoruz fetch_assoc ile diziyi döndürüyoruz.




                                                  ?>

                                                  <ul>
                                                  	<li><a><i class="fa fa-user"></i><?php echo $ykullanicicek['kullanici_adsoyad']; ?></a></li>
                                                  	<li><a><i class="fa fa-calendar"></i><?php echo $yorumcek['yorum_zaman'] ?></a></li>


                                                  </ul>

                                                  <p><b>Yorum :</b><?php echo $yorumcek['yorum_detay'] ?></p>

                                                  <hr>



                                              <?php }



                                              ?>




                                              <p><b>Yorum Yapın </b></p>

                                              <?php if (isset($_SESSION['userkullanici_mail'])) {?>

                                              	<form action="yonetim-panel/islemler.php" method="POST">

                                              		<textarea name="yorum_detay" class="form-control" placeholder="Lütfen yorumunuzu buraya yazınız..." id="text"></textarea>


                                              		<input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>">

                                              		<input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'] ?>">

                                              		<input type="hidden" name="gelen_url" value="<?php 
                                              		echo "http://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI'].""; 

                                              		?>">
                                              		<button type="submit" name="yorumkaydet" class="btn btn-default pull-right">Yorumu Gönder</button>

                                              	</form>
                                              <?php }

                                              else{?>

                                              	<p>Yorum Yapabilmek için<a href='login.php'> Giriş</a> Yapmalısınız"</p>

                                              <?php }





                                              ?>


                                          </div>
                                      </div>

                                  </div>










                              </div>
                          </div>

                      </div>
                  </section>

                  <?php include"footer.php"; ?>