//Porfolio isotope and filter
$(window).on("load", function () {
  //   var portfolioIsotope = $(".gallery-container").isotope({
  //     itemSelector: ".gallery-item",
  //     layoutMode: "fitRows",
  //   });

  // Initiate venobox (lightbox feature used in portofilo)
  $(document).ready(function () {
    $(".venobox").venobox();
  });
});

$(".page-scroll").on("click", function (e) {
  var tujuan = $(this).attr("href");

  var elemenTujuan = $(tujuan);

  $("html , body").animate({
    scrollTop: elemenTujuan.offset().top - 50,
  });

  e.preventDefault();
});
