$(function () {

firmaGetir();
})

function firmaGetir() {
 var id =    $(".firmaId").text();

 $.ajax({
     url:"../Model/firmalar.php",
     type:"GET",
     dataType:"json",
     data:{
         "firmaId":id
     },
     success:function (donenDeger) {
         if(donenDeger.firmalar.firmaFotosu == ""){
            $(".firmaresim").attr("src","https://via.placeholder.com/1250x400")
         }else{
            $(".firmaresim").attr("src",donenDeger.firmalar.firmaFotosu)
         }
        $(".firmaAdi").text(donenDeger.firmalar.firmaAdi);
        $(".firmaAciklama").text(donenDeger.firmalar.firmaAciklama);
        $(".firmaAdresi").text(donenDeger.firmalar.adres);
        $(".firmaTelefonu").text(donenDeger.firmalar.telefon);
     },
     error:function (hata) {
        $(".anakapsam").html("Henüz adınıza firma eklenmemiş.Hata Mesajı :"+hata.responseJSON.hataMesaji);
     }
 })
}

function guncelleModalDoldur() {
$("#firmaGuncelleModal").modal("show");
    var aciklama = $(".firmaAciklama").text();
    var foto = $(".firmaresim").attr("src");
    $("#resimGoster").attr("src",foto);
    $("#firmaAciklama").val(aciklama);

    console.log(aciklama);
    console.log(foto);

}

/*$("#firmaGuncelle").on("submit",function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url:"../Model/firmaUpdate.php",
        type:"POST",
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success:function (veri) {
            if(veri == 1){
                console.log("Başarılı");
            }else if(veri == 2){
                console.log("Hatalı");
            }else{
                console.log("Ne oldu bilmiyorum");
            }
        },
        error:function (hata) {
        console.log(hata+"hata");
        },
        complete:function () {
        $("#firmaAciklama").val("");
            firmaGetir();
        }

    })
})*/
