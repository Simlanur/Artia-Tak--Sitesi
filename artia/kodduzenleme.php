$urunsor=$db->prepare("SELECT * FROM tblurun where urun_id=:rid");
$urunsor->execute(array(
'rid'=>$urun_id


));
$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);