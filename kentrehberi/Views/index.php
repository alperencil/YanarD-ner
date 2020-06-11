<?php

session_start();
if($_SESSION["kadi"]){
    ?>
    <html>
    <head>
        <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../vendor/fortawesome/font-awesome/css/all.css">
        <link rel="stylesheet" href="../css/alertify.css">
        <link rel="stylesheet" href="../css/stil.css">
        <title>
            Anasayfa
        </title>
    </head>
    <body>
    <div class="modal fade" id="firmaIstekModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Firma İsteği Gönderme Formu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="tel">Firma Telefonu</label>
                        <input type="text" class="form-control" id="tel">
                    </div>
                    <div class="form-group">
                        <label for="metin">İstek Metni</label>
                        <textarea name="metin" id="metin" cols="30" class="form-control" rows="10"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button type="button" class="btn btn-primary" id="firmaIstekBtn"><i class="fas fa-plus" ></i>&nbsp;Firma İsteği Gönder</button>
                </div>
            </div>
        </div>
    </div>



    <input type="text" hidden id="gelenKullaniciId" value="<?php echo $_SESSION["kullaniciId"];    ?>">
    <nav class="navbar navbar-expand-lg navbar-light ">
        <a class="navbar-brand" href="#">Antalya Kent Rehberi</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" onclick="firmalarGoster()" href="#">Firmalar <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" onclick="dovizGoster()" href="#">Döviz</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="hakkimizdaGetir()" href="#">Hakkımızda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#firmaIstekModal" href="#">Firma İsteği Gönder</a>
                </li>


            </ul>
            <form class="form-inline my-2 my-lg-0">
                <button class="mr-2 geceButton" id="geceButonu" "><i class="far fa-moon" style="font-size: 1.50rem"></i></button>
                <input class="form-control mr-sm-2" id="firmaAra" type="search" placeholder="Firma Ara" aria-label="Search">
                <a href="../session_sil.php" class="btn btn-danger">Çıkış Yap</a>

            </form>
        </div>
    </nav>

    <div class="container firmaContainer">

        <div class="row mt-2 firmaSatir justify-content-center">




        </div>
    </div>
    <div class="container dovizContainer">

        <div class="row justify-content-center mt-2">
            <div class="card bg-success">
                <div class="card-body dovizYenileme text-white">
                    This is some text within a card body.
                </div>
            </div>
        </div>

        <div class="row mt-2 dovizSatir justify-content-center">



            <div class="card" style="width: 10rem;">
                       <div class="card-body text-center">
                           <h5 class="card-title abd"></h5>
                           <hr>
                           <h6 class="card-subtitle abd-satis mb-2 alis text-muted">Card subtitle</h6>
                           <hr>
                           <h6 class="card-subtitle abd-alis mb-2 veris text-muted">Card subtitle</h6>
                           <hr>
                           <h6 class="card-subtitle abd-tur mb-2 veris text-muted">Card subtitle</h6>
                       </div>
                 </div>
            <div class="card" style="width: 10rem;">
                <div class="card-body text-center">
                    <h5 class="card-title euro"></h5>
                    <hr>
                    <h6 class="card-subtitle euro-satis mb-2 alis text-muted">Card subtitle</h6>
                    <hr>
                    <h6 class="card-subtitle euro-alis mb-2 veris text-muted">Card subtitle</h6>
                    <hr>
                    <h6 class="card-subtitle euro-tur mb-2 veris text-muted">Card subtitle</h6>
                </div>
            </div>
            <div class="card" style="width: 10rem;">
                <div class="card-body text-center">
                    <h5 class="card-title sterlin"></h5>
                    <hr>
                    <h6 class="card-subtitle sterlin-satis  mb-2 alis text-muted">Card subtitle</h6>
                    <hr>
                    <h6 class="card-subtitle sterlin-alis mb-2 veris text-muted">Card subtitle</h6>
                    <hr>
                    <h6 class="card-subtitle sterlin-tur mb-2 veris text-muted">Card subtitle</h6>
                </div>
            </div>
            <div class="card" style="width: 10rem;">
                <div class="card-body text-center">
                    <h5 class="card-title rus"></h5>
                    <hr>
                    <h6 class="card-subtitle rus-satis mb-2 alis text-muted">Card subtitle</h6>
                    <hr>
                    <h6 class="card-subtitle rus-alis mb-2 veris text-muted">Card subtitle</h6>
                    <hr>
                    <h6 class="card-subtitle rus-tur mb-2 veris text-muted">Card subtitle</h6>
                </div>
            </div>
            <div class="card" style="width: 10rem;">
                <div class="card-body text-center">
                    <h5 class="card-title iran"></h5>
                    <hr>
                    <h6 class="card-subtitle iran-satis mb-2 alis text-muted">Card subtitle</h6>
                    <hr>
                    <h6 class="card-subtitle iran-alis mb-2 veris text-muted">Card subtitle</h6>
                    <hr>
                    <h6 class="card-subtitle iran-tur mb-2 veris text-muted">Card subtitle</h6>
                </div>
            </div>
            <div class="card" style="width: 10rem;">
                <div class="card-body text-center">
                    <h5 class="card-title cin"></h5>
                    <hr>
                    <h6 class="card-subtitle cin-satis mb-2 alis text-muted">Card subtitle</h6>
                    <hr>
                    <h6 class="card-subtitle cin-alis mb-2 veris text-muted">Card subtitle</h6>
                    <hr>
                    <h6 class="card-subtitle cin-tur mb-2 veris text-muted">Card subtitle</h6>
                </div>
            </div>
            <div class="card" style="width: 10rem;">
                <div class="card-body text-center">
                    <h5 class="card-title gram"></h5>
                    <hr>
                    <h6 class="card-subtitle gram-satis mb-2 alis text-muted">Card subtitle</h6>
                    <hr>
                    <h6 class="card-subtitle gram-alis mb-2 veris text-muted">Card subtitle</h6>
                    <hr>
                    <h6 class="card-subtitle gram-tur mb-2 veris text-muted">Card subtitle</h6>
                </div>
            </div>
            <div class="card" style="width: 10rem;">
                <div class="card-body text-center">
                    <h5 class="card-title ceyrek"></h5>
                    <hr>
                    <h6 class="card-subtitle ceyrek-satis mb-2 alis text-muted">Card subtitle</h6>
                    <hr>
                    <h6 class="card-subtitle ceyrek-alis mb-2 veris text-muted">Card subtitle</h6>
                    <hr>
                    <h6 class="card-subtitle ceyrek-tur mb-2 veris text-muted">Card subtitle</h6>
                </div>
            </div>
            <div class="card" style="width: 10rem;">
                <div class="card-body text-center">
                    <h5 class="card-title a14"></h5>
                    <hr>
                    <h6 class="card-subtitle a14-satis mb-2 alis text-muted">Card subtitle</h6>
                    <hr>
                    <h6 class="card-subtitle a14-alis mb-2 veris text-muted">Card subtitle</h6>
                    <hr>
                    <h6 class="card-subtitle a14-tur mb-2 veris text-muted">Card subtitle</h6>
                </div>
            </div>
            <div class="card" style="width: 10rem;">
                <div class="card-body text-center">
                    <h5 class="card-title a18"></h5>
                    <hr>
                    <h6 class="card-subtitle a18-satis mb-2 alis text-muted">Card subtitle</h6>
                    <hr>
                    <h6 class="card-subtitle a18-alis mb-2 veris text-muted">Card subtitle</h6>
                    <hr>
                    <h6 class="card-subtitle a18-tur mb-2 veris text-muted">Card subtitle</h6>
                </div>
            </div>
            <div class="card" style="width: 10rem;">
                <div class="card-body text-center">
                    <h5 class="card-title a22"></h5>
                    <hr>
                    <h6 class="card-subtitle a22-satis mb-2 alis text-muted">Card subtitle</h6>
                    <hr>
                    <h6 class="card-subtitle a22-alis mb-2 veris text-muted">Card subtitle</h6>
                    <hr>
                    <h6 class="card-subtitle a22-tur mb-2 veris text-muted">Card subtitle</h6>
                </div>
            </div>
            <div class="card" style="width: 10rem;">
                <div class="card-body text-center">
                    <h5 class="card-title gumus"></h5>
                    <hr>
                    <h6 class="card-subtitle gumus-satis mb-2 alis text-muted">Card subtitle</h6>
                    <hr>
                    <h6 class="card-subtitle gumus-alis mb-2 veris text-muted">Card subtitle</h6>
                    <hr>
                    <h6 class="card-subtitle gumus-tur mb-2 veris text-muted">Card subtitle</h6>
                </div>
            </div>



        </div>
    </div>
    <div class="container hakkimizdaContainer">
        <div class="row justify-content-center mt-5">
            <div class="col-8">
                <h2 class="text-center hbaslik"></h2>
                <h3 class="text-center hmetin"></h3>
            </div>
        </div>
    </div>
    <div class="container  firmaDetayContainer">
        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" onclick="firmalarGoster()">Anasayfa</a></li>
                <li class="breadcrumb-item"><a href="#" onclick="firmalarGoster()">Firmalar</a></li>
                <li class="breadcrumb-item active firmaDetayAdi" aria-current="page">Hicaz Pazarı</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-10">
                <img src="https://via.placeholder.com/1000x400"  class="img-fluid firmaDetayResmi" >
            </div>
            <div class="col-10">
                <table class="table table-striped table-bordered">
                    <tbody>
                    <tr>
                        <td class="text-center firmaDetayAdi" colspan="2">Hicaz Pazarı</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-phone"></i>&nbsp;Telefon Numarası :</td>
                        <td class="firmaDetayTelefon">0(555)007 71 60</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-map-marker-alt"></i>&nbsp;Adres :</td>
                        <td class="firmaDetayAdres">Gülverenler mahallesi 2310 sokak no 3 , adıyaman hamamı karşısı.</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-info-circle"></i>&nbsp;Firma Açıklaması</td>
                        <td class="firmaDetayAciklama"></td>
                    </tr>
                    <tr>
                        <td>Firma ID:</td>
                        <td ><h2 class="firmaIdKismi"></h2></td>
                    </tr>
                    <tr>
                        <td class="align-middle text-center" id="puanYazisi"></td>
                        <td class="puanKismi"> <div class="form-group verilecekPuan">
                                <select class="form-control" id="puanlar" name="puanlar">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <button class="puanGonder btn btn-success  btn-block" ><i style="font-size: 1.25rem;" class="fas fa-hand-point-right"></i>&nbsp;Puanla</button>
                            </div>
                            <h2 class="verilmisPuan">Puan verdiniz.Verdiğiniz puan :</h2>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <hr>
        <div class="row justify-content-center">
            <div class="col-8 text-center">
                <div class="form-group">
                    <label for="yorum" class="h3" >İşletme Hakkında Yorumunuz</label>
                    <textarea  id="yorum" cols="30" rows="10" class="form-control"></textarea>
                </div>

                <button class="btn btn-primary btn-block" id="yorumBtn">Yorumu Gönder</button>
            </div>
        </div>
        <hr>
        <div class="row justify-content-center">
            <div class="col-8 text-center">
                <h3><u>Yorumlar</u></h3>
            </div>

        </div>
        <div class="row justify-content-center yorumlarKismi">



        </div>

    </div>





    <script src="../js/jquery.js"></script>
    <script src="../vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../js/alertify.min.js"></script>
    <script src="../js/kullanici.js"></script>
    </body>
    </html>



<?php
}else{
    header("location:../kullaniciGiris.php");
}




?>