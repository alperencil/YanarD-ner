<?php
include "../db.php";
include "../function.php";

$jsonCiktisi = array();
$jsonCiktisi["hata"] = FALSE;
$_code = 200;
$_method = $_SERVER["REQUEST_METHOD"];


if($_method == "POST"){
    $gelenTelefon = $_POST["telefon"];
    $gelenMetin = $_POST["metin"];

    if(empty($gelenTelefon) || empty($gelenMetin)){
        $jsonCiktisi["hata"] = TRUE;
        $jsonCiktisi["hataMesaji"] = "Parametreler boş gönderilemez";
        $_code = 400;
    }else{
        $ex = $db->prepare("INSERT INTO firmaistekleri SET telefon=:tel, metin=:metin");
        $ekle = $ex->execute(array(
            "tel"=>$gelenTelefon,
            "metin"=>$gelenMetin
        ));
        if($ekle){
            $jsonCiktisi["hata"] = FALSE;
            $jsonCiktisi["istekler"] = "İstek başarıyla gönderildi";
            $_code = 200;
        }else{
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"] = "Sistemsel bir hata oluştu .Lütfen daha sonra deneyiniz.";
            $_code = 400;
        }
    }

}else if($_method == "GET"){
    $varMi = $db->query("SELECT * FROM firmaistekleri")->rowCount();
    if($varMi != 0){
        $getir = $db->query("SELECT * FROM firmaistekleri")->fetchAll(PDO::FETCH_ASSOC);
        $jsonCiktisi["hata"] = FALSE;
        $jsonCiktisi["istekler"] = $getir;
        $_code = 200;
    }else{
        $jsonCiktisi["hata"] = TRUE;
        $jsonCiktisi["hataMesaji"] = "Firma isteği yok";
        $_code = 400;
    }
}else{
    $jsonCiktisi["hata"] = TRUE;
    $jsonCiktisi["hataMesaji"] = "Sadece POST ve GET istekleri çalışıyor";
    $_code = 400;
}












SetHeader($_code);
$jsonCiktisi[$_code] = HttpStatus($_code);
echo json_encode($jsonCiktisi);

?>