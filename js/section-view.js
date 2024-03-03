document.addEventListener('DOMContentLoaded', function() {
    // Captura todas as seções
    const sections = document.querySelectorAll('section');

    // Captura todos os itens <li> dentro do menu de navegação
    const menuItems = document.querySelectorAll('nav ul li');

    // Função para verificar se uma seção está visível na viewport
    function isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        const windowHeight = (window.innerHeight || document.documentElement.clientHeight);
        // Verifica se a parte superior da seção está acima da parte inferior da viewport por pelo menos 120px
        return (
            rect.top < windowHeight - 120 &&
            rect.bottom >= 0
        );
    }

    // Função para adicionar a classe "viewed" ao item do menu correspondente à seção visível
    function updateMenu() {
        let sectionInView = null;

        sections.forEach(section => {
            if (isElementInViewport(section)) {
                sectionInView = section;
            }
        });

        if (sectionInView) {
            const sectionId = sectionInView.getAttribute('id');
            menuItems.forEach(item => {
                const link = item.querySelector('a');
                if (link && link.getAttribute('href') === `#${sectionId}`) {
                    item.classList.add('viewed');
                } else {
                    item.classList.remove('viewed');
                }
            });
        } else {
            menuItems.forEach(item => {
                item.classList.remove('viewed');
            });
        }
    }

    // Adiciona um listener de scroll para atualizar o menu quando a página é rolada
    window.addEventListener('scroll', updateMenu);

    // Atualiza o menu quando a página é carregada
    updateMenu();
});
