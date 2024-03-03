document.addEventListener('DOMContentLoaded', function() {
    // Captura todos os itens <li> dentro do menu de navegação
    const itensMenu = document.querySelectorAll('nav ul li');

    // Captura o botão "Saiba mais"
    const saibaMaisButton = document.getElementById('saiba-mais');

    // Captura o botão "Contato"
    const contatoButton = document.getElementById('contato');
    
    // Adiciona um controlador de eventos de clique a cada item <li> do menu de navegação
    itensMenu.forEach(item => {
        item.addEventListener('click', rolarParaSeccaoLi);
    });

    // Adiciona um controlador de eventos de clique ao botão "Saiba mais"
    saibaMaisButton.addEventListener('click', rolarParaSeccao);

    // Adiciona um controlador de eventos de clique ao botão "Contato"
    contatoButton.addEventListener('click', rolarParaSeccao);

    function rolarParaSeccaoLi(evento) {
        
        // Obtém o atributo href do link clicado
        const idAlvo = this.querySelector('a').getAttribute('href');

        // Encontra o elemento correspondente à seção
        const seccaoAlvo = document.querySelector(idAlvo);

        // Verifica se a seção correspondente foi encontrada
        if (seccaoAlvo) {
            // Usa o scrollIntoView() para rolar suavemente até a seção correspondente
            seccaoAlvo.scrollIntoView({ behavior: 'smooth' });
        }
    }

    function rolarParaSeccao(evento) {
        
        // Obtém o atributo href do botão "Saiba mais"
        const idAlvo = this.getAttribute('href');

        // Encontra o elemento correspondente à seção "Sobre nós"
        const seccaoAlvo = document.querySelector(idAlvo);

        // Verifica se a seção correspondente foi encontrada
        if (seccaoAlvo) {
            // Usa o scrollIntoView() para rolar suavemente até a seção correspondente
            seccaoAlvo.scrollIntoView({ behavior: 'smooth' });
        }
    }
});
