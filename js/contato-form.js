$(document).ready(function() {
    // Adiciona um evento de clique ao botão "Enviar"
    $('#enviar').click(function(event) {
        // Executa sua lógica de validação aqui
        if (!validarFormulario()) {
            // Se o formulário não for válido, impede o envio padrão
            event.preventDefault();
        } else {
            // Se o formulário for válido, envia-o programaticamente
            $('#contact-form').submit();
        }
        console.log('enviou');
    });

    // Função para validar o formulário
    function validarFormulario() {
        var nome = $('#nome').val();
        var email = $('#email').val();
        var mensagem = $('#mensagem').val();

        // Verifica se todos os campos estão preenchidos
        if (nome === '' || email === '' || mensagem === '') {
            alert('Por favor, preencha todos os campos.');
            return false;
        }

        // Verifica se o email é válido
        if (!isValidEmailAddress(email)) {
            alert('Por favor, insira um endereço de email válido.');
            return false;
        }

        // Se passar pela validação, retorna true
        return true;
    }

    // Função para verificar se um endereço de e-mail é válido
    function isValidEmailAddress(emailAddress) {
        var pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return pattern.test(emailAddress);
    }
});
