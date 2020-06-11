<?php
include "../db.php";
include "../function.php";

$jsonCiktisi = array();
$jsonCiktisi["hata"] = FALSE;
$_code = 200;
$_method = $_SERVER["REQUEST_METHOD"];


if($_method == "POST"){
    $gelenKullaniciId = $_POST["gelenKullaniciId"];
    $gelenYorum = $_POST["gelenYorum"];
    $gelenFirmaId = $_POST["gelenFirmaId"];

    if(empty($gelenKullaniciId) || empty($gelenYorum) || empty($gelenFirmaId)){
        $jsonCiktisi["hata"] = TRUE;
        $jsonCiktisi["hataMesaji"] = "Yorum parametreleri eksik gönderilemez";
        $_code = 400;
    }else{
        $ex = $db->prepare("INSERT INTO yorumlar SET yorumMetni=:metin, yorumuYazanId=:id, firmaId=:firma");
        $ekle = $ex->execute(array(
           "metin"=>$gelenYorum,
           "id"=>$gelenKullaniciId,
           "firma"=>$gelenFirmaId
        ));
        if($ekle){
            $jsonCiktisi["hata"] = FALSE;
            $jsonCiktisi["yorumlar"] = "Yorumunuz Eklendi :=)";
            $_code = 200;

        }else{
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"] = "Sistemsel bir hata oluştu.Lütfen daha sonra tekrar deneyiniz.";
            $_code = 400;
        }
    }

}else if($_method == "GET"){
    $gelenFirmaId = $_GET["firmaId"];
    if(empty($gelenFirmaId)){
        $jsonCiktisi["hata"] = TRUE;
        $jsonCiktisi["hataMesaji"] = "Firma id kısmı boş gönderilemez.";
        $_code = 400;

    }else{
        $varMi = $db->query("select * from yorumlar INNER JOIN kullanicilar ON yorumlar.yorumuYazanId=kullanicilar.kullaniciId WHERE
yorumlar.firmaId='$gelenFirmaId'")->rowCount();
        if($varMi != 0){
            $yorumlar = $db->query("select * from yorumlar INNER JOIN kullanicilar ON yorumlar.yorumuYazanId=kullanicilar.kullaniciId WHERE
yorumlar.firmaId='$gelenFirmaId'")->fetchAll(PDO::FETCH_ASSOC);
            $jsonCiktisi["hata"] = FALSE;
            $jsonCiktisi["yorumlar"] = $yorumlar;
            $_code = 200;

        }else{
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"] = "Mağazaya ait yorum bulunmuyor.";
            $_code = 400;
        }


    }

}else{
    $jsonCiktisi["hata"] = TRUE;
    $jsonCiktisi["hataMesaji"] = "Sadece POST ve GET metodları aktif.";
    $_code = 400;
}
SetHeader($_code);
$jsonCiktisi[$_code] = HttpStatus($_code);
echo json_encode($jsonCiktisi);






?>