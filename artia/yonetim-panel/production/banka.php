<?php include"header.php";

$bankasor=$db->prepare("SELECT * FROM tblbanka  ");// banka tablosundaki verileri çekmek için sorgumuzu elde ettik
$bankasor->execute();// sorgumuzu execute yaparak çalıştırdık




?>

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Banka İşlemleri <small>


        </small></h3>
      </div>



      <div class="row">
       <div class=" col-xs-12">
        <div class="x_panel">

          <a href="banka-ekle.php">  <button type="button" class="btn btn-primary btn-sm"> YENİ BANKA EKLE</button></a>
          <div class="clearfix"></div>

          <div class="x_content" ">

            <table class="table table-bordered" style="text-align: center;" >
              <thead >
                <tr>
                
                  <th>Banka Adı</th>
                  <th>Banka İban</th>
                  <th>Ad Soyad</th>
                  <th>Banka Durum</th>

                  <th>Duzenle</th>
                  <th>Sil</th>

                </tr>
              </thead>
              <tbody>
                <?php while ($bankacek=$bankasor->fetch(PDO::FETCH_ASSOC)) {?><!--Elde ettiğimiz sonuçları While Döngüsüne alarak fetch metodu ile ekrana yazdırdık Fetch ASSOC ile diziyi döndürdük-->

                <tr>
                  <td><?php echo $bankacek['banka_ad'] ?></td><!--Sutunları çektik-->
                  <td><?php echo $bankacek['banka_iban'] ?></td>
                   <td><?php echo $bankacek['banka_hesap_adsoyad'] ?></td>
                  

                  <td><?php if($bankacek['banka_durum'] == 1)
                  {?>
                   <button type="button " class="btn btn-success btn-xs">Aktif</button>
                   <?php  }
                   else{ ?>
                     <button type="button " class="btn btn-danger btn-xs">Pasif</button>
                     <?php }
                     ?>
                   </td>


                   <td><center><a href="banka-duzenle.php?banka_id=<?php echo $bankacek['banka_id']?>"><button class="btn btn-success btn-xs">DÜZENLE</button></center></a></td>
                   <td><center><a href="../islemler.php?banka_id=<?php echo $bankacek['banka_id']; ?>&bankasil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
                 </tr>

                 <?php } 

                 ?>
               </tbody>
             </table>

           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
</div>
</div>





<?php include"footer.php" ?>