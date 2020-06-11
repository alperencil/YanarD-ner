<?php
session_start();
if($_SESSION["adminmail"]){
    ?>

    <html>
    <head>
        <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../vendor/fortawesome/font-awesome/css/all.css">
        <link rel="stylesheet" href="../css/alertify.css">
        <title>
            Admin Yönetim Paneli
        </title>
    </head>
    <body>
    <div class="modal fade" id="hakkimizdaGuncelleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hakkımızda Sayfasını Güncelle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" hidden id="guncellenenAdminId">
                    </div>
                    <div class="form-group">
                        <label for="hakkimizdaBaslik">Hakkımızda Sayfasının Başlığı</label>
                        <input type="text"  class="form-control" id="hakkimizdaBaslik">
                    </div>
                    <div class="form-group">
                        <label for="hakkimizdaMetin">Hakkımızda Sayfasının İçeriği</label>
                        <textarea name="hakkimizdaMetin" id="hakkimizdaMetin" class="form-control" cols="30" rows="10"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button type="button" class="btn btn-primary" onclick="hakkimizdaGuncelle()" >Hakkımızda Sayfasını Güncelle</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="adminGuncelleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Admin Bilgilerini Güncelle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" hidden id="guncellenenAdminId">
                    </div>
                    <div class="form-group">
                        <label for="guncellenenAdminMail">Admin Mail</label>
                        <input type="text"  class="form-control" id="guncellenenAdminMail">
                    </div>
                    <div class="form-group">
                        <label for="guncellenenAdminPass">Admin Şifresi</label>
                        <input type="text" class="form-control" id="guncellenenAdminPass">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button type="button" class="btn btn-primary" onclick="adminiGuncelle()">Admin Güncelle</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="adminEkleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Admin Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="gelenAdminMail">Admin Mail</label>
                        <input type="text"  class="form-control" id="gelenAdminMail">
                    </div>
                    <div class="form-group">
                        <label for="gelenAdminPass">Admin Şifresi</label>
                        <input type="text" class="form-control" id="gelenAdminPass">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button type="button" class="btn btn-primary" onclick="adminEkle()" >Admin'i Ekle</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="kullaniciGuncelleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kullanıcı Bilgilerini Güncelle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" hidden id="gelenKullaniciId">
                    </div>
                    <div class="form-group">
                        <label for="gelenKullaniciAdi">Kullanıcı Adı</label>
                        <input type="text"  class="form-control" id="gelenKullaniciAdi">
                    </div>
                    <div class="form-group">
                        <label for="gelenKullaniciSifre">Kullanıcı Şifresi</label>
                        <input type="text" class="form-control" id="gelenKullaniciSifre">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button type="button" class="btn btn-primary" onclick="kullaniciGuncelle()">Firmayı Güncelle</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
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
                   <div class="form-group">
                       <input type="text" hidden id="gelenGizliId">
                   </div>
                    <div class="form-group">
                        <label for="gelenFirmaAdim">Firma Adı</label>
                        <input type="text"  class="form-control" id="gelenFirmaAdim">
                    </div>
                    <div class="form-group">
                        <label for="gelenFirmaAdresim">Firma Adresi</label>
                        <input type="text" class="form-control" id="gelenFirmaAdresim">
                    </div>
                    <div class="form-group">
                        <label for="gelenFirmaTelim">Firma Telefonu</label>
                        <input type="text"  class="form-control" id="gelenFirmaTelim">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button type="button" class="btn btn-primary" onclick="firmaGuncelleBtn()">Firmayı Güncelle</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="firmaSahibiGuncelle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" id="isletmeSahibiId" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="isletmeSahibiMail">İşletme Mail Adresi</label>
                        <input type="text" class="form-control" id="isletmeSahibiMail">
                    </div>

                    <div class="form-group">
                        <label for="isletmeSahibiPass">İşletme Sahibi Şifre</label>
                        <input type="text" class="form-control" id="isletmeSahibiPass">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button type="button" onclick="firmaSahibiGuncelle()" class="btn btn-primary">Değişiklikleri Kaydet</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="firmaSahibiEkle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Firma Sahibi Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="firmaSahibiMailEkle">Firma Mail</label>
                        <input type="text" class="form-control" id="firmaSahibiMailEkle">
                    </div>
                    <div class="form-group">
                        <label for="firmaSahibiPassEkle">Firma Şifre</label>
                        <input type="text" class="form-control" id="firmaSahibiPassEkle">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button type="button" class="btn btn-primary" onclick="firmaSaibiEkle()">Firma Sahibi Ekle</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="firmaEkleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Firma Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="firmaAdi">Firma Adı</label>
                        <input type="text" id="firmaAdi" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="adres">Adres</label>
                        <textarea  id="adres" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="telefon">Telefon</label>
                        <input type="text" id="telefon" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="firmaSahibi">Firma Kimin ?</label>
                        <select class="form-control"  id="firmaSahibi">

                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button type="button" class="btn btn-primary"  id="firmaEkleBtn">Firmayı Ekle</button>
                </div>
            </div>
        </div>
    </div>


    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Antalya Kent Rehberi</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link"id="firmaBtn" onclick="firmalariGoster()" href="#">Firmalar <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="firmaSahibiBtn" onclick="firmaSahipleriGoster()" href="#">Firma Sahipleri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="istekleriGoster()" href="#">Firma İstekleri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="kullaniciSayfasiGoster()" href="#">Kullanıcılar</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" onclick="adminleriGoster()" href="#">Adminler</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="hakkimizdaModalAc()"  href="#">Hakkımızda Sayfasını Güncelle</a>
                </li>


            </ul>
            <form class="form-inline my-2 my-lg-0">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success mr-2" id="firmaSahibiModalBtn"  data-toggle="modal" data-target="#firmaSahibiEkle">
                    <i class="fas fa-user-plus"></i>&nbsp; Firma Sahibi Ekle
                </button>
                <button type="button" class="btn btn-primary mr-2" id="firmaModalBtn"  data-toggle="modal" data-target="#firmaEkleModal">
                    <i class="fas fa-plus "></i>&nbsp; Firma Ekle
                </button>
                <button type="button" class="btn btn-info mr-2" id="adminModalBtn"  data-toggle="modal" data-target="#adminEkleModal">
                    <i class="fas fa-plus "></i>&nbsp; Admin Ekle
                </button>

                <a href="../session_sil.php" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i>&nbsp;Çıkış Yap</a>

            </form>
        </div>
    </nav>


    <div class="container">
        <div class="row justify-content-center firmalar">
       <!--Firmalar Buraya Gelecek-->
        </div>


        <div class="row justify-content-center firmaSahipleri">
            <h2>Firma Sahipleri</h2>

            <!--Firma Sahipleri Buraya Gelecek-->
            <table class="table table-bordered table-striped mt-3">
                <tbody class="firmadakiler">

                </tbody>
            </table>
        </div>

        <div class="row justify-content-center kullanicilar">
            <h2>Kullanıcılar</h2>

            <!--Kullanıcılar Buraya Gelecek-->
            <table class="table table-bordered table-striped mt-3">
                <tbody class="kullaniciListesi">

                </tbody>
            </table>
        </div>
        <div class="row justify-content-center firmaistekleri">
            <h2>Firma İstekleri</h2>

            <!--Firma İstekleri Buraya Gelecek-->
            <table class="table table-bordered table-striped mt-3">
                <tbody class="isteklistesi">

                </tbody>
            </table>
        </div>

        <div class="row justify-content-center adminler">
            <h2>Adminler</h2>

            <!--Kullanıcılar Buraya Gelecek-->
            <table class="table table-bordered table-striped mt-3">
                <tbody class="adminListesi">

                </tbody>
            </table>
        </div>
    </div>






    <script src="../js/jquery.js"></script>
    <script src="../vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../js/alertify.min.js"></script>
    <script src="../js/admin.js"></script>
    </body>
    </html>



<?php
}else{
    header("location:../kullaniciGiris.php");
}






?>