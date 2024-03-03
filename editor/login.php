<?php
session_start();

// Verifica se o usuário já está logado, se sim, redireciona para a página de boas-vindas
if (isset($_SESSION['username'])) {
    header("Location: http://localhost/sindicatos/seses/editor");
    exit;
}

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize e limpa os dados de entrada
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Verifica as credenciais (substitua pelos seus próprios dados)
    $username_correto = "admin";
    $password_correta = "admin123";

    if ($username === $username_correto && $password === $password_correta) {
        // Autenticação bem-sucedida, inicia a sessão
        $_SESSION['username'] = $username;
        header("Location: http://localhost/sindicatos/seses/editor");
        exit;
    } else {
        $error = "Credenciais inválidas";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Administrador</title>
    <!-- Adicionando o Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilo customizado para centralizar o conteúdo */
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        form {
            width: 100%;
            max-width: 400px;
        }
    </style>
</head>
<body>
    <div class="container" style="width: fit-content;">
        <img src="../img/logo.png" width="300px" style="margin: 50px auto; margin-top: 0;" alt="">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="username">Usuário:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
    </div>
    <!-- Adicionando o Bootstrap JavaScript e o jQuery (opcional, necessário para funcionalidades avançadas do Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

