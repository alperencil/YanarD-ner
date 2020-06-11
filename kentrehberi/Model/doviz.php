<?php
include "../db.php";
include "../function.php";

$jsonCiktisi = array();
$jsonCiktisi["hata"] = FALSE;
    $_code = 200;
$_method = $_SERVER["REQUEST_METHOD"];
header('Access_Control_Allow_Origin: *');
header("Access_Control_Allow_Credentials: true");
header('Access_Control_Allow_Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access_Control_Max_Age: 1000');
header('Access_Control_Allow_Headers: Origin, Content_Type, X_Auth_Token , Authorization');
$data = file_get_contents("https://finans.truncgil.com/today.json");
$veri = json_decode($data,1);



if($_method == "GET"){
    $jsonCiktisi["guncelleme_tarihi"] = $veri["Güncelleme Tarihi"];

    $jsonCiktisi["abd_dolari"]["isim"] = "ABD DOLARI";
    $jsonCiktisi["abd_dolari"]["alis"] = $veri["ABD DOLARI"]["Alış"];
    $jsonCiktisi["abd_dolari"]["satis"] = $veri["ABD DOLARI"]["Satış"];
    $jsonCiktisi["abd_dolari"]["tur"] = $veri["ABD DOLARI"]["Tür"];

    $jsonCiktisi["avustralya_dolari"]["isim"] = "AVUSTRALYA DOLARI";
    $jsonCiktisi["avustralya_dolari"]["alis"] = $veri["AVUSTRALYA DOLARI"]["Alış"];
    $jsonCiktisi["avustralya_dolari"]["satis"] = $veri["AVUSTRALYA DOLARI"]["Satış"];
    $jsonCiktisi["avustralya_dolari"]["tur"] = $veri["AVUSTRALYA DOLARI"]["Tür"];

    $jsonCiktisi["danimarka_kronu"]["isim"] = "DANİMARKA KRONU";
    $jsonCiktisi["danimarka_kronu"]["alis"] = $veri["DANİMARKA KRONU"]["Alış"];
    $jsonCiktisi["danimarka_kronu"]["satis"] = $veri["DANİMARKA KRONU"]["Satış"];
    $jsonCiktisi["danimarka_kronu"]["tur"] = $veri["DANİMARKA KRONU"]["Tür"];

    $jsonCiktisi["euro"]["isim"] = "EURO";
    $jsonCiktisi["euro"]["alis"] = $veri["EURO"]["Alış"];
    $jsonCiktisi["euro"]["satis"] = $veri["EURO"]["Satış"];
    $jsonCiktisi["euro"]["tur"] = $veri["EURO"]["Tür"];

    $jsonCiktisi["ingiliz_sterlini"]["isim"] = "İNGİLİZ STERLİNİ";
    $jsonCiktisi["ingiliz_sterlini"]["alis"] = $veri["İNGİLİZ STERLİNİ"]["Alış"];
    $jsonCiktisi["ingiliz_sterlini"]["satis"] = $veri["İNGİLİZ STERLİNİ"]["Satış"];
    $jsonCiktisi["ingiliz_sterlini"]["tur"] = $veri["İNGİLİZ STERLİNİ"]["Tür"];

    $jsonCiktisi["isvicre_frangi"]["isim"] = "İSVİÇRE FRANGI";
    $jsonCiktisi["isvicre_frangi"]["alis"] = $veri["İSVİÇRE FRANGI"]["Alış"];
    $jsonCiktisi["isvicre_frangi"]["satis"] = $veri["İSVİÇRE FRANGI"]["Satış"];
    $jsonCiktisi["isvicre_frangi"]["tur"] = $veri["İSVİÇRE FRANGI"]["Tür"];

    $jsonCiktisi["isvec_kronu"]["isim"] = "İSVEÇ KRONU";
    $jsonCiktisi["isvec_kronu"]["alis"] = $veri["İSVEÇ KRONU"]["Alış"];
    $jsonCiktisi["isvec_kronu"]["satis"] = $veri["İSVEÇ KRONU"]["Satış"];
    $jsonCiktisi["isvec_kronu"]["tur"] = $veri["İSVEÇ KRONU"]["Tür"];

     $jsonCiktisi["kanada_dolari"]["isim"] = "KANADA DOLARI";
    $jsonCiktisi["kanada_dolari"]["alis"] = $veri["KANADA DOLARI"]["Alış"];
    $jsonCiktisi["kanada_dolari"]["satis"] = $veri["KANADA DOLARI"]["Satış"];
    $jsonCiktisi["kanada_dolari"]["tur"] = $veri["KANADA DOLARI"]["Tür"];

    $jsonCiktisi["kuveyt_dinari"]["isim"] = "KUVEYT DİNARI";
    $jsonCiktisi["kuveyt_dinari"]["alis"] = $veri["KUVEYT DİNARI"]["Alış"];
    $jsonCiktisi["kuveyt_dinari"]["satis"] = $veri["KUVEYT DİNARI"]["Satış"];
    $jsonCiktisi["kuveyt_dinari"]["tur"] = $veri["KUVEYT DİNARI"]["Tür"];

    $jsonCiktisi["norvec_kronu"]["isim"] = "NORVEÇ KRONU";
    $jsonCiktisi["norvec_kronu"]["alis"] = $veri["NORVEÇ KRONU"]["Alış"];
    $jsonCiktisi["norvec_kronu"]["satis"] = $veri["NORVEÇ KRONU"]["Satış"];
    $jsonCiktisi["norvec_kronu"]["tur"] = $veri["NORVEÇ KRONU"]["Tür"];

    $jsonCiktisi["suudi_arabistan_riyali"]["isim"] = "SUUDİ ARABİSTAN RİYALİ";
    $jsonCiktisi["suudi_arabistan_riyali"]["alis"] = $veri["SUUDİ ARABİSTAN RİYALİ"]["Alış"];
    $jsonCiktisi["suudi_arabistan_riyali"]["satis"] = $veri["SUUDİ ARABİSTAN RİYALİ"]["Satış"];
    $jsonCiktisi["suudi_arabistan_riyali"]["tur"] = $veri["SUUDİ ARABİSTAN RİYALİ"]["Tür"];

     $jsonCiktisi["japon_yeni"]["isim"] = "JAPON YENİ";
    $jsonCiktisi["japon_yeni"]["alis"] = $veri["JAPON YENİ"]["Alış"];
    $jsonCiktisi["japon_yeni"]["satis"] = $veri["JAPON YENİ"]["Satış"];
    $jsonCiktisi["japon_yeni"]["tur"] = $veri["JAPON YENİ"]["Tür"];

     $jsonCiktisi["bulgar_levasi"]["isim"] = "BULGAR LEVASI";
    $jsonCiktisi["bulgar_levasi"]["alis"] = $veri["BULGAR LEVASI"]["Alış"];
    $jsonCiktisi["bulgar_levasi"]["satis"] = $veri["BULGAR LEVASI"]["Satış"];
    $jsonCiktisi["bulgar_levasi"]["tur"] = $veri["BULGAR LEVASI"]["Tür"];

    $jsonCiktisi["rumen_leyi"]["isim"] = "RUMEN LEYİ";
    $jsonCiktisi["rumen_leyi"]["alis"] = $veri["RUMEN LEYİ"]["Alış"];
    $jsonCiktisi["rumen_leyi"]["satis"] = $veri["RUMEN LEYİ"]["Satış"];
    $jsonCiktisi["rumen_leyi"]["tur"] = $veri["RUMEN LEYİ"]["Tür"];

     $jsonCiktisi["rus_rublesi"]["isim"] = "RUS RUBLESİ";
    $jsonCiktisi["rus_rublesi"]["alis"] = $veri["RUS RUBLESİ"]["Alış"];
    $jsonCiktisi["rus_rublesi"]["satis"] = $veri["RUS RUBLESİ"]["Satış"];
    $jsonCiktisi["rus_rublesi"]["tur"] = $veri["RUS RUBLESİ"]["Tür"];

     $jsonCiktisi["iran_riyali"]["isim"] = "İRAN RİYALİ";
    $jsonCiktisi["iran_riyali"]["alis"] = $veri["İRAN RİYALİ"]["Alış"];
    $jsonCiktisi["iran_riyali"]["satis"] = $veri["İRAN RİYALİ"]["Satış"];
    $jsonCiktisi["iran_riyali"]["tur"] = $veri["İRAN RİYALİ"]["Tür"];

     $jsonCiktisi["cin_yuani"]["isim"] = "ABD DOLARI";
    $jsonCiktisi["cin_yuani"]["alis"] = $veri["ÇİN YUANI"]["Alış"];
    $jsonCiktisi["cin_yuani"]["satis"] = $veri["ÇİN YUANI"]["Satış"];
    $jsonCiktisi["cin_yuani"]["tur"] = $veri["ÇİN YUANI"]["Tür"];

    $jsonCiktisi["pakistan_rupisi"]["isim"] = "PAKİSTAN RUPİSİ";
    $jsonCiktisi["pakistan_rupisi"]["alis"] = $veri["PAKİSTAN RUPİSİ"]["Alış"];
    $jsonCiktisi["pakistan_rupisi"]["satis"] = $veri["PAKİSTAN RUPİSİ"]["Satış"];
    $jsonCiktisi["pakistan_rupisi"]["tur"] = $veri["PAKİSTAN RUPİSİ"]["Tür"];

    $jsonCiktisi["katar_riyali"]["isim"] = "KATAR RİYALİ";
    $jsonCiktisi["katar_riyali"]["alis"] = $veri["KATAR RİYALİ"]["Alış"];
    $jsonCiktisi["katar_riyali"]["satis"] = $veri["KATAR RİYALİ"]["Satış"];
    $jsonCiktisi["katar_riyali"]["tur"] = $veri["KATAR RİYALİ"]["Tür"];

    $jsonCiktisi["ons_altin"]["isim"] = "Ons Altın";
    $jsonCiktisi["ons_altin"]["alis"] = $veri["Ons Altın"]["Alış"];
    $jsonCiktisi["ons_altin"]["satis"] = $veri["Ons Altın"]["Satış"];
    $jsonCiktisi["ons_altin"]["tur"] = $veri["Ons Altın"]["Tür"];

    $jsonCiktisi["gram_altin"]["isim"] = "Gram Altın";
    $jsonCiktisi["gram_altin"]["alis"] = $veri["Gram Altın"]["Alış"];
    $jsonCiktisi["gram_altin"]["satis"] = $veri["Gram Altın"]["Satış"];
    $jsonCiktisi["gram_altin"]["tur"] = $veri["Gram Altın"]["Tür"];

     $jsonCiktisi["ceyrek_altin"]["isim"] = "Çeyrek Altın";
    $jsonCiktisi["ceyrek_altin"]["alis"] = $veri["Çeyrek Altın"]["Alış"];
    $jsonCiktisi["ceyrek_altin"]["satis"] = $veri["Çeyrek Altın"]["Satış"];
    $jsonCiktisi["ceyrek_altin"]["tur"] = $veri["Çeyrek Altın"]["Tür"];

     $jsonCiktisi["yarim_altin"]["isim"] = "Yarım Altın";
    $jsonCiktisi["yarim_altin"]["alis"] = $veri["Yarım Altın"]["Alış"];
    $jsonCiktisi["yarim_altin"]["satis"] = $veri["Yarım Altın"]["Satış"];
    $jsonCiktisi["yarim_altin"]["tur"] = $veri["Yarım Altın"]["Tür"];

     $jsonCiktisi["tam_altin"]["isim"] = "Tam Altın";
    $jsonCiktisi["tam_altin"]["alis"] = $veri["Tam Altın"]["Alış"];
    $jsonCiktisi["tam_altin"]["satis"] = $veri["Tam Altın"]["Satış"];
    $jsonCiktisi["tam_altin"]["tur"] = $veri["Tam Altın"]["Tür"];

     $jsonCiktisi["cumhuriyet_altini"]["isim"] = "Cumhuriyet Altını";
    $jsonCiktisi["cumhuriyet_altini"]["alis"] = $veri["Cumhuriyet Altını"]["Alış"];
    $jsonCiktisi["cumhuriyet_altini"]["satis"] = $veri["Cumhuriyet Altını"]["Satış"];
    $jsonCiktisi["cumhuriyet_altini"]["tur"] = $veri["Cumhuriyet Altını"]["Tür"];

     $jsonCiktisi["ata_altin"]["isim"] = "Ata Altın";
    $jsonCiktisi["ata_altin"]["alis"] = $veri["Ata Altın"]["Alış"];
    $jsonCiktisi["ata_altin"]["satis"] = $veri["Ata Altın"]["Satış"];
    $jsonCiktisi["ata_altin"]["tur"] = $veri["Ata Altın"]["Tür"];

    $jsonCiktisi["resat_altin"]["isim"] = "Reşat Altın";
    $jsonCiktisi["resat_altin"]["alis"] = $veri["Reşat Altın"]["Alış"];
    $jsonCiktisi["resat_altin"]["satis"] = $veri["Reşat Altın"]["Satış"];
    $jsonCiktisi["resat_altin"]["tur"] = $veri["Reşat Altın"]["Tür"];

    $jsonCiktisi["hamit_altin"]["isim"] = "Hamit Altın";
    $jsonCiktisi["hamit_altin"]["alis"] = $veri["Hamit Altın"]["Alış"];
    $jsonCiktisi["hamit_altin"]["satis"] = $veri["Hamit Altın"]["Satış"];
    $jsonCiktisi["hamit_altin"]["tur"] = $veri["Hamit Altın"]["Tür"];

    $jsonCiktisi["iki_bucuk_altin"]["isim"] = "İkibuçuk Altın";
    $jsonCiktisi["iki_bucuk_altin"]["alis"] = $veri["İkibuçuk Altın"]["Alış"];
    $jsonCiktisi["iki_bucuk_altin"]["satis"] = $veri["İkibuçuk Altın"]["Satış"];
    $jsonCiktisi["iki_bucuk_altin"]["tur"] = $veri["İkibuçuk Altın"]["Tür"];

    $jsonCiktisi["gremse_altin"]["isim"] = "Gremse Altın";
    $jsonCiktisi["gremse_altin"]["alis"] = $veri["Gremse Altın"]["Alış"];
    $jsonCiktisi["gremse_altin"]["satis"] = $veri["Gremse Altın"]["Satış"];
    $jsonCiktisi["gremse_altin"]["tur"] = $veri["Gremse Altın"]["Tür"];

    $jsonCiktisi["besli_altin"]["isim"] = "Beşli Altın";
    $jsonCiktisi["besli_altin"]["alis"] = $veri["Beşli Altın"]["Alış"];
    $jsonCiktisi["besli_altin"]["satis"] = $veri["Beşli Altın"]["Satış"];
    $jsonCiktisi["besli_altin"]["tur"] = $veri["Beşli Altın"]["Tür"];

    $jsonCiktisi["a14_ayar_altin"]["isim"] = "14 Ayar Altın";
    $jsonCiktisi["a14_ayar_altin"]["alis"] = $veri["14 Ayar Altın"]["Alış"];
    $jsonCiktisi["a14_ayar_altin"]["satis"] = $veri["14 Ayar Altın"]["Satış"];
    $jsonCiktisi["a14_ayar_altin"]["tur"] = $veri["14 Ayar Altın"]["Tür"];

    $jsonCiktisi["a18_ayarl_altin"]["isim"] = "18 Ayar Altın";
    $jsonCiktisi["a18_ayarl_altin"]["alis"] = $veri["18 Ayar Altın"]["Alış"];
    $jsonCiktisi["a18_ayarl_altin"]["satis"] = $veri["18 Ayar Altın"]["Satış"];
    $jsonCiktisi["a18_ayarl_altin"]["tur"] = $veri["18 Ayar Altın"]["Tür"];

    $jsonCiktisi["y2_ayar_bilezik"]["isim"] = "22 Ayar Bilezik";
    $jsonCiktisi["y2_ayar_bilezik"]["alis"] = $veri["22 Ayar Bilezik"]["Alış"];
    $jsonCiktisi["y2_ayar_bilezik"]["satis"] = $veri["22 Ayar Bilezik"]["Satış"];
    $jsonCiktisi["y2_ayar_bilezik"]["tur"] = $veri["22 Ayar Bilezik"]["Tür"];

    $jsonCiktisi["gumus"]["isim"] = "Gümüş";
    $jsonCiktisi["gumus"]["alis"] = $veri["Gümüş"]["Alış"];
    $jsonCiktisi["gumus"]["satis"] = $veri["Gümüş"]["Satış"];
    $jsonCiktisi["gumus"]["tur"] = $veri["Gümüş"]["Tür"];


}else{
    $jsonCiktisi["hata"] = TRUE;
    $jsonCiktisi["hataMesaji"] = "Sadece Get Metodu Çalışıyor.";
    $_code = 400;
}



SetHeader($_code);
$jsonCiktisi[$_code] = HttpStatus($_code);
echo json_encode($jsonCiktisi);
?>