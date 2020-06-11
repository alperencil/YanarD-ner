$(function () {
    alertify.success("Site açıldı",20);
    firmalariGetir();
    dovizCek();
});

function hakkimizdaGetir() {
    $(".hakkimizdaContainer").show();
    $(".firmaContainer").hide();
    $(".firmaDetayContainer").hide();
    $(".dovizContainer").hide();
    $("#firmaAra").hide();

    $.ajax({
        url:"../Model/hakkimizda.php",
        type:"GET",
        dataType:"json",
        success:function (donenDeger) {
            $(".hbaslik").text(donenDeger.hakkimizda.hakkimizdaBaslik);
            $(".hmetin").text(donenDeger.hakkimizda.hakkimizdaMetin);
        },
        error:function (hata) {

        }
    })

}
function dovizGoster() {
    $(".firmaContainer").hide();
    $(".firmaDetayContainer").hide();
    $(".dovizContainer").show();
    $(".hakkimizdaContainer").hide();
    $("#firmaAra").hide();
}

function firmalarGoster() {
    $(".firmaContainer").show();
    $(".firmaDetayContainer").hide();
    $(".dovizContainer").hide();
    $(".hakkimizdaContainer").hide();
    $("#firmaAra").show();
    $(".firmaSatir").html("");
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
                $(".firmaSatir").append("  <div class=\"col-3\">\n" +
                    "            <div class=\"card\" >\n" +
                    "                <img src=\"https://via.placeholder.com/150x150\" class=\"card-img-top\" alt=\"...\">\n" +
                    "                <div class=\"card-body\">\n" +
                    "                    <h5 class=\"card-title\">"+donenDeger.firmalar[i].firmaAdi+"</h5>\n" +
                    "                    <p class=\"card-text\">"+donenDeger.firmalar[i].firmaAciklama+"</p>\n" +
                    "                    <a href=\"#\" class=\"btn btn-primary\" onclick='firmaDetayGetir("+firmaId+")' >Firma Detaylarını Gör</a>\n" +
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
function firmalariGetir() {
    $(".firmaContainer").show();
    $(".firmaDetayContainer").hide();
    $(".dovizContainer").hide();
    $(".hakkimizdaContainer").hide();
    $("#firmaAra").show();
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
               $(".firmaSatir").append("  <div class=\"col-3\">\n" +
                   "            <div class=\"card\" >\n" +
                   "                <img src=\""+donenDeger.firmalar[i].firmaFotosu+"\" class=\"card-img-top\" alt=\"...\">\n" +
                   "                <div class=\"card-body\">\n" +
                   "                    <h5 class=\"card-title\">"+donenDeger.firmalar[i].firmaAdi+"</h5>\n" +
                   "                    <p class=\"card-text\">"+donenDeger.firmalar[i].firmaAciklama+"</p>\n" +
                   "                    <a href=\"#\" class=\"btn btn-primary\" onclick='firmaDetayGetir("+firmaId+")' >Firma Detaylarını Gör</a>\n" +
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
function firmaDetayGetir(firmaId) {
    var id = firmaId;
    $(".firmaContainer").hide();
    $(".firmaDetayContainer").show();
    $(".dovizContainer").hide();
    $(".hakkimizdaContainer").hide();
    $("#firmaAra").hide();
    console.log(firmaId);
    puaniGetir(id);
    puanKontrol(id);


    $.ajax({
        url:"../Model/firmalar.php",
        type: "GET",
        data:{
            "firmaId":firmaId,
        },
        dataType: "json",
        success:function (donenDeger) {
            console.log(id);
            $(".firmaIdKismi").html(id);
            $(".firmaDetayAdi").html(donenDeger.firmalar.firmaAdi);
            $(".firmaDetayAdres").html(donenDeger.firmalar.adres);
            $(".firmaDetayResmi").attr("src",donenDeger.firmalar.firmaFotosu);
            $(".firmaDetayTelefon").html(donenDeger.firmalar.telefon);
            $(".firmaDetayAciklama").html(donenDeger.firmalar.firmaAciklama);
        },
        error:function (hata) {
            alertify.error(hata.responseJSON.hataMesaji);
        },
        complete:function () {
            yorumlariGetir();
        }
    })

}
$("#firmaAra").bind('keydown keyup keypress change',function () {

    if($("#firmaAra").val() == ""){
        var ad = $("#firmaAra").val();
        $(".firmaSatir").html("");
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
                    $(".firmaSatir").append("  <div class=\"col-3\">\n" +
                        "            <div class=\"card\" >\n" +
                        "                <img src=\""+donenDeger.firmalar[i].firmaFotosu+"\" class=\"card-img-top\" alt=\"...\">\n" +
                        "                <div class=\"card-body\">\n" +
                        "                    <h5 class=\"card-title\">"+donenDeger.firmalar[i].firmaAdi+"</h5>\n" +
                        "                    <p class=\"card-text\">"+donenDeger.firmalar[i].firmaAciklama+"</p>\n" +
                        "                    <a href=\"#\" class=\"btn btn-primary\" onclick='firmaDetayGetir("+firmaId+")' >Firma Detaylarını Gör</a>\n" +
                        "                </div>\n" +
                        "            </div>\n" +
                        "            </div>")
                }
            },
            error:function (hata) {
                console.log(hata.responseJSON.hataMesaji);
            }

        })
    }else{
        $(".firmaSatir").html("");
        var ad = $("#firmaAra").val();
        $.ajax({
            url:"../Model/firmalar.php",
            type:"GET",
            dataType:"json",
            data:{
                "firmaAdi":ad
            },
            success:function (donenDeger) {
                for (var i=0;i<donenDeger.firmalar.length;i++){
                    var firmaId = donenDeger.firmalar[i].firmaId;
                    $(".firmaSatir").append("  <div class=\"col-3\">\n" +
                        "            <div class=\"card\" >\n" +
                        "                <img src=\""+donenDeger.firmalar[i].firmaFotosu+"\" class=\"card-img-top\" alt=\"...\">\n" +
                        "                <div class=\"card-body\">\n" +
                        "                    <h5 class=\"card-title\">"+donenDeger.firmalar[i].firmaAdi+"</h5>\n" +
                        "                    <p class=\"card-text\">"+donenDeger.firmalar[i].firmaAciklama+"</p>\n" +
                        "                    <a href=\"#\" class=\"btn btn-primary\" onclick='firmaDetayGetir("+firmaId+")' >Firma Detaylarını Gör</a>\n" +
                        "                </div>\n" +
                        "            </div>\n" +
                        "            </div>")
                }
            },
            error:function (hata) {
                $(".firmaSatir").html("");
                $(".firmaSatir").html(" <div class=\"row  justify-content-center border border-danger mt-5\">\n" +
                    "        <div class=\"col-12 p-5 \">\n" +
                    "            <h3>"+hata.responseJSON.hataMesaji+"</h3>\n" +
                    "        </div>\n" +
                    "    </div>");
            }

        })
    }
});


$("#yorumBtn").on("click",function () {
    var yorum =  $("#yorum").val();
    var id = $("#gelenKullaniciId").val();
    var firmaid = $(".firmaIdKismi").text();

    $.ajax({
        url:"../Model/yorumlar.php",
        type:"POST",
        dataType:"json",
        data:{
            "gelenKullaniciId":id,
            "gelenFirmaId":firmaid,
            "gelenYorum":yorum
        },
        success:function (donenDeger) {
            alertify.success(donenDeger.yorumlar);
        },
        error:function (hata) {
            alertify.error(hata.responseJSON.hataMesaji);
        },
        complete:function () {
            yorumlariGetir();
        }
    });
});

function yorumlariGetir() {
    var firmaId = $(".firmaIdKismi").text();

    $.ajax({
        url:"../Model/yorumlar.php",
        type:"GET",
        dataType:"json",
        data:{
            "firmaId":firmaId
        },
        success:function (donenDeger) {
            $(".yorumlarKismi").html("");
            for (var i=0;i<donenDeger.yorumlar.length;i++){
                $(".yorumlarKismi").append("<div class=\"col-8\">\n" +
                    "                <div class=\"media border border-success p-2\">\n" +
                    "                    <div class=\"media-body\">\n" +
                    "                        <h5 class=\"mt-0\">"+donenDeger.yorumlar[i].kullaniciAdi+"</h5>\n" +
                    "                        "+donenDeger.yorumlar[i].yorumMetni+"\n" +
                    "                    </div>\n" +
                    "                </div>\n" +
                    "            </div>")
            }
        },
        error:function (hata) {
            alertify.error(hata.responseJSON.hataMesaji);
            $(".yorumlarKismi").html("");
        }
    })
}

function puaniGetir(gelenId) {
    var firmaId = gelenId;


    $.ajax({
        url:"../Model/puanlar.php",
        type:"GET",
        dataType:"json",
        data:{
            "firmaId":firmaId
        },
        success:function (donenDeger) {
            $("#puanYazisi").html("<h3 style='color:coral'>Puan Ortalaması :<u>"+donenDeger.puanlar.ort+"</u></h3>");
            
        },
        error:function (hata) {
            console.log(hata.responseJSON.hataMesaji);
            $("#puanYazisi").html("<h3 style='color: darkred'>"+hata.responseJSON.hataMesaji+"</h3>");
            $("#puanlar").show();
            $(".puanGonder").show();
            $(".verilmisPuan").hide();

        }
    })


}


function puanKontrol(gelenFirmaId) {
    var id = $("#gelenKullaniciId").val();
    var gelenFirmaId = gelenFirmaId;
    $.ajax({
        url:"../Model/puanlar.php",
        type:"GET",
        dataType:"json",
        data:{
            "firma":gelenFirmaId,
            "puanYapanId":id,
        },
        contentType:"application/json",
        success:function (donenDeger) {


               $(".verilecekPuan").hide();
               $(".verilmisPuan").show();
               $(".verilmisPuan").html("<h2>Vermiş olduğunuz puan :"+donenDeger.puanlar.puan+"</h2>")



        },
        error:function (hata) {
            console.log(hata);
            $(".verilmisPuan").show();
            $(".verilmisPuan").html("Henüz puan vermediniz.");
            $(".verilecekPuan").show();
        }
    });

}


$(".puanGonder").on("click",function () {
    var id = $("#gelenKullaniciId").val();
    var firmaid = $(".firmaIdKismi").text();
    var puan = $("#puanlar").val();

    console.log("Kullanıcı ID :"+id);
    console.log("Firma No :"+firmaid);
    console.log("Puan :"+puan);



     $.ajax({
       url:"../Model/puanlar.php",
       type:"POST",
       dataType:"json",
       data:{
           "puan":puan,
           "puanYapanId":id,
           "firmaId":firmaid

       },
         success:function (donenDeger) {
            alertify.success(donenDeger.puanlar);
         },
         error:function (hata) {
            alertify.error(hata.responseJSON.hataMesaji);
         },
         complete:function () {
             puanKontrol(firmaid);
             puaniGetir(firmaid);
         }
   })
});

$("#firmaIstekBtn").on("click",function () {
    var tel = $("#tel").val();
    var metin = $("#metin").val();

    $.ajax({
        url:"../Model/firmaistek.php",
        type:"POST",
        dataType:"json",
        data:{
            "telefon":tel,
            "metin":metin
        },
        success:function (donenDeger) {
            alertify.success(donenDeger.istekler);
        },
        error:function (hata) {
            alertify.error(hata.responseJSON.hataMesaji);
        },
        complete:function () {
            $("#tel").val("");
            $("#metin").val("");
            $("#firmaIstekModal").modal("hide");
        }
    })


});
function dovizCek() {
    var url = "../Model/doviz.php";

    $.ajax({
        url:url,
        type:"GET",
        dataType:"json",
        success:function (donenDeger) {
            console.log(donenDeger);

            $(".dovizYenileme").text("En Son Yenilenme Tarihi : "+donenDeger.guncelleme_tarihi);
           $(".abd").text(donenDeger.abd_dolari.isim);
           $(".abd-satis").text("Satış :"+donenDeger.abd_dolari.satis);
           $(".abd-alis").text("Alış :"+donenDeger.abd_dolari.alis);
           $(".abd-tur").text("Türü :"+donenDeger.abd_dolari.tur);

            $(".euro").text(donenDeger.euro.isim);
            $(".euro-satis").text("Satış :"+donenDeger.euro.satis);
            $(".euro-alis").text("Alış :"+donenDeger.euro.alis);
            $(".euro-tur").text("Türü :"+donenDeger.euro.tur);

            $(".sterlin").text(donenDeger.ingiliz_sterlini.isim);
            $(".sterlin-satis").text("Satış :"+donenDeger.ingiliz_sterlini.satis);
            $(".sterlin-alis").text("Alış :"+donenDeger.ingiliz_sterlini.alis);
            $(".sterlin-tur").text("Türü :"+donenDeger.ingiliz_sterlini.tur);

            $(".rus").text(donenDeger.rus_rublesi.isim);
            $(".rus-satis").text("Satış :"+donenDeger.rus_rublesi.satis);
            $(".rus-alis").text("Alış :"+donenDeger.rus_rublesi.alis);
            $(".rus-tur").text("Türü :"+donenDeger.rus_rublesi.tur);

            $(".a14").text(donenDeger.a14_ayar_altin.isim);
            $(".a14-satis").text("Satış :"+donenDeger.a14_ayar_altin.satis);
            $(".a14-alis").text("Alış :"+donenDeger.a14_ayar_altin.alis);
            $(".a14-tur").text("Türü :"+donenDeger.a14_ayar_altin.tur);

            $(".a18").text(donenDeger.a18_ayarl_altin.isim);
            $(".a18-satis").text("Satış :"+donenDeger.a18_ayarl_altin.satis);
            $(".a18-alis").text("Alış :"+donenDeger.a18_ayarl_altin.alis);
            $(".a18-tur").text("Türü :"+donenDeger.a18_ayarl_altin.tur);

            $(".iran").text(donenDeger.iran_riyali.isim);
            $(".iran-satis").text("Satış :"+donenDeger.iran_riyali.satis);
            $(".iran-alis").text("Alış :"+donenDeger.iran_riyali.alis);
            $(".iran-tur").text("Türü :"+donenDeger.iran_riyali.tur);

            $(".cin").text(donenDeger.cin_yuani.isim);
            $(".cin-satis").text("Satış :"+donenDeger.cin_yuani.satis);
            $(".cin-alis").text("Alış :"+donenDeger.cin_yuani.alis);
            $(".cin-tur").text("Türü :"+donenDeger.cin_yuani.tur);

            $(".gram").text(donenDeger.gram_altin.isim);
            $(".gram-satis").text("Satış :"+donenDeger.gram_altin.satis);
            $(".gram-alis").text("Alış :"+donenDeger.gram_altin.alis);
            $(".gram-tur").text("Türü :"+donenDeger.gram_altin.tur);

            $(".ceyrek").text(donenDeger.ceyrek_altin.isim);
            $(".ceyrek-satis").text("Satış :"+donenDeger.ceyrek_altin.satis);
            $(".ceyrek-alis").text("Alış :"+donenDeger.ceyrek_altin.alis);
            $(".ceyrek-tur").text("Türü :"+donenDeger.ceyrek_altin.tur);

            $(".a22").text(donenDeger.y2_ayar_bilezik.isim);
            $(".a22-satis").text("Satış :"+donenDeger.y2_ayar_bilezik.satis);
            $(".a22-alis-alis").text("Alış :"+donenDeger.y2_ayar_bilezik.alis);
            $(".a22-tur").text("Türü :"+donenDeger.y2_ayar_bilezik.tur);

            $(".gumus").text(donenDeger.gumus.isim);
            $(".gumus-satis").text("Satış :"+donenDeger.gumus.satis);
            $(".gumus-alis").text("Alış :"+donenDeger.gumus.alis);
            $(".gumus-tur").text("Türü :"+donenDeger.gumus.tur);


           /*for(var i=0;i<donenDeger.length;i++){
                $(".dovizSatir").append(" <div class=\"card\" style=\"width: 10rem;\">\n" +
                    "                <div class=\"card-body text-center\">\n" +
                    "                    <h5 class=\"card-title\">"+donenDeger[i].+"</h5>\n" +
                    "                    <hr>\n" +
                    "                    <h6 class=\"card-subtitle mb-2 alis text-muted\">Card subtitle</h6>\n" +
                    "                    <hr>\n" +
                    "                    <h6 class=\"card-subtitle mb-2 veris text-muted\">Card subtitle</h6>\n" +
                    "\n" +
                    "                </div>\n" +
                    "            </div>");
            }*/

        },
        error:function (hata) {
            console.log(hata);
        }
    })
}

$("#geceButonu").on("click",function () {
    $("body,p,h1,h2,h3,h4,h5,h6,a,i,ul,li,table,thead,tbody,tr,th,td,button,div").toggleClass("geceModu");
    $(".btn,button,.card").toggleClass("btnBorder");

});


