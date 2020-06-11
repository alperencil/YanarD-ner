<?php
include "../db.php";
$gelenFirmaId = $_POST["id"];
$gelenAciklama = $_POST["firmaAciklama"];
$gelenResim = $_FILES["firmaFotosu"]["name"];
$gelenPath  = $_FILES["firmaFotosu"]["tmp_name"];
$path = "../img/";
echo $gelenFirmaId;



$finalResim = rand(1000,100000).$gelenResim;

$path = $path.strtolower($gelenResim);



$ex = $db->query("UPDATE firmalar SET  firmaAciklama='$gelenAciklama', firmaFotosu='$path' WHERE firmaId='$gelenFirmaId'");

if($ex){
    if(move_uploaded_file($gelenPath,$path)){
        header("location:../Views/firma.php");
    }else{
        header("location:../Views/hata2.php");
    }



}else{
    header("location:../Views/hata.php");
}









?>