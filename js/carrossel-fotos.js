$(document).ready(function() {
    var fotos = $('.fotos-lista');
    var fotoWidth = $('.foto').outerWidth();
    var numFotos = $('.foto').length;
    var currentIndexFotos = 0;

    $('.nav-btn-left').click(function(){
        if (currentIndexFotos > 0) {
            currentIndexFotos--;
            updateFotosPosition();
        }
    });

    $('.nav-btn-right').click(function(){
        console.log(numFotos);
        if (currentIndexFotos < numFotos - 3) {
            currentIndexFotos++;
            updateFotosPosition();
        }
    });

    function updateFotosPosition() {
        var newPosition = -currentIndexFotos * (fotoWidth + 20); // Considerando a margem de 20px entre as fotos
        fotos.css('transform', 'translateX(' + newPosition + 'px)');
    }
});
