<?php
#Kullanıcı Modeli Ekleme-Silme-Güncelleme-Getirme
#Rest Api
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
    //Kullanıcı ekleme kısmı
    $gelenKullaniciAdi = trim(addslashes($_POST["kullaniciadi"]));
    $gelenKullaniciSifre = trim(addslashes($_POST["kullanicisifre"]));

    $sayi = $db->query("SELECT * FROM kullanicilar WHERE kullaniciAdi='$gelenKullaniciAdi'")->rowCount();


    if(empty($gelenKullaniciAdi) || empty($gelenKullaniciSifre)){
        //Gelen post değerlerinden birisi bile boş gönderilmiş ise hata versin .
        $jsonCiktisi["hata"] = TRUE;
        $jsonCiktisi["hataMesaji"] = "Kullanıcı adı veya şifre kısmı boş bırakılamaz";
        $_code = 400;
    }else if($sayi != 0){
        //Kayıt edilmek istenen kullanıcıadi eğer daha önceden alınmış ise hata verilsin ve uyarılsın.
        $jsonCiktisi["hata"] =TRUE;
        $jsonCiktisi["hataMesaji"]="Kullanıcı adı daha önceden alınmış , lütfen farklı bir kullanıcı adı yazınız";
        $_code = 400;
    }else{
        $ex = $db->prepare("INSERT INTO kullanicilar SET kullaniciAdi=:kadi, kullaniciSifre=:sifre");
        $ekle = $ex->execute(array(
           "kadi"=>$gelenKullaniciAdi,
            "sifre"=>$gelenKullaniciSifre
        ));

        if($ekle){
            $jsonCiktisi["hata"] = FALSE;
            $jsonCiktisi["uyeler"] = "Yeni üye sisteme eklendi , artık kullanıcı adı ve şifreniz ile sisteme giriş yapabilirsiniz";
            $_code = 200;
        }else{
            $jsonCiktisi["hata"] = FALSE;
            $jsonCiktisi["hataMesaji"] = "Üye sisteme eklenemedi , sistemle ilgili bir problem oluştu.Lütfen daha sonra deneyiniz.";
            $_code = 400;
        }
    }



}else if($_method == "PUT"){
    //Kullanıcı güncelleme kısmı

    //gelen verileri alıp json formatından dizi formatına dönüştürdük.
    $gelenVeri = json_decode(file_get_contents("php://input"));
    if(isset($gelenVeri->kullaniciId) && isset($gelenVeri->kullaniciAdi) && isset($gelenVeri->kullaniciSifre)){
        //Gerekli parametrelerin gönderilip gönderilmediği kontrol edildi.
            $varMi = $db->query("SELECT * FROM kullanicilar WHERE kullaniciId='$gelenVeri->kullaniciId'")->rowCount();
            if($varMi != 0){
                $ex = $db->prepare("UPDATE kullanicilar SET kullaniciAdi=:kadi, kullaniciSifre=:sifre WHERE kullaniciId=:id");
                $guncelle = $ex->execute(array(
                    "id"=>$gelenVeri->kullaniciId,
                    "kadi"=>$gelenVeri->kullaniciAdi,
                    "sifre"=>$gelenVeri->kullaniciSifre
                ));
                if($guncelle){
                    $jsonCiktisi["hata"] = FALSE;
                    $jsonCiktisi["uyeler"] = "ID numarası :".$gelenVeri->kullaniciId." olan kullanıcı bilgileri güncellendi.";
                    $_code = 200;
                }else{
                    $jsonCiktisi["hata"] = TRUE;
                    $jsonCiktisi["hataMesaji"] = "Güncelleme yapılamadı , sistemsel bir hata oluştu.Lüften daha sonra tekrar deneyiniz.";
                    $_code = 400;
                }


            }else{
                $jsonCiktisi["hata"]= TRUE;
                $jsonCiktisi["hataMesaji"] = "Güncellemek istediğiniz üyeye ait kullanıcı ID si doğru girilemediği için işlem yapılamadı";
                $_code = 400;
            }



    }else{
        $jsonCiktisi["hata"] = TRUE;
        $jsonCiktisi["hataMesaji"] = "Sisteme eksik parametre gönderildi.Gönderilmesi gereken parametreler  : kullaniciId ,kullaniciAdi, kullaniciSifre";
        $_code = 400;
    }

}else if($_method == "DELETE"){
    //Kullanıcı silme kısmı
    $gelenId = $_GET["kullaniciId"];
    if($_GET["kullaniciId"] && !empty(trim($_GET["kullaniciId"]))){
        $sayi = $db->query("SELECT *  FROM kullanicilar WHERE kullaniciId='$gelenId'")->rowCount();
        if($sayi){
            $sil = $db->query("DELETE FROM kullanicilar WHERE kullaniciId='$gelenId'");
            if($sil){
                    $jsonCiktisi["hata"] = FALSE;
                    $jsonCiktisi["uyeler"] = "Id numarası :".$gelenId." olan kullanıcı sistemden başarıyla silindi";
                    $_code = 200;
            }else{
                $jsonCiktisi["hata"] = TRUE;
                $jsonCiktisi["hataMesaji"] = "Sistemsel bir arıza oluştu , lütfen daha sonra deneyiniz.";
                $_code = 400;
            }
        }else{
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"] = "Sistemde bu idye sahip bir kullanıcı bulunamadığı için kullanıcılardan herhangi birisi silinmedi";
            $_code = 400;
        }
    }else{
        $jsonCiktisi["hata"] = TRUE;
        $jsonCiktisi["hataMesaji"] = "Kullanıcı silinemedi , kullanıcıId bilgisi göndermeniz gerekiyor.";
        $_code = 400;
    }


}else if($_method == "GET"){
    //Kullanıcı bilgilerini getirme kısmı
    //Eğer get paremetresiyle kullaniciadi gelirse aranan kullanıcı var mı diye kontrol edilir.
    //Parametre gelmez ise tüm kullanıcılar listelenir.

    if(isset($_GET["kullaniciadi"])){

        $gelenKullaniciAdi = $_GET["kullaniciadi"];
        $userRowCount = $db->query("SELECT * FROM kullanicilar WHERE kullaniciAdi='$gelenKullaniciAdi'")->rowCount();
        if($userRowCount){
            $uyeler = $db->query("SELECT * FROM kullanicilar WHERE kullaniciAdi='$gelenKullaniciAdi'")->fetch(PDO::FETCH_ASSOC);
            $jsonCiktisi["uyeler"] = $uyeler;
            $_code =200;
        }else{
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"] ="Uye bilgisi bulunamadı";
            $_code = 400;

        }
    }else if(isset($_GET["kullaniciId"])){
        $kullaniciId = $_GET["kullaniciId"];

        $varMi = $db->query("SELECT * FROM kullanicilar WHERE kullaniciId='$kullaniciId'")->rowCount();
        if($varMi != 0){
            $kullanici = $db->query("SELECT * FROM kullanicilar WHERE kullaniciId='$kullaniciId'")->fetch(PDO::FETCH_ASSOC);
            $jsonCiktisi["hata"] = FALSE;
            $jsonCiktisi["uyeler"] = $kullanici;
            $_code = 200;
        }else{
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"] = "Sistemde bu id ye sahip bir kullanıcı bulunmuyor.";
            $_code = 400;
        }
    }
    else if(isset($_GET["kadi"]) && isset($_GET["kullanicisifre"])){
        $kullaniciAdi = $_GET["kadi"];
        $kullaniciSifre = $_GET["kullanicisifre"];
        $varMi = $db->query("SELECT * FROM kullanicilar WHERE kullaniciAdi='$kullaniciAdi' AND kullaniciSifre='$kullaniciSifre'")->rowCount();
        if($varMi != 0){
            $kullanicim = $db->query("SELECT * FROM kullanicilar WHERE kullaniciAdi='$kullaniciAdi' AND kullaniciSifre='$kullaniciSifre'")->fetch(PDO::FETCH_ASSOC);

            $_SESSION["kullaniciId"] = $kullanicim["kullaniciId"];
            $_SESSION["kadi"] = $kullaniciAdi;
            $jsonCiktisi["hata"] = FALSE;
            $jsonCiktisi["session"] = $_SESSION["kadi"];

            $_code = 200;
        }else{
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"] = "Kullanıcı Adı veya Şifre Yanlış , sistemde böyle bir kullanıcı bulunamadı";
            $_code = 400;
        }
    }
    else{
        $tumKullanicilar = $_GET["tumuyeler"];
        $userRowCount = $db->query("SELECT *  FROM kullanicilar")->rowCount();
        if($userRowCount){
            $kullanicilar = $db->query("SELECT * FROM kullanicilar ")->fetchAll(PDO::FETCH_ASSOC);
            $jsonCiktisi["uyeler"] = $kullanicilar;
            $jsonCiktisi["hata"] = FALSE;
            $_code = 200;

        }else{
            $jsonCiktisi["hata"] = TRUE;
            $jsonCiktisi["hataMesaji"] = "Kullanıcı Bulunmamaktadır";
            $_code = 400;
        }
    }

}
else{
    $jsonCiktisi["hata"] = TRUE;
    $jsonCiktisi["hataMesaji"] = "Sadece REST API üzerinden POST-PUT-DELETE-GET işlemleri desteklenmektedir.";
    $_code = 400;
}

SetHeader($_code);
$jsonCiktisi[$_code] = HttpStatus($_code);
echo  json_encode($jsonCiktisi);
?>



