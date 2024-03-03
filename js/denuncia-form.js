$(document).ready(function() {
    // Adiciona um evento de clique ao botão "Denunciar"
    $('#enviar').click(function(event) {
        // Executa sua lógica de validação aqui
        if (!validarFormulario()) {
            // Se o formulário não for válido, impede o envio padrão
            event.preventDefault();
        } else {
            // Se o formulário for válido, envia-o programaticamente
            $('#denunciar-form').submit();
        }
    });

    // Função para validar o formulário
    function validarFormulario() {
        var assunto = $('#assunto').val();
        var mensagem = $('#mensagem').val();

        // Verifica se todos os campos estão preenchidos
        if (assunto === '' || mensagem === '') {
            alert('Por favor, preencha todos os campos.');
            return false;
        }

        // Se passar pela validação, retorna true
        return true;
    }
});
