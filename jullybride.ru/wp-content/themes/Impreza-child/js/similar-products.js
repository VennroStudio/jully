/**
 * Карусель «Похожие товары» — как у блока аксессуаров (only-have-carusel).
 */
jQuery(document).ready(function($) {
    if (!$("#similar-products-carusel").length) return;
    var rS = $("#similar-products-carusel").owlCarousel({
        loop: false,
        autoplay: false,
        nav: false,
        dots: false,
        margin: 0,
        autoplayTimeout: 6000,
        autoplayHoverPause: false,
        smartSpeed: 450,
        mouseDrag: true,
        responsive: { 1: { items: 1 }, 768: { items: 3 }, 1000: { items: 3 } }
    });
    function cS() {
        $("#similar-products-carusel .owl-item.second-active").removeClass("second-active");
        var t = rS.find("#similar-products-carusel .owl-item.active:not(.cloned)");
        var o = t.length >= 2 ? t : rS.find(".owl-item.active");
        if (o.length >= 2) o.eq(1).addClass("second-active");
    }
    $("#similar-products_prev").on("click", function() { rS.trigger("prev.owl.carousel"); });
    $("#similar-products_next").on("click", function() { rS.trigger("next.owl.carousel"); });
    $("#similar-products-carusel_prev1").on("click", function() { rS.trigger("prev.owl.carousel"); });
    $("#similar-products-carusel_next1").on("click", function() { rS.trigger("next.owl.carousel"); });
    rS.on("translated.owl.carousel", cS);
    setTimeout(cS, 100);
    $("#similar-products_prev, #similar-products_next").on("click", function() { setTimeout(cS, 50); });
});
