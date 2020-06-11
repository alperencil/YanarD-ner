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
    #Post isteği geldiyse.
    $gelenMail = $_POST["adminMail"];
    $gelenPass = $_POST["adminPass"];

    if(empty($gelenMail) || empty($gelenPass)){
        $jsonCiktisi["hata"] = TRUE;
        $jsonCiktisi["hataMesaji"] = "adminMail ya da adminPass parametreleri boş bırakılamaz";
        $_code = 400;
    }else{
        $varMi = $db->query("SELECT * FROM admin WHERE adminMail='$gelenMail'")->rowCount();
        if($varMi != 0){
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"] ="Bu maile kayıtlı bir admin zaten var , lütfen başka bir mail adresiyle kayıt yapmayı deneyiniz.";
            $_code = 400;
        }else{
            $ex = $db->prepare("INSERT INTO admin  SET adminMail=:mail, adminPass=:pass");
            $ekle = $ex->execute(array(
                "mail"=>$gelenMail,
                "pass"=>$gelenPass
            ));
            if($ekle){
              $jsonCiktisi["hata"] = FALSE;
              $jsonCiktisi["adminler"] = "Yeni admin bilgileri sisteme başarıyle eklendi.";
              $_code = 200;
            }else{
                $jsonCiktisi["hata"] = TRUE;
                $jsonCiktisi["hataMesaji"] = "Ekleme işlemi yapılamadı , sistemsel bir hata meydana geldi.Lütfen daha sonra tekrar deneyiniz.";
                $_code = 400;
            }
        }
    }
}else if($_method == "PUT"){
    #Put isteği geldiyse.
    $gelenVeri = json_decode(file_get_contents("php://input"));
    if(empty($gelenVeri->adminMail) || empty($gelenVeri->adminId) || empty($gelenVeri->adminPass)){
        //Gelen parametrelerden herhangi birisi boş ise hata verilsin ve kullanıcı bilgilendirilsin.
        $jsonCiktisi["hata"] = TRUE;
        $jsonCiktisi["hataMesaji"] = "Güncelleme işlemi yapılamadı.Gönderilen parametrelerin hepsi dolu olmalıdır.";
        $_code = 400;
    }else{
        $sayi = $db->query("SELECT * FROM admin WHERE adminId='$gelenVeri->adminId'")->rowCount();
        if($sayi != 0){
            $ex = $db->prepare("UPDATE admin SET adminMail=:mail, adminPass=:pass WHERE adminId=:id");
            $guncelle =$ex->execute(array(
               "id"=>$gelenVeri->adminId,
               "mail"=>$gelenVeri->adminMail,
               "pass"=>$gelenVeri->adminPass
            ));
            if($guncelle){
                #Güncelleme işlemi olduysa.
                $jsonCiktisi["hata"] = FALSE;
                $jsonCiktisi["adminler"] = "ID numarası :".$gelenVeri->adminId." olan admin bilgileri başarıyla güncellendi.";
                $_code = 200;

            }else{
                #Güncelleme işlemi başarılı olmadıysa hata verilsin.
                $jsonCiktisi["hata"] = TRUE;
                $jsonCiktisi["hataMesaji"] = "Sistemsel bir hata meydana geldi.Admin bilgileri güncellenemedi.Lütfen daha sonra tekrar deneyiniz.";
                $_code = 400;
            }
        }else{
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"] = "Girdiğiniz adminIdye ait bir admin sistemde bulunamamıştır.Bu nedenle herhangi bir adminin bilgileri güncellenememiştir.";
            $_code = 400;
        }
    }
}else if($_method == "DELETE"){
    #Delete isteği geldiyse.
    $gelenId = trim($_GET["adminId"]);
    if(empty($_GET["adminId"])){
        $jsonCiktisi["hata"] = TRUE;
        $jsonCiktisi["hataMesaji"] = "adminId parametresi boş gönderilemez";
        $_code = 400;

    }else{
        $varMi = $db->query("SELECT * FROM admin WHERE adminId='$gelenId'")->rowCount();
        if($varMi != 0){
            $sil = $db->query("DELETE FROM admin WHERE adminId='$gelenId'");
            if($sil){
                $jsonCiktisi["hata"] = FALSE;
                $jsonCiktisi["adminler"] = "adminId :".$gelenId." nolu olan admin sistemden silindi.";
                $_code = 200;
            }else{
                $jsonCiktisi["hata"] = TRUE;
                $jsonCiktisi["hataMesaji"] = "Sistemsel bir arıza meydana geldi .Lütfen daha sonra tekrar deneyiniz.";
                $_code = 400;

            }

        }else{
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"] = "Girinlen adminId de bir admin bulunmuyor.Hiç admin silinmedi";
            $_code = 400;
        }
    }
}else if($_method == "GET"){
    #Get isteği geldiyse.
    if(isset($_GET["adminId"])){
        $gelenId = $_GET["adminId"];
        if(empty($gelenId)){
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"] = "adminId parametresi boş gönderilemez";
            $_code = 400;
        }else{
            $varMi = $db->query("SELECT * FROM admin WHERE adminId='$gelenId'")->rowCount();
            if($varMi != 0){
                $admin = $db->query("SELECT * FROM admin WHERE adminId='$gelenId'")->fetch(PDO::FETCH_ASSOC);
                $jsonCiktisi["hata"] = FALSE;
                $jsonCiktisi["adminler"] = $admin;
                $_code = 200;
            }else{
                $jsonCiktisi["hata"] = TRUE;
                $jsonCiktisi["hataMesaji"] = "Gönderdiğiniz id ye sahip bir admin bulunamadı.";
                $_code = 400;
            }
        }
    }else if(isset($_GET["adminmail"]) && isset($_GET["adminpass"])){
        $gelenAdminMail = $_GET["adminmail"];
        $gelenAdminPass = $_GET["adminpass"];
        $varMi = $db->query("SELECT * FROM admin WHERE adminMail='$gelenAdminMail' AND adminPass='$gelenAdminPass'")->rowCount();
        if($varMi != 0){
            $_SESSION["adminmail"] = $gelenAdminMail;
            $jsonCiktisi["hata"] = FALSE;
            $jsonCiktisi["session"] = $_SESSION["adminmail"];
            $_code = 200;
        }else{
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"] = "Sistemde böyle bir admin bulunamadı.";
            $_code = 400;
        }
    }


    else{
        $sayi = $db->query("SELECT * FROM admin")->rowCount();
        if($sayi != 0){
            $adminler = $db->query("SELECT * FROM admin")->fetchAll(PDO::FETCH_ASSOC);
            $jsonCiktisi["hata"] = FALSE;
            $jsonCiktisi["adminler"] = $adminler;
        }else{
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"] = "Hiç admin bulunmuyor";
            $_code = 200;
        }
    }
}else{
    $jsonCiktisi["hata"] = TRUE;
    $jsonCiktisi["hataMesaji"] = "Lütfen POST , PUT , DELETE veya GET isteklerinden birini yapınız";
    $_code = 400;

}

SetHeader($_code);
$jsonCiktisi[$_code] = HttpStatus($_code);
echo  json_encode($jsonCiktisi);













?>