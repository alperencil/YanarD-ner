<?php

session_start();
if($_SESSION["kadi"]){
        echo $_SESSION["kadi"]." Adlı kullanıcı hoşgeldiniz.";
        echo "<br> <a href='session_sil.php'>Çıkış</a>";
}else{
    echo "Yok";
}





?>