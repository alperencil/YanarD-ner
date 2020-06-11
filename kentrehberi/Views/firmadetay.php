<?php
session_start();

if($_SESSION["kadi"]) {


    ?>

    <html>
    <head>
        <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../vendor/fortawesome/font-awesome/css/all.css">
        <title>
            Anasayfa
        </title>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
        <a class="navbar-brand" href="#">Antalya Kent Rehberi</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Firmalar <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Hava Durumu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Nöbetçi Eczane</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Döviz</a>
                </li>


            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>


  <div class="container ">
      <nav aria-label="breadcrumb ">
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Anasayfa</a></li>
              <li class="breadcrumb-item"><a href="#">Firmalar</a></li>
              <li class="breadcrumb-item active" aria-current="page">Hicaz Pazarı</li>
          </ol>
      </nav>
      <div class="row justify-content-center">
          <div class="col-10">
              <img src="https://via.placeholder.com/1000x400" class="img-fluid" >
          </div>
          <div class="col-10">
              <table class="table table-striped table-bordered">
                 <tbody>
                 <tr>
                     <td class="text-center" colspan="2">Hicaz Pazarı</td>
                 </tr>
                 <tr>
                     <td><i class="fas fa-phone"></i>&nbsp;Telefon Numarası :</td>
                     <td>0(555)007 71 60</td>
                 </tr>
                 <tr>
                     <td><i class="fas fa-map-marker-alt"></i>&nbsp;Adres :</td>
                     <td>Gülverenler mahallesi 2310 sokak no 3 , adıyaman hamamı karşısı.</td>
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
              <button class="btn btn-primary btn-block">Yorumu Gönder</button>
          </div>
      </div>
      <hr>
      <div class="row justify-content-center">
          <div class="col-8 text-center">
              <h3><u>Yorumlar</u></h3>
          </div>

      </div>
      <div class="row justify-content-center">
          <div class="col-8">
              <div class="media border border-success p-2">
                  <div class="media-body">
                      <h5 class="mt-0">Media heading</h5>
                      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                  </div>
              </div>
          </div>
          <div class="col-8">
              <div class="media border border-success p-2">
                  <div class="media-body">
                      <h5 class="mt-0">Media heading</h5>
                      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                  </div>
              </div>
          </div>
          <div class="col-8">
              <div class="media border border-success p-2">
                  <div class="media-body">
                      <h5 class="mt-0">Media heading</h5>
                      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                  </div>
              </div>
          </div>
      </div>

  </div>





    <script src="../vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../js/jquery.js"></script>
    <script src="../js/alertify.min.js"></script>
    </body>
    </html>



    <?php
}else{
    header("location:../kullaniciGiris.php");
}

    ?>
