$(document).ready(function(){
    // Ao clicar no botão de toggle, mostra ou esconde o menu
    $("#toggle-menu").click(function(){
        $("menu").toggle();
        
        // Verifica se o menu está sendo mostrado ou oculto
        if ($("menu").is(":visible")) {
            $("body").css("overflow", "hidden"); // Oculta o overflow do body
        } else {
            $("body").css("overflow", ""); // Redefine o overflow do body para o padrão
        }
    });

    $("menu .close-popup").click(function(){
        $("menu").toggle();
        
        // Verifica se o menu está sendo mostrado ou oculto
        if ($("menu").is(":visible")) {
            $("body").css("overflow", "hidden"); // Oculta o overflow do body
        } else {
            $("body").css("overflow", ""); // Redefine o overflow do body para o padrão
        }
    });

    // Ao clicar em qualquer link do menu, esconde o menu
    $("menu li a").click(function(){
        $("menu").hide();
        $("body").css("overflow", ""); // Redefine o overflow do body para o padrão
    });
});
