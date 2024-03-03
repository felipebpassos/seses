<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="PRODUTO NÃO PAGO EM SUA TOTALIDADE - PROPRIEDADE INTELECTUAL DE FELIPE BARRETO PASSOS, PROTEGIDO POR LEI.">
    <meta name="author" content="Felipe Passos | Simplify Web">
    <meta name="keywords"
        content="sindicato, sergipano, comércio, supermercados, supermercado, mercado, trabalho, trabalhadores, comerciários, empregados, trabalhadores, denúncia, denunciar, direitos, sergipe, SE">
    <meta name="robots" content="index,follow">

    <meta property="og:image" content="">
    <meta property="og:title" content="Sindicato dos Empregados em Supermercados no Estado de Sergipe | SESES">
    <meta property="og:description" content="">

    <title>Sindicato dos Empregados em Supermercados no Estado de Sergipe | SESES</title>

    <link rel="icon" href="">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<body>

    <?php
    if (isset($_GET['success'])) {
        // Exibe um alerta Bootstrap com a mensagem de sucesso
        echo '<div id="success-alert" class="alert alert-success fixed-alert" role="alert">' . $_GET['success'] . '</div>';
    }
    ?>

    <header>
        <a href="index.php" class="logo">
            <img src="./img/logo.png" alt="SESES - Logo">
        </a>

        <nav>
            <ul>
                <li><a href="index.php">Sobre nós</a></li>
                <li><a href="index.php">Diretoria</a></li>
                <li><a href="index.php">Galeria</a></li>
                <li><a href="index.php">Fale conosco</a></li>
                <li><a href="#">Denúncia anônima</a></li>
            </ul>
        </nav>
    </header>

    <main>

        <section id="denuncia" style="display: flex; align-items: center;">
            <div class="overlay-denuncia"></div>
            <div class="row box-denuncia">
                <div class="col-md-7">
                    <h1 class="alerta-titulo fade-in-element">DENUNCIE</h1>
                    <p class="fade-in-element">Garantimos total sigilo e anonimato das informações.<br>Denuncie de forma
                        rápida e eficiente.</p>
                </div>
                <div class="col-md-5">
                    <form action="denunciar.php" method="POST" id="contact-form">
                        <div class="mb-3">
                            <input type="text" class="form-control fade-in-element" id="assunto" name="assunto"
                                placeholder="Assunto" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control fade-in-element" id="mensagem" name="mensagem" rows="3"
                                placeholder="Mensagem" required></textarea>
                        </div>
                        <button class="primary-btn fade-in-element" id="enviar">Denunciar</button>
                    </form>
                </div>
            </div>
        </section>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="./js/fade-in-element.js"></script>
    <script src="./js/denuncia-form.js"></script>

</body>

</html>