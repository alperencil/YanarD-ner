$(function () {
firmalariGoster();
firmaSahipleriGetir();
});
function firmalariGoster() {
$(".firmalar").show();
$(".firmaSahipleri").hide();
    $("#firmaSahibiModalBtn").hide();
    $("#firmaModalBtn").show();
    $(".kullanicilar").hide();
    $(".adminler").hide();
    $("#adminModalBtn").hide();
    $(".firmaistekleri").hide();
    $(".isteklistesi").hide();

    firmalariGetir();
}
function istekleriGoster() {
    $(".firmalar").hide();
    $(".firmaSahipleri").hide();
    $("#firmaSahibiModalBtn").hide();
    $("#firmaModalBtn").hide();
    $(".kullanicilar").hide();
    $(".adminler").hide();
    $("#adminModalBtn").hide();
    $(".firmaistekleri").show();
    $(".isteklistesi").show();
    istekleriGetir();

};
function firmaSahipleriGoster() {
    $(".firmalar").hide();
    $(".firmaSahipleri").show();
    $("#firmaSahibiModalBtn").show();
    $("#firmaModalBtn").hide();
    $(".kullanicilar").hide();
    $(".adminler").hide();
    $("#adminModalBtn").hide();
    $(".firmaistekleri").hide();
    $(".isteklistesi").hide();

    firmaSahipleriGetirSayfa();
}
function adminleriGoster() {
    $(".firmalar").hide();
    $(".firmaSahipleri").hide();
    $("#firmaSahibiModalBtn").hide();
    $("#firmaModalBtn").hide();
    $(".kullanicilar").hide();
    $(".adminler").show();
    $("#adminModalBtn").show();
    $(".firmaistekleri").hide();
    $(".isteklistesi").hide();
    adminleriGetir();
}


function firmalariGetir() {
    $(".firmalar").html("");
    $.ajax({
        url:"../Model/firmalar.php",
        type:"GET",
        dataType:"json",
        data:{
            "hepsi":22
        },
        success:function (donenDeger) {
            for (var i=0;i<donenDeger.firmalar.length;i++){
                var firmaId = donenDeger.firmalar[i].firmaId;
                $(".firmalar").append("  <div class=\"col-3\">\n" +
                    "            <div class=\"card text-center\" >\n" +
                    "                <img src=\"https://via.placeholder.com/150x150\" class=\"card-img-top\" alt=\"...\">\n" +
                    "                <div class=\"card-body\">\n" +
                    "                    <h5 class=\"card-title\">"+donenDeger.firmalar[i].firmaAdi+"</h5>\n" +
                    "                    <a href=\"#\" class=\"btn btn-danger btn-block\" onclick='firmaSil("+firmaId+")' ><i class=\"fas fa-trash-alt\"></i>&nbsp;Firmayı Sil</a>\n" +
                    "                    <a href=\"#\" class=\"btn btn-primary btn-block\" onclick='firmaDetayGetir("+firmaId+")' ><i class=\"fas fa-wrench\"></i>&nbsp;Firmayı Güncelle</a>\n" +
                    "                </div>\n" +
                    "            </div>\n" +
                    "            </div>")
            }
        },
        error:function (hata) {
            console.log(hata.responseJSON.hataMesaji);
        }

    })
}

function firmaDetayGetir(gelenId) {

    var id = gelenId;

    $.ajax({
        url:"../Model/firmalar.php",
        dataType:"json",
        type:"GET",
        data:{"firmaId":id},
        success:function (donenDeger) {
            var adi = donenDeger.firmalar.firmaAdi;
            var adresi = donenDeger.firmalar.adres;
            var teli = donenDeger.firmalar.telefon;
            console.log(id+","+adi+","+adresi+","+teli);
        $("#gelenGizliId").val(id);
        $("#gelenFirmaAdim").val(adi);
        $("#gelenFirmaAdresim").val(adresi);
        $("#gelenFirmaTelim").val(teli);
        },
        error:function (hata) {
            alertify.error(hata.responseJSON.hataMesaji);
        },
        complete:function () {
        $("#firmaGuncelleModal").modal("show");
        }
    })
}

function firmaGuncelleBtn() {
    var id = $("#gelenGizliId").val();
    var adi = $("#gelenFirmaAdim").val();
    var adres = $("#gelenFirmaAdresim").val();
    var telefon = $("#gelenFirmaTelim").val();

    $.ajax({
        url:"../Model/firmalar.php",
        type:"PUT",
        dataType:"json",
        contentType: "application/json",
        data:JSON.stringify({
            "firmaId":id,
            "firmaAdi":adi,
            "adres":adres,
            "telefon":telefon
        }),
        success:function (donenDeger) {
            alertify.success(donenDeger.firmalar);
        },
        error:function (hata) {
            alertify.error(hata.responseJSON.hataMesaji);
        },
        complete:function () {
            $("#gelenGizliId").val("");
            $("#gelenFirmaAdim").val("");
            $("#gelenFirmaAdresim").val("");
            $("#gelenFirmaAdresim").val("");

            $("#firmaGuncelleModal").modal("hide");

            $(".firmalar").html("");
            firmalariGetir();
        }

    })

}
function firmaSil(firmaId) {
var firmaNo = firmaId;
$.ajax({
    url:"../Model/firmalar.php?firmaId="+firmaNo,
    type: "DELETE",
    dataType: "json",
    success:function (donenDeger) {
    alertify.success(donenDeger.firmalar);
    },
    error:function (hata) {
    alertify.error(hata.responseJSON.hataMesaji);
    },
    complete:function () {
    $(".firmalar").html("");
    firmalariGetir();
    }
})
}

$("#firmaEkleBtn").on("click",function () {
    var firmaAdi = $("#firmaAdi").val();
    var adres = $("#adres").val();
    var telefon = $("#telefon").val();
    var firmaId = $("#firmaSahibi").val();
    $.ajax({
        url:"../Model/firmalar.php",
        type:"POST",
        dataType:"json",
        data:{
            "firmaAdi":firmaAdi,
            "adres":adres,
            "telefon":telefon,
            "firmaId":firmaId
        },
        success:function (donenDeger) {
            alertify.success(donenDeger.firmalar);
        },
        error:function (hata) {
            alertify.error(hata.responseJSON.hataMesaji);
        },
        complete:function () {
           $("#firmaAdi").val("");
            $("#adres").val("");
            $("#telefon").val("");
            $("#firmaSahibi").val("");

            $("#firmaEkleModal").modal("hide");
            $(".firmalar").html("");
            firmalariGetir();


        }
    })
});


function firmaSahipleriGetir() {
    $.ajax({
        url:"../Model/firma.php",
        type:"GET",
        dataType:"json",
        data:{
            "firmalarim":22
        },
        success:function (donenDeger) {
            for(var i=0;i<donenDeger.firma.length;i++){
            $("#firmaSahibi").append("<option value="+donenDeger.firma[i].isletmeId+">"+donenDeger.firma[i].isletmeMail+"</option>");
            }
        },
        error:function (hata) {
            console.log(hata);
        }
    })
}
function firmaSahipleriGetirSayfa() {
    $(".firmadakiler").html("");
    $.ajax({
        url:"../Model/firma.php",
        type:"GET",
        dataType:"json",
        data:{
            "firmalarim":22
        },
        success:function (donenDeger) {

            for(var i=0;i<donenDeger.firma.length;i++){
                var id = donenDeger.firma[i].isletmeId;
                var mail = donenDeger.firma[i].isletmeMail;
                var pass = donenDeger.firma[i].isletmePass;

                $(".firmadakiler").append("<tr>\n" +
                    "                        <td class=\"align-middle text-center\" colspan=\"3\">"+donenDeger.firma[i].isletmeMail+"</td>\n" +
                    "\n" +
                    "                        <td class=\"align-middle\" colspan=\"1\"><a class=\"btn btn-danger btn-block\" onclick='firmaSahibiSil("+donenDeger.firma[i].isletmeId+")'><i class=\"fas fa-trash-alt\"></i>&nbsp;Firma Sahibini Sil</a>" +
                    "<a class=\"btn btn-success btn-block\" onclick='firmaSahibiModalDoldur("+id+")'  data-toggle='modal' data-target='#firmaSahibiGuncelle'><i class=\"fas fa-wrench\"></i>&nbsp;Firma Sahip Bilgilerini Güncelle</a></td>\n" +
                    "                    </tr>");

            }
        },
        error:function (hata) {
            console.log(hata);
        }
    })
}


function firmaSahibiSil(gelenId) {
    var id = gelenId;
    $.ajax({
        url:"../Model/firma.php?isletmeId="+id,
        dataType:"json",
        type:"DELETE",
        success:function (donenDeger) {
            alertify.success(donenDeger.isletme);
        },
        error:function (hata) {
            alertify.error(hata.responseJSON.hataMesaji);
        },
        complete:function () {
            firmaSahipleriGetirSayfa();
        }
    })

}

function firmaSahibiGuncelle() {
    var id = $("#isletmeSahibiId").val();
    var Mail = $("#isletmeSahibiMail").val();
    var Pass = $("#isletmeSahibiPass").val();

    $.ajax({
        url:"../Model/firma.php",
        type:"PUT",
        data:JSON.stringify({"isletmeId":id,"isletmeMail":Mail,"isletmePass":Pass}),
        dataType:"json",
        contentType:"application/json",
        success:function (donenDeger) {
             alertify.success(donenDeger.isletme);
        },
        error:function (hata) {
        alertify.error(hata.responseJSON.hataMesaji);
             alertify.error(hata.responseJSON.hataMesaji);
        },
        complete:function () {
            $("#isletmeSahibiId").html("");
            $("#isletmeSahibiMail").html("");
            $("#isletmeSahibiPass").html("");
        $("#firmaSahibiGuncelle").modal("hide");
        firmaSahipleriGetirSayfa();
        }

    })
}
//$("#firmaSahibiGuncelle").modal('hide');
//TODO : Firma Sahibi Güncelleme Çalışmıyor Düzeltilecek.

function firmaSahibiModalDoldur(gelenId) {
var id = gelenId;

$.ajax({
    url:"../Model/firma.php",
    type:"GET",
    dataType:"json",
    data:{
        "isletmeId":id
    },
    success:function (donenDeger) {
        $("#isletmeSahibiId").val(id);
        $("#isletmeSahibiMail").val(donenDeger.firma.isletmeMail);
        $("#isletmeSahibiPass").val(donenDeger.firma.isletmePass);
    },
    error:function (hata) {
    alertify.error(hata.responseJSON.hataMesaji);
    }
});

}

function firmaSaibiEkle() {
    var Mail = $("#firmaSahibiMailEkle").val();
    var Pass = $("#firmaSahibiPassEkle").val();

    $.ajax({
        url:"../Model/firma.php",
        type:"POST",
        dataType:"json",
        data:{
            "isletmeMail":Mail,
            "isletmePass":Pass
        },
        success:function (donenDeger) {
            alertify.success(donenDeger.isletme);
        },
        error:function (hata) {
            console.log(hata.responseJSON.hataMesaji);
            console.log(Mail);
            console.log(Pass);
        },
        complete:function () {
            $("#firmaSahibiMailEkle").val("");
            $("#firmaSahibiPassEkle").val("");
            $("#firmaSahibiEkle").modal("hide");
            firmaSahipleriGetirSayfa();
        }
    })
}

function kullaniciSayfasiGoster() {
    $(".firmalar").hide();
    $(".firmaSahipleri").hide();
    $("#firmaSahibiModalBtn").hide();
    $("#firmaModalBtn").hide();
    $(".kullanicilar").show();
    $(".adminler").hide();
    $("#adminModalBtn").hide();
    $(".firmaistekleri").hide();
    $(".isteklistesi").hide();

    kullanicilariGetirSayfaya();
}

function kullanicilariGetirSayfaya() {
    $(".kullaniciListesi").html("");
    $(".kullaniciListesi").show();

    $.ajax({
        url:"../Model/kullanici.php",
        type:"GET",
        dataType:"json",
        data:{
            "tumuyeler":22
        },
        success:function (donenDeger) {

            for(var i=0;i<donenDeger.uyeler.length;i++){
                var id = donenDeger.uyeler[i].kullaniciId;
                var mail = donenDeger.uyeler[i].kullaniciAdi;
                var pass = donenDeger.uyeler[i].kullaniciSifre;

                $(".kullaniciListesi").append("<tr>\n" +
                    "                        <td class=\"align-middle text-center\" colspan=\"3\">"+donenDeger.uyeler[i].kullaniciAdi+"</td>\n" +
                    "\n" +
                    "                        <td class=\"align-middle\" colspan=\"1\"><a class=\"btn btn-danger btn-block\" onclick='kullaniciSil("+donenDeger.uyeler[i].kullaniciId+")'><i class=\"fas fa-trash-alt\"></i>&nbsp;Kullanıcıyı  Sistemden Sil</a>" +
                    "<a class=\"btn btn-success btn-block\" onclick='kullaniciModalDoldur("+id+")'  data-toggle='modal' ><i class=\"fas fa-wrench\"></i>&nbsp;Kullanıcının Bilgilerini Güncelle</a></td>\n" +
                    "                    </tr>");

            }
        },
        error:function (hata) {
            console.log(hata);
        }
    })

}

function kullaniciSil(gelenId){
    var id = gelenId;


    $.ajax({
        url:"../Model/kullanici.php?kullaniciId="+id,
        dataType:"json",
        type:"DELETE",
        success:function (donenDeger) {
            alertify.success(donenDeger.uyeler);
        },
        error:function (hata) {
            alertify.error(hata.responseJSON.hataMesaji);
        },
        complete:function () {
            kullanicilariGetirSayfaya();
        }
    })
}

function kullaniciModalDoldur(gelenId) {
    var id = gelenId;
    $.ajax({
        url:"../Model/kullanici.php",
        type:"GET",
        dataType:"json",
        data:{
            "kullaniciId":id
        },
        success:function (donenDeger) {

            $("#gelenKullaniciId").val(id);
            $("#gelenKullaniciAdi").val(donenDeger.uyeler.kullaniciAdi);
            $("#gelenKullaniciSifre").val(donenDeger.uyeler.kullaniciSifre);
            console.log(id);
            console.log(donenDeger.uyeler.kullaniciAdi);
            console.log(donenDeger.uyeler.kullaniciSifre);

        },
        error:function (hata) {
            alertify.error(hata.responseJSON.hataMesaji);
        },
        complete:function () {
            $("#kullaniciGuncelleModal").modal("show");
        }
    })

}

function kullaniciGuncelle() {
    var id = $("#gelenKullaniciId").val();
    var adi =  $("#gelenKullaniciAdi").val();
    var pass =  $("#gelenKullaniciSifre").val();
    $.ajax({
        url:"../Model/kullanici.php",
        type:"PUT",
        contentType:"application/json",
        dataType:"json",
        data:JSON.stringify({
            "kullaniciId":id,
            "kullaniciAdi":adi,
            "kullaniciSifre":pass

        }),
        success:function (donenDeger) {
            alertify.success(donenDeger.uyeler);
            $("#gelenKullaniciId").val("");
            $("#gelenKullaniciAdi").val("");
            $("#gelenKullaniciSifre").val("");
            $("#kullaniciGuncelleModal").modal("hide");
        },
        error:function (hata) {
            alertify.error(hata.responseJSON.hataMesaji);
        },
        complete:function () {

            kullanicilariGetirSayfaya();
        }
    })

}

function adminleriGetir() {
    $(".adminListesi").html("");
    $.ajax({
        url:"../Model/admin.php",
        dataType:"json",
        type:"GET",
        success:function (donenDeger) {
            for(var i=0;i<donenDeger.adminler.length;i++){
                var id = donenDeger.adminler[i].adminId;
                var mail = donenDeger.adminler[i].adminMail;
                var pass = donenDeger.adminler[i].adminPass;

                $(".adminListesi").append("<tr>\n" +
                    "                        <td class=\"align-middle text-center\" colspan=\"3\">"+donenDeger.adminler[i].adminMail+"</td>\n" +
                    "\n" +
                    "                        <td class=\"align-middle\" colspan=\"1\"><a class=\"btn btn-danger btn-block\" onclick='adminSil("+donenDeger.adminler[i].adminId+")'><i class=\"fas fa-trash-alt\"></i>&nbsp;Admini  Sistemden Sil</a>" +
                    "<a class=\"btn btn-success btn-block\" onclick='adminModalDoldur("+id+")'  data-toggle='modal' ><i class=\"fas fa-wrench\"></i>&nbsp;Adminin Bilgilerini Güncelle</a></td>\n" +
                    "                    </tr>");

            }
        },
        error:function (hata) {

        }
    })

}

function adminEkle(){
 var Mail =   $("#gelenAdminMail").val();
 var Pass =   $("#gelenAdminPass").val();

 $.ajax({
     url:"../Model/admin.php",
     dataType:"json",
     type:"POST",
     data:{
         "adminMail":Mail,
         "adminPass":Pass
     },
     success:function (donenDeger) {
        alertify.success(donenDeger.adminler);
     },
     error:function (hata) {
        alertify.error(hata.responseJSON.hataMesaji);
     },
     complete:function () {
        $("#gelenAdminMail").val("");
        $("#gelenAdminPass").val("");
        $("#adminEkleModal").modal("hide");
         adminleriGetir();
     }
 })
}

function adminSil(gelenId) {
    var id = gelenId;
    $.ajax({
        url:"../Model/admin.php?adminId="+id,
        type:"DELETE",
        dataType:"json",
        success:function (donenDeger) {
            alertify.success(donenDeger.adminler);
        },
        error:function (hata) {
            alertify.error(hata.responseJSON.hataMesaji);
        },
        complete:function () {
        adminleriGetir();
        }
    })
}

function adminModalDoldur(gelenId) {
    $("#adminGuncelleModal").modal("show");
    var id = gelenId;
    $.ajax({
        url:"../Model/admin.php",
        type:"GET",
        dataType:"json",
        data:{
            "adminId":id
        },
        success:function (donenDeger) {
            $("#guncellenenAdminId").val(donenDeger.adminler.adminId);
            $("#guncellenenAdminMail").val(donenDeger.adminler.adminMail);
            $("#guncellenenAdminPass").val(donenDeger.adminler.adminPass);
        },
        error:function (hata) {
            alertify.error(hata.responseJSON.hataMesaji);
        }
    })
}

function adminiGuncelle() {
 var id   =  $("#guncellenenAdminId").val();
 var mail =  $("#guncellenenAdminMail").val();
 var pass =  $("#guncellenenAdminPass").val();

 $.ajax({
     url:"../Model/admin.php",
     type:"PUT",
     dataType:"json",
     contentType:"application/json",
     data:JSON.stringify({
         "adminId":id,
         "adminMail":mail,
         "adminPass":pass
     }),
     success:function (donenDeger) {
        alertify.success(donenDeger.adminler);
     },
     error:function (hata) {
        alertify.error(hata.responseJSON.hataMesaji);
     },
     complete:function () {
          $("#guncellenenAdminId").val("");
          $("#guncellenenAdminMail").val("");
          $("#guncellenenAdminPass").val("");
          $("#adminGuncelleModal").modal("hide");
        adminleriGetir();
     }
 })


}

function istekleriGetir() {
    $(".isteklistesi").html("");
    $.ajax({
        url:"../Model/firmaistek.php",
        type:"GET",
        dataType:"json",
        success:function (donenDeger) {
            console.log(donenDeger);
            for(var i=0;i<donenDeger.istekler.length;i++){
                $(".isteklistesi").append(" <tr>\n" +
                    "                        <td>"+donenDeger.istekler[i].telefon+"</td>\n" +
                    "                        <td>"+donenDeger.istekler[i].metin+"</td>\n" +
                    "                    </tr>");
            }

        },
        error:function (hata) {
            $(".isteklistesi").append("<tr><td colspan='2'>İstek bulunmuyor.</td></tr>");
        }
    })
}

function hakkimizdaModalAc() {
    $.ajax({
        url:"../Model/hakkimizda.php",
        type:"GET",
        dataType:"json",
        success:function (donenDeger) {
            $("#hakkimizdaBaslik").val(donenDeger.hakkimizda.hakkimizdaBaslik);
            $("#hakkimizdaMetin").val(donenDeger.hakkimizda.hakkimizdaMetin);
        },
        error:function (hata) {
            alertify.error(hata.responseJSON.hataMesaji);
        },
        complete:function () {
            $("#hakkimizdaGuncelleModal").modal("show");
        }
    })

}

function hakkimizdaGuncelle() {
    var baslik = $("#hakkimizdaBaslik").val();
    var metin  = $("#hakkimizdaMetin").val();

    $.ajax({
        url:"../Model/hakkimizda.php",
        type:"PUT",
        dataType:"json",
        contentType:"application/json",
        data:JSON.stringify({
            "hakkimizdaBaslik":baslik,
            "hakkimizdaMetin":metin
        }),
        success:function (donenDeger) {
            alertify.success(donenDeger.hakkimizda);
        },
        error:function (hata) {
            alertify.error(hata.responseJSON.hataMesaji);
        },
        complete:function () {
           $("#hakkimizdaBaslik").val("");
           $("#hakkimizdaMetin").val("");
           $("#hakkimizdaGuncelleModal").modal("hide");
        }
    })
}