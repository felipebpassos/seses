<?php
// Importa a classe do PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Carrega o autoload do Composer para carregar as classes do PHPMailer
require 'vendor/autoload.php';

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $assunto = filter_var($_POST["assunto"], FILTER_SANITIZE_STRING);
    $mensagem = filter_var($_POST["mensagem"], FILTER_SANITIZE_STRING);

    // Cria uma nova instância do PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Substitua pelo seu servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'felipebpassos@gmail.com'; // Substitua pelo seu email
        $mail->Password = 'ipsa oakc ojwo usgu'; // Substitua pela sua senha
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        // Define o remetente e o destinatário
        $mail->setFrom('felipebpassos@gmail.com', 'Seu Nome');
        $mail->addAddress('felipebpassos@gmail.com');

        // Define o assunto e o corpo do e-mail
        $mail->Subject = 'Novo contato do site';
        $mail->Body = "Assunto: $assunto\nMensagem:\n$mensagem\n";

        // Envia o e-mail
        $mail->send();
        header("Location: http://localhost/sindicatos/seses?success=Denúncia+enviada+com+sucesso!");
        exit();
    } catch (Exception $e) {
        echo 'Erro ao enviar a mensagem. Por favor, tente novamente mais tarde.';
        // Se quiser depurar possíveis erros, descomente a linha abaixo
        echo 'Erro ao enviar a mensagem: ' . $mail->ErrorInfo;
    }

}
