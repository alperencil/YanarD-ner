<?php
include "../db.php";
include "../function.php";

$jsonCiktisi = array();
$jsonCiktisi["hata"] = FALSE;
$_code = 200;
$_method = $_SERVER["REQUEST_METHOD"];


if($_method == "POST"){
        $puan = $_POST["puan"];
        $puanYapan = $_POST["puanYapanId"];
        $firmaId = $_POST["firmaId"];

        if(empty($puan) || empty($puanYapan) || empty($firmaId)){
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"] = "Parametreler boş gönderilemez";
            $_code = 400;
        }else{
            $varMi = $db->query("SELECT * FROM puanlar WHERE puanYapanId='$puanYapan' AND firmaId='$firmaId'")->rowCount();
            if($varMi != 0){
                $jsonCiktisi["hata"] = TRUE;
                $jsonCiktisi["hataMesaji"] = "Bu kullanıcı daha önceden puanladığı için tekrar puan veremez.";
                $_code = 400;

            }else{
                $ex = $db->prepare("INSERT INTO puanlar SET puan=:puan, puanYapanId=:kid, firmaId=:fid");
                $ekle = $ex->execute(array(
                   "puan"=>$puan,
                   "kid"=>$puanYapan,
                   "fid"=>$firmaId
                ));

                if($ekle){
                    $jsonCiktisi["hata"] = FALSE;
                    $jsonCiktisi["puanlar"] = "Puanınız başarıyla eklendi";
                    $_code = 200;

                }else{
                    $jsonCiktisi["hata"] = TRUE;
                    $jsonCiktisi["hataMesaji"] = "Sistemsel bir hata oluştu .Lütfen daha sonra tekrar deneyiniz.";
                    $_code = 400;
                }
            }
        }


}else if($_method == "GET"){

    $firmaId = $_GET["firmaId"];
    $kullaniciId = $_GET["puanYapanId"];
    $firma = $_GET["firma"];

    if(isset($firmaId)){
            $varMi = $db->query("SELECT * FROM puanlar WHERE  firmaId='$firmaId'")->rowCount();
        if($varMi != 0){
            $getir = $db->query("SELECT AVG(puan) AS ort FROM puanlar WHERE  firmaId='$firmaId'")->fetch(PDO::FETCH_ASSOC);
            $jsonCiktisi["hata"] = FALSE;
            $jsonCiktisi["puanlar"] = $getir;
            $_code = 200;
        }else{
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"] = "Bu firmaya ait puan bulunmuyor.";
            $_code = 400;
        }

    }else if(isset($firma) && isset($kullaniciId)){
        $varMi = $db->query("SELECT *  FROM puanlar WHERE firmaId='$firma' AND puanYapanId='$kullaniciId'")->rowCount();
        if($varMi != 0){
            $getir = $db->query("SELECT * FROM puanlar WHERE  firmaId='$firma' AND puanYapanId='$kullaniciId'")->fetch(PDO::FETCH_ASSOC);
            $jsonCiktisi["hata"] = FALSE;
            $jsonCiktisi["puanlar"] = $getir;
            $_code = 200;
        }else{
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"] = "Üye henüz bu firmayı puanlamamış.";
            $_code = 400;
        }

    }else{

        $jsonCiktisi["hata"] = TRUE;
        $jsonCiktisi["hataMesaji"] = "firmaId boş gönderilemez";
        $_code = 400;
    }


}else{
    $jsonCiktisi["hata"] = TRUE;
    $jsonCiktisi["hataMesaji"] = "Sadece GET ve POST işlemleri yapılabilir.";
    $_code = 400;
}




SetHeader($_code);
$jsonCiktisi[$_code] = HttpStatus($_code);
echo json_encode($jsonCiktisi);

?>