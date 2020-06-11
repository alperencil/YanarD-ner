$(function () {
    baslangicGizle();
})

function baslangicGizle(){
    $("#kullanicikayit").hide();
    $("#firmagiris").hide();
    $("#admingiris").hide();
}

function kullaniciKayitGoster() {
    $("#kullanicikayit").show();
    $("#kullanicigiris").hide();
    $("#firmagiris").hide();
    $("#admingiris").hide();

}
function firmaGirisGoster() {
    $("#kullanicikayit").hide();
    $("#kullanicigiris").hide();
    $("#firmagiris").show();
    $("#admingiris").hide();
}
function adminGirisGoster(){
    $("#kullanicikayit").hide();
    $("#kullanicigiris").hide();
    $("#firmagiris").hide();
    $("#admingiris").show();
}
function kullaniciGirisiGoster() {
    $("#kullanicikayit").hide();
    $("#kullanicigiris").show();
    $("#firmagiris").hide();
    $("#admingiris").hide();
}
function kullaniciGiriseAktar(kullaniciAdi,kullaniciSifre) {
    $("#kullanicikayit").hide();
    $("#kullanicigiris").show();
    $("#firmagiris").hide();
    $("#admingiris").hide();
    $("#kullaniciadi").val(kullaniciAdi);
    $("#kullanicisifre").val(kullaniciSifre);
}
function kullaniciGirisYap() {
   var kullaniciAdi = $("#kullaniciadi").val();
   var kullaniciSifre = $("#kullanicisifre").val();

   $.ajax({
       type:"GET",
       dataType:"json",
       url:"Model/kullanici.php",
       data:{
           "kadi":kullaniciAdi,
           "kullanicisifre":kullaniciSifre
       },
       success:function (donenDeger) {
            if(donenDeger.hata==false){
                $(window).attr('location', 'Views/index.php');
            }
       },
       error:function (hata) {
        $("#kullaniciadi").val("");
        $("#kullanicisifre").val("");
       // alertify.error(hata.responseJSON.hataMesaji,200);
       console.log(hata);       }

   })
}

function kullaniciKayitOl() {

  var kullaniciAdi =  $("#kullaniciadikayit").val();
  var kullaniciSifre = $("#kullanicisifrekayit").val();

  $.ajax({
      type:"POST",
      dataType: "json",
      url:"Model/kullanici.php",
      data:{
          "kullaniciadi":kullaniciAdi,
          "kullanicisifre":kullaniciSifre
      },
      success:function (donenDeger) {
          console.log(donenDeger);
          $("#kullaniciadikayit").val("");
          $("#kullanicisifrekayit").val("");
          kullaniciGiriseAktar(kullaniciAdi,kullaniciSifre);
          alertify.success("Kullanıcı kaydedildi , giriş yapabilirsiniz.",200);
      },
      error:function (hata) {

          console.log(hata.responseJSON.hataMesaji);
          alertify.error(hata.responseJSON.hataMesaji,200);

      }
  })
}

function firmaGirisYap() {
    var firmaMail = $("#firmamail").val();
    var firmaSifre = $("#firmasifre").val();

    $.ajax({
        url:"Model/firma.php",
        type:"GET",
        dataType:"json",
        data:{
            "firmamail":firmaMail,
            "firmasifre":firmaSifre
        },
        success:function (donenDeger) {
            if(donenDeger.hata==false){
                $(window).attr('location', 'Views/firma.php');
            }
        },
        error:function (hata) {
            alertify.error(hata.responseJSON.hataMesaji,200);
        }
    })

}

function adminGirisYap() {

    var adminMail =$("#adminmail").val();
    var adminPass =$("#adminsifre").val();

    $.ajax({
        type:"GET",
        url:"Model/admin.php",
        dataType:"json",
        data:{
            "adminmail":adminMail,
            "adminpass":adminPass
        },
        success:function (donenDeger) {
            if(donenDeger.hata==false){
                $(window).attr('location', 'Views/admin.php');
            }
        },
        error:function (hata) {
           // alertify.error(hata.responseJSON.hataMesaji);
            console.log(hata);
        }
    })

}