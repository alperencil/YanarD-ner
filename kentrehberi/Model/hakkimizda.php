<?php

include "../db.php";
include "../function.php";
$jsonCiktisi = array();
$jsonCiktisi["hata"] = FALSE;
$_code = 200;
$_method = $_SERVER["REQUEST_METHOD"];


if($_method == "PUT"){
    $gelen_veri = json_decode(file_get_contents("php://input"));
    $baslik = $gelen_veri->hakkimizdaBaslik;
    $metin = $gelen_veri->hakkimizdaMetin;
    $ex = $db->prepare("UPDATE hakkimizda SET hakkimizdaBaslik=:baslik, hakkimizdaMetin=:metin WHERE id=1");
    $guncelle = $ex->execute(array(
        "baslik"=>$baslik,
        "metin"=>$metin
    ));
    if($guncelle){
        $jsonCiktisi["hata"] = FALSE;
        $jsonCiktisi["hakkimizda"] = "Hakkımızda sayfası güncellendi";
        $_code = 200;

    }else{
        $jsonCiktisi["hata"] = TRUE;
        $jsonCiktisi["hataMesaji"] = "Sistemsel bir sorun oluştu.Lütfen daha sonra tekrar deneyiniz.";
        $_code = 400;
    }


}else if($_method == "GET"){
    $getir =$db->query("SELECT * FROM hakkimizda WHERE id=1")->fetch(PDO::FETCH_ASSOC);
    $jsonCiktisi["hata"] = FALSE;
    $jsonCiktisi["hakkimizda"] = $getir;
    $_code = 200;
}else{
    $jsonCiktisi["hata"] = TRUE;
    $jsonCiktisi["hataMesaji"] = "Sadece Post ve Get Metodları Çalışıyor";
    $_code = 400;
}










SetHeader($_code);
$jsonCiktisi[$_code] = HttpStatus($_code);
echo json_encode($jsonCiktisi);


?>