<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Font Awesome-->
    <link rel="stylesheet" href="vendor/fortawesome/font-awesome/css/all.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/alertify.css">
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <title>Kayıt Ol veya Giriş Yap | Kent Rehberi</title>
</head>
<body>
<div class="container">

    <div class="row align-items-center justify-content-center mt-5">
        <div class="col-5 text-center border kolon">
            <div id="kullanicigiris">
            <h2>Kullanıcı Girişi</h2>
            <div class="form-group">
                <label for="kullaniciadi">Kullanıcı Adı</label>
                <input type="text" class="form-control" id="kullaniciadi">
            </div>
            <div class="form-group">
                <label for="kullanicisifre">Şifre</label>
                <input type="text" class="form-control" id="kullanicisifre">
            </div>
            <button class="btn btn-primary btn-block" onclick="kullaniciGirisYap()">Giriş Yap</button>
            <hr>
            <button onclick="kullaniciKayitGoster()" class="btn btn-warning mb-3"><i class="fas fa-user-circle mr-2"></i>Kullanıcı Kayıt Ol</button>
            <button onclick="firmaGirisGoster()" class="btn btn-success mb-3"><i class="fas fa-building mr-2"></i>Firma Girişi</button>

            <button onclick="adminGirisGoster()" class="btn btn-info mb-3"><i class="fas fa-unlock mr-2"></i>Admin Girişi</button>
            </div>

        <div id="kullanicikayit">
            <h2>Kullanıcı Kayıt Ol</h2>
            <div class="form-group">
                <label for="kullaniciadikayit">Kullanıcı Adı</label>
                <input type="text" class="form-control" id="kullaniciadikayit">
            </div>
            <div class="form-group">
                <label for="kullanicisifrekayit">Şifre</label>
                <input type="text" class="form-control" id="kullanicisifrekayit">
            </div>
            <button class="btn btn-primary btn-block" onclick="kullaniciKayitOl()">Kayıt Ol</button>
            <hr>
            <button onclick="kullaniciGirisiGoster()" class="btn btn-warning mb-3"><i class="fas fa-user-circle mr-2"></i>Kullanıcı Giriş Yap</button>
            <button onclick="firmaGirisGoster()" class="btn btn-success mb-3"><i class="fas fa-building mr-2"></i>Firma Girişi</button>

            <button onclick="adminGirisGoster()" class="btn btn-info mb-3"><i class="fas fa-unlock mr-2"></i>Admin Girişi</button>
        </div>

    <div id="firmagiris">
        <h2>Firma Girişi</h2>
        <div class="form-group">
            <label for="firmamail">Firma Maili</label>
            <input type="text" class="form-control" id="firmamail">
        </div>
        <div class="form-group">
            <label for="firmasifre">Şifre</label>
            <input type="text" class="form-control" id="firmasifre">
        </div>
        <button class="btn btn-primary btn-block" onclick="firmaGirisYap()">Firma Girişi Yap</button>
        <hr>
        <button onclick="kullaniciGirisiGoster()" class="btn btn-warning mb-3"><i class="fas fa-user-circle mr-2"></i>Kullanıcı Girişi</button>
        <button onclick="kullaniciKayitGoster()" class="btn btn-success mb-3"><i class="fas fa-building mr-2"></i>Kullanıcı Kayıt Ol</button>

        <button onclick="adminGirisGoster()" class="btn btn-info mb-3"><i class="fas fa-unlock mr-2"></i>Admin Girişi</button>
    </div>

    <div id="admingiris">
        <h2>Admin Girişi</h2>
        <div class="form-group">
            <label for="adminmail">Admin Maili</label>
            <input type="text" class="form-control" id="adminmail">
        </div>
        <div class="form-group">
            <label for="adminsifre">Şifre</label>
            <input type="text" class="form-control" id="adminsifre">
        </div>
        <button class="btn btn-primary btn-block" onclick="adminGirisYap()">Giriş Yap</button>
        <hr>
        <button onclick="kullaniciGirisiGoster()" class="btn btn-warning mb-3"><i class="fas fa-user-circle mr-2"></i> Kullanıcı Girişi</button>
        <button onclick="kullaniciKayitGoster()" class="btn btn-success mb-3"><i class="fas fa-building mr-2"></i>Kullanıcı Kayıt Ol</button>

        <button onclick="firmaGirisGoster()" class="btn btn-info mb-3"><i class="fas fa-unlock mr-2"></i>Firma Girişi</button>

    </div>
        </div>
    </div>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/alertify.js"></script>
<script src="js/jquery.js"></script>
<script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/giriskayit.js"></script>
</body>
</html>
