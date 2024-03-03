$(document).ready(function () {
    // Adiciona um event listener ao clicar no elemento .album
    $('.album').click(function () {
        var totalAlbums = $('.album').length; // Obtém o número total de álbuns
        var albumIndex = totalAlbums - $(this).index() - 1; // Calcula o índice invertido do álbum

        // Requisição AJAX para carregar os dados do arquivo JSON
        $.getJSON('./editor/dados.json', function (data) {
            var album = data[albumIndex]; // Obtém o objeto de dados do álbum

            // Exibe a primeira foto do álbum com sua legenda
            var primeiraFoto = album.images[0];
            $('.foto-container img').attr('src', primeiraFoto.filename);
            $('.foto-container img').attr('alt', primeiraFoto.caption);
            $('.legenda span').text(primeiraFoto.caption);

            // Atualiza o carrossel de fotos com as imagens do álbum selecionado
            var fotosHTML = '';
            $.each(album.images, function (index, photo) {
                fotosHTML += '<li class="foto"><img src="' + photo.filename + '" alt="' + photo.caption + '"></li>';
            });
            $('.fotos-lista').html(fotosHTML);

            // Adiciona a classe "selecionada" à primeira foto por padrão
            $('.foto').first().addClass('selecionada');

            // Mostra o popup
            $('#album').show();
            $('body').addClass('overflow-hidden');
        });
    });

    // Atualiza a legenda ao clicar em uma foto
    $(document).on('click', '.foto', function () {
        // Remove a classe "selecionada" de todas as fotos
        $('.foto').removeClass('selecionada');

        // Adiciona a classe "selecionada" à foto clicada
        $(this).addClass('selecionada');

        var fotoSrc = $(this).find('img').attr('src');
        var fotoAlt = $(this).find('img').attr('alt');
        $('.foto-container img').attr('src', fotoSrc);
        $('.foto-container img').attr('alt', fotoAlt);
        $('.legenda span').text(fotoAlt);
    });

    $('#album .close-popup').click(function () {
        // Esconde o popup
        $('#album').hide();
        // Remove a classe do body para restaurar o overflow
        $('body').removeClass('overflow-hidden');
    });

});