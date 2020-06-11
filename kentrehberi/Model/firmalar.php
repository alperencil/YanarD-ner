<?php
session_start();
include "../db.php";
include "../function.php";


header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');



$jsonCiktisi = array();
$jsonCiktisi["hata"] = FALSE;
$_code = 200;
$_method = $_SERVER["REQUEST_METHOD"];

if($_method == "POST"){
    if(isset($_POST["firmaAdi"]) &&  isset($_POST["adres"]) && isset($_POST["telefon"]) && isset($_POST["firmaId"])){
        $ex = $db->prepare("INSERT INTO firmalar SET firmaAdi=:adi, adres=:adres, telefon=:tel ,firmaId=:id");
        $gelenAd = $_POST["firmaAdi"];
        $gelenAdres = $_POST["adres"];
        $gelenTelefon = $_POST["telefon"];
        $gelenId = $_POST["firmaId"];
        $ekle = $ex->execute(array(
           "adi"=>$gelenAd,
           "adres"=>$gelenAdres,
           "tel"=>$gelenTelefon,
            "id"=>$gelenId
        ));
        if($ekle){
            $jsonCiktisi["hata"] = FALSE;
            $jsonCiktisi["firmalar"] = "Firma Eklendi";
            $_code = 200;
        }else{
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"] = "Sistemsel bir hata oluştu.Lütfen daha sonra deneyiniz.";
            $_code = 400;
        }
    }else{
        $jsonCiktisi["hata"] = TRUE;
        $jsonCiktisi["hataMesaji"] = "Firma bilgilerini boş göndermeyiniz.";
        $_code = 400;
    }

}else if($_method == "PUT"){
    $gelen_veri = json_decode(file_get_contents("php://input"));
    if(empty($gelen_veri->firmaAdi)  || empty($gelen_veri->adres) || empty($gelen_veri->telefon) || empty($gelen_veri->firmaId)){
        $jsonCiktisi["hata"] = TRUE;
        $jsonCiktisi["hataMesaji"] = "Firma güncellenemedi.Firma adı || Firma açıklama || adres || telefon || firmaId bilgilerinden herhangi birisi boş bırakılamaz.";
        $_code = 400;
    }else{
        $gelenId = $gelen_veri->firmaId;
        $varMi = $db->query("SELECT * FROM firmalar WHERE firmaId='$gelenId'")->rowCount();
        if($varMi != 0){
            $ex = $db->prepare("UPDATE firmalar SET firmaAdi=:adi, adres=:adres, telefon=:tel WHERE firmaId=:id");
            $guncelle = $ex->execute(array(
               "id"=>$gelen_veri->firmaId,
               "adi"=>$gelen_veri->firmaAdi,
               "adres"=>$gelen_veri->adres,
               "tel"=>$gelen_veri->telefon
            ));
            if($guncelle){
                $jsonCiktisi["hata"] = FALSE;
                $jsonCiktisi["firmalar"] = "ID numarası :".$gelen_veri->firmaId." olan firma bilgileri başarıyla güncellendi.";
                $_code = 200;
            }else{
                $jsonCiktisi["hata"] = TRUE;
                $jsonCiktisi["hataMesaji"] = "Sistemsel bir hata meydana geldi.Lütfen daha sonra tekrar deneyiniz.";
                $_code = 400;
            }
        }else{
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"] = "Sistemde böyle bir firma bulunmadığı için işlem yapılmadı.";
            $_code = 400;
        }
    }

}else if($_method == "DELETE"){
    if($_GET["firmaId"]){
        $gelenId = $_GET["firmaId"];
        $varMi = $db->query("SELECT * FROM firmalar WHERE firmaId='$gelenId'")->rowCount();
        if ($varMi != 0){
            $sil = $db->query("DELETE FROM firmalar WHERE firmaId='$gelenId'");
            if($sil){
                $jsonCiktisi["hata"] = FALSE;
                $jsonCiktisi["firmalar"] = "Firma id si ".$gelenId." olan firma silindi";
                $_code = 200;
            }else{
                $jsonCiktisi["hata"] = TRUE;
                $jsonCiktisi["hataMesaji"] = "Sistemsel bir hata oluştu.Lütfen daha sonra tekrar deneyiniz.";
                $_code = 400;
            }
        }else{
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"] = "Bu bilgilere sahip bir firma bulunmadığı için işlem yapılmadı.Lütfen firmaId doğru giriniz.";
            $_code = 400;
        }

    }else{
        $jsonCiktisi["hata"] = TRUE;
        $jsonCiktisi["hataMesaji"] = "Firma id girilmediği için işlem yapılmadı.";
        $_code = 400;
    }
}else if($_method == "GET"){

    if(isset($_GET["hepsi"])){
        $varMi = $db->query("SELECT * FROM firmalar")->rowCount();
        if ($varMi != 0){
            $firmalar = $db->query("SELECT * FROM firmalar ")->fetchAll(PDO::FETCH_ASSOC);
            $jsonCiktisi["hata"] = FALSE;
            $jsonCiktisi["firmalar"] = $firmalar;
            $_code = 200;
        }else{
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"] = "Hiç firma bulunmuyor.";
            $_code = 400;
        }
    }else if(isset($_GET["firmaAdi"])){
       $gelenFirmaAdi =  $_GET["firmaAdi"];
        $varMi = $db->query("SELECT * FROM firmalar WHERE firmaAdi like '%$gelenFirmaAdi%'")->rowCount();
       if ($varMi != 0){
           $firmalar = $db->query("SELECT * FROM firmalar WHERE firmaAdi like '%$gelenFirmaAdi%'")->fetchAll(PDO::FETCH_ASSOC);
           $jsonCiktisi["hata"] = FALSE;
           $jsonCiktisi["firmalar"] = $firmalar;
           $_code = 200;
       }else{
           $jsonCiktisi["hata"] = TRUE;
           $jsonCiktisi["hataMesaji"] = "Aradığınız isimde bir firma bulunmuyor.";
           $_code = 400;
       }
    }else if(isset($_GET["firmaId"])){
        $gelenId = $_GET["firmaId"];
        $varMi = $db->query("SELECT * FROM firmalar WHERE firmaId='$gelenId'")->rowCount();
        if($varMi != 0){
            $firmaBilgisi = $db->query("SELECT * FROM firmalar WHERE firmaId='$gelenId'")->fetch(PDO::FETCH_ASSOC);
            $jsonCiktisi["hata"] = FALSE;
            $jsonCiktisi["firmalar"] = $firmaBilgisi;
            $_code = 200;
        }else{
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"] = "Böyle bir firma yok.";
            $_code = 400;
        }
    }
}else{
    $jsonCiktisi["hata"] = TRUE;
    $jsonCiktisi["hataMesaji"] = "Sadece POST , PUT , DELETE veya GET işlemleri yapabilirsiniz.";
    $_code = 400;
}


SetHeader($_code);
$jsonCiktisi[$_code] = HttpStatus($_code);
echo json_encode($jsonCiktisi);

















?>