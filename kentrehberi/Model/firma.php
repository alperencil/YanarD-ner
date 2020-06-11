<?php
include "../db.php";
include "../function.php";
session_start();
$jsonCiktisi = array();
$_code = 200;
$_method = $_SERVER["REQUEST_METHOD"];
$jsonCiktisi["hata"] = FALSE;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');


if($_method == "POST"){
    $Mail = $_POST["isletmeMail"];
    $Pass = $_POST["isletmePass"];
    #Post isteği gelmişse
    if(($Mail == "") || ($Pass == "")){
        #Parametreler boş gönderilmişse
        $jsonCiktisi["hata"] = TRUE;
        $jsonCiktisi["hataMesaji"] = "İşletme maili veya işletme şifresi boş bırakılamaz.";
        $_code = 400;

    }else{
        $ex = $db->prepare("INSERT INTO isletmeGiris SET isletmeMail=:mail, isletmePass=:pass");
        $ekle = $ex->execute(array(
           "mail"=>$_POST["isletmeMail"],
           "pass"=>$_POST["isletmePass"]
        ));
        if($ekle){
            $jsonCiktisi["hata"] = FALSE;
            $jsonCiktisi["isletme"] = "Yeni firma başarıyla eklendi.";
            $_code = 200;
        }else{
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"]= "Sistemsel bir hata meydana geldi, ekleme işlemi yapılamadı.Lütfen daha sonra tekrar deneyiniz.";
            $_code = 400;
        }
    }

}else if($_method == "PUT"){
    #Put isteği gelmişse
    $gelenVeri = json_decode(file_get_contents("php://input"));
    if(empty($gelenVeri->isletmeId) || empty($gelenVeri->isletmeMail) || empty($gelenVeri->isletmePass)){
        $jsonCiktisi["hata"] = TRUE;
        $jsonCiktisi["hataMesaji"] = "Firma güncellenemedi , parametreler boş gönderilemez";
        $_code = 400;
    }else if(isset($_GET["isletmeId"]) && isset($_GET["isletmeMail"]) && isset($_GET["isletmePass"])){
        $id = $_GET["isletmeId"];
        $mail = $_GET["isletmeMail"];
        $pass = $_GET["isletmePass"];
        $varMi = $db->query("SELECT * FROM isletmeGiris WHERE isletmeId='$id'")->rowCount();
        if($varMi != 0){
            $ex = $db->prepare("UPDATE isletmeGiris SET isletmeMail=:mail, isletmePass=:pass WHERE isletmeId=:id");
            $guncelle = $ex->execute(array(
               "mail"=>$mail,
                "pass"=>$pass,
                "id"=>$id
            ));
            if($guncelle){
                $jsonCiktisi["hata"] = FALSE;
                $jsonCiktisi["isletme"] = "Veriler güncellendi";
                $_code = 200;
            }else{
                $jsonCiktisi["hata"] = TRUE;
                $jsonCiktisi["hataMesaji"] = "Sistemsel bir hata oluştu .Lütfen daha sonra tekrar deneyiniz.";
                $_code = 400;
            }

        }else{
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"] = "Böyle bir firma sahibi bulunmadığı için işlem yapılamadı";
            $_code = 400;
        }



    }else{
        $varMi = $db->query("SELECT * FROM isletmeGiris WHERE isletmeId='$gelenVeri->isletmeId'")->rowCount();
        if($varMi != 0){
            $ex = $db->prepare("UPDATE isletmeGiris SET isletmeMail=:mail, isletmePass=:pass WHERE isletmeId=:id");
            $guncelle = $ex->execute(array(
               "id"=>$gelenVeri->isletmeId,
               "mail"=>$gelenVeri->isletmeMail,
               "pass"=>$gelenVeri->isletmePass
            ));
                if($guncelle){
                    $jsonCiktisi["hata"] = FALSE;
                    $jsonCiktisi["isletme"] = "ID numarası :".$gelenVeri->isletmeId." olan firma başarıyla güncellendi.";
                    $_code = 200;
                }else{
                    $jsonCiktisi["hata"] = TRUE;
                    $jsonCiktisi["hataMesaji"] = "Sistemsel bir hata meydana geldi , güncelleme işlemi yapılamadı.Lütfen daha sonra tekrar deneyiniz.";
                    $_code = 400;
                }
        }else{
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"] = "Bu id ye sahip bir isletme bulunamadı.O nedenle güncelleme işlemi yapılmadı herhangi bir firma üzerinde";
            $_code = 400;
        }
    }
}else if($_method == "DELETE"){
    #Delete isteği gelmişse
    $gelenId = $_GET["isletmeId"];
    if(empty($gelenId)){
        $jsonCiktisi["hata"] = TRUE;
        $jsonCiktisi["hataMesaji"] = "Silmek istediğiniz firmanın isletmeId bilgisini girmelisiniz.";
        $_code = 400;
    }else{
        $varMi = $db->query("SELECT * FROM isletmeGiris WHERE isletmeId='$gelenId'")->rowCount();
        if($varMi != 0){
            $sil = $db->query("DELETE FROM isletmeGiris WHERE isletmeId='$gelenId'");
            if($sil){
                $jsonCiktisi["hata"] = FALSE;
                $jsonCiktisi["isletme"] = "ID nosu :".$gelenId." olan işletme sistemden başarıyla silindi";
                $_code = 200;
            }else{
                $jsonCiktisi["hata"] = TRUE;
                $jsonCiktisi["hataMesaji"] = "Sistemsel bir hata meydana geldi.Lütfen daha sonra tekrar deneyiniz.";
                $_code = 400;
            }

        }else{
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"] = "Bu idye sahip firma bulunamadığı için herhangi bir firma silinemedi.";
            $_code = 400;
        }
    }
}else if($_method == "GET"){
    #Get isteği gelmişse
    if(isset($_GET["isletmeId"])){
        $gelenId = $_GET["isletmeId"];
        $varMi = $db->query("SELECT * FROM isletmeGiris WHERE isletmeId='$gelenId'")->rowCount();
        if($varMi != 0){
            $getir = $db->query("SELECT * FROM isletmeGiris WHERE isletmeId='$gelenId'")->fetch(PDO::FETCH_ASSOC);
            $jsonCiktisi["hata"] = FALSE;
            $jsonCiktisi["firma"] = $getir;
            $_code = 200;
        }else{
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"] = "Aradığınız firma bulunamadı.";
            $_code = 400;
        }
    }else if(isset($_GET["gelenFirmaMail"])){
        $mailAdresi = $_GET["gelenFirmaMail"];
        $varMi = $db->query("SELECT * FROM isletmeGiris WHERE isletmeMail='$mailAdresi'")->rowCount();
        if($varMi != 0){
            $gelenFirma = $db->query("SELECT * FROM isletmeGiris WHERE isletmeMail='$mailAdresi'")->fetch(PDO::FETCH_ASSOC);
            $jsonCiktisi["hata"] = FALSE;
            $jsonCiktisi["firma"] = $gelenFirma;
            $_code = 200;
        }else{
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"] = "Sistemde böyle bir isletme mail adresi bulunmuyor.";
            $_code = 400;
        }
    }
    else if(isset($_GET["firmamail"]) && isset($_GET["firmasifre"])){
        $isletmeMail = $_GET["firmamail"];
        $isletmePass = $_GET["firmasifre"];
        $varMi = $db->query("SELECT * FROM isletmeGiris WHERE isletmeMail='$isletmeMail' AND isletmePass='$isletmePass'")->rowCount();
        if($varMi != 0){
            $getir = $db->query("SELECT * FROM isletmeGiris WHERE isletmeMail='$isletmeMail' AND isletmePass='$isletmePass'")->fetch(PDO::FETCH_ASSOC);
            $_SESSION["firmaId"] = $getir["isletmeId"];
            $_SESSION["firmamail"] = $isletmeMail;
            $jsonCiktisi["hata"] = FALSE;
            $jsonCiktisi["session"] = $_SESSION["firmamail"];
            $_code = 200;
        }else{
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"] = "Firma maili yada şifresi hatalı.Sisteme giriş yapılamadı.";
            $_code = 400;
        }
    }
    else if(isset($_GET["firmalarim"])){
        #Tüm firmaları getir.
        $varMi = $db->query("SELECT * FROM isletmeGiris ")->rowCount();
        if($varMi != 0){
            $getir = $db->query("SELECT * FROM  isletmeGiris ")->fetchAll(PDO::FETCH_ASSOC);
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["firma"] = $getir;
            $_code = 200;
        }else{
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"] = "Hiç firma bulunmuyor.";
            $_code = 400;
        }
    }else{
        $jsonCiktisi["hata"] = TRUE;
        $jsonCiktisi["hataMesaji"] = "Yapacağınız işlem bilinemedi.";
        $_code = 400;
    }
    
}else{
    $jsonCiktisi["hata"] = TRUE;
    $jsonCiktisi["hataMesaji"] = "Sadece POST , PUT , DELETE veya GET istekleri çalışmaktadır. ";
    $_code = 400;
}


SetHeader($_code);
$jsonCiktisi[$_code] = HttpStatus($_code);
echo  json_encode($jsonCiktisi);











?>