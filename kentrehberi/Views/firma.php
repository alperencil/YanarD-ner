<?php
session_start();
if($_SESSION["firmamail"]){

?>


    <!doctype html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <title>Firmalar</title>
    </head>
    <body>

    <div class="modal fade" id="firmaGuncelleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Firma Bilgilerini Güncelle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../Model/firmaUpdate.php" method="post" id="firmaGuncelle" name="firmaGuncelle" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" id="id" name="id" class="form-control" hidden value="<?php echo $_SESSION["firmaId"];   ?>">
                        </div>

                        <div class="form-group">
                            <label for="firmaAciklama">Firma Açıklama Yazısı</label>
                            <textarea name="firmaAciklama" id="firmaAciklama" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group text-center">
                            <label for="firmaFotosu">Firma Fotoğrafı</label>
                            <input type="file" class="form-control" name="firmaFotosu" id="firmaFotosu">
                            <img src="" id="resimGoster" class="img-fluid mt-5" >
                        </div>


                    <div class="form-group">
                        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Kapat</button>
                        <input type="submit" class="btn btn-primary btn-block" value="Güncelle">

                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>




    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Firma Sayfası</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <a href="#" class="btn btn-outline-primary mx-3 firmaMail"><?php  echo $_SESSION["firmamail"];  ?></a>
            <a href="#" class="btn btn-outline-success my-2 my-sm-0 mx-3"  onclick="guncelleModalDoldur()">Firmayı Güncelle</a>
            <a href="../session_sil.php" class="btn btn-outline-danger my-2 my-sm-0">Çıkış Yap</a>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-10 anakapsam">
                <img src="https://via.placeholder.com/1250x400" class="img-fluid firmaresim" width="100%" alt="">

            <table class="table table-striped table-bordered">
                <tbody>
                <tr>
                    <td>Firma Adı :</td>
                    <td class="firmaAdi"></td>
                </tr>
                <tr>
                    <td>Firma Açıklama Metni :</td>
                    <td class="firmaAciklama"></td>
                </tr>
                <tr>
                    <td>Firma ID :</td>
                    <td class="firmaId"><?php echo $_SESSION["firmaId"];   ?></td>
                </tr>
                <tr>
                    <td>Firma Adresi :</td>
                    <td class="firmaAdresi"></td>
                </tr>
                <tr>
                    <td>Firma Telefonu :</td>
                    <td class="firmaTelefonu"></td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="../js/firmalar.js"></script>
    </body>
    </html>









<?php
}else{
    header("location:../kullaniciGiris.php");
}