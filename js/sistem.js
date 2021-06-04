function sifreIste(SITE) {
  var mailadresi=$(".sifremail").val();
  $.ajax({
     method:"POST",
     url:SITE+"ajax.php",
     data:{"mailadresi":mailadresi,"islemtipi":"sifreIste"},
     success: function(sonuc)
     {
       if(sonuc=="TAMAM")
       {
        window.location.href = SITE+"sifre-belirle/dogulama";
       }
       else
       {
         swal("İşlem Geçersiz!", "İşleminiz şuan geçersizdir. Lütfen daha sonra tekrar deneyiniz.", "warning");
       }
     }
   });
}

$("#forgot").on("click", function () {
		$("#forgot_pw").fadeToggle("fast");
	});
	
	function myFunction() {
  // Declare variables
  var input, filter, ul, li, a, i, txtValue;
  input = document.getElementById('myInput');
  filter = input.value.toUpperCase();
  ul = document.getElementById("myUL");
  li = ul.getElementsByTagName('li');

  // Loop through all list items, and hide those who don't match the search query
  for (i = 0; i < li.length; i++) {
    a = li[i].getElementsByTagName("a")[0];
    txtValue = a.textContent || a.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}

$(function(){
	
// toplam li sayısı
var toplamLi = $("div.uniList").size();

// sayfa veri sayısı
var veriSayisi = 30;

// Sayfalamayı uygula
$("div.uniList:gt(" + (veriSayisi - 1) + ")").hide();

// sayfa sayısı bulalım
var sayfaSayisi = Math.ceil(toplamLi / veriSayisi);

// sayıyı yuvarlayalım
// Sayfa linklerini ekleyelim
for (var i = 1; i <= sayfaSayisi; i++)
{
        $("#sayfalama").append('<li><a href="javascript:void(0)">'+ i +'</a></li>');
}

// İlk sayfaya aktif classı ekle
$("#sayfalama a:first").addClass("aktif");

// Sayfalama içindeki a'lardan birine tıklandığında
$(document.body).on("click", "#sayfalama li", function(){
    // indis değerini al (1 fazlası şeklinde)
    var indis = $(this).index() + 1;
    // toplam gözüken veri sayısını bul
    var gt = veriSayisi * indis;
    // aktif class işlemleri
    $("#sayfalama li").removeClass("aktif");
    $(this).addClass("aktif");
    // listedeki tüm lileri gizle
    $("div.uniList").hide();
    // for ile toplam gözüken veri sayısı - veriSayisi işlemi yap ve veriSayisi kadarını göster
    for (i = gt - veriSayisi; i < gt; i++)
    {
        $("div.uniList:eq("+i+")").show();
    }
});


});