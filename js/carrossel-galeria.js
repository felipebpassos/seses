$(document).ready(function() {
    var row = $('.row-album');
    var albums = $('.album');
    var albumWidth = $('.album').outerWidth();
    var currentIndex = 0;

    // Verifica se há álbuns à esquerda ou à direita para navegar
    function checkNavigation() {
        if (currentIndex === 0) {
            $('.nav-btn-galeria-left').hide();
        } else {
            $('.nav-btn-galeria-left').show();
        }
        
        if (currentIndex === albums.length - 1) {
            $('.nav-btn-galeria-right').hide();
        } else {
            $('.nav-btn-galeria-right').show();
        }
    }

    // Event listener para o botão de navegação à esquerda
    $('.nav-btn-galeria-left').click(function() {
        if (currentIndex > 0) {
            currentIndex--;
            updateRowPosition();
        }
        checkNavigation();
    });

    // Event listener para o botão de navegação à direita
    $('.nav-btn-galeria-right').click(function() {
        if (currentIndex < albums.length - 1) {
            currentIndex++;
            updateRowPosition();
        }
        checkNavigation();
    });

    // Função para atualizar a posição da linha de álbuns
    function updateRowPosition() {
        var newPosition = -currentIndex * (albumWidth + 40);
        row.css('transform', 'translateX(' + newPosition + 'px)');
    }

    // Inicializa a verificação de navegação
    checkNavigation();
});
