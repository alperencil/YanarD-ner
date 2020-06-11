<?php
try{
    $db = new PDO("mysql:host=localhost;dbname=kentrehberi;","root","");
    $db->query("SET CHARACTER SET utf8");
}catch (Exception $e){
    echo "Bağlantı Hatası =".$e->getMessage();
}







?>