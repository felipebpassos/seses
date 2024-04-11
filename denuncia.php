<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PRODUTO NÃO PAGO EM SUA TOTALIDADE - PROPRIEDADE INTELECTUAL DE FELIPE BARRETO PASSOS, PROTEGIDO POR LEI.">
    <meta name="author" content="Felipe Passos | Simplify Web">
    <meta name="keywords" content="sindicato, sergipano, comércio, supermercados, supermercado, mercado, trabalho, trabalhadores, comerciários, empregados, trabalhadores, denúncia, denunciar, direitos, sergipe, SE">
    <meta name="robots" content="index,follow">

    <meta property="og:image" content="./img/logo.png">
    <meta property="og:title" content="Denúncia Anônima | SESES">
    <meta property="og:description" content="PRODUTO NÃO PAGO EM SUA TOTALIDADE - PROPRIEDADE INTELECTUAL DE FELIPE BARRETO PASSOS, PROTEGIDO POR LEI.">

    <title>Denúncia Anônima | SESES</title>

    <link rel="icon" href="./img/favicon.ico">

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
                <li><a href="index.php#sobre">Sobre nós</a></li>
                <li><a href="index.php#diretoria">Diretoria</a></li>
                <li><a href="index.php#galeria">Galeria</a></li>
                <li><a href="index.php#contato">Fale conosco</a></li>
                <li><a href="#">Denúncia anônima</a></li>
                <li><a href="index.php#FAQ">FAQ</a></li>
            </ul>
        </nav>

        <button class="toggle-menu" id="toggle-menu">
            <i class="fa-solid fa-bars"></i>
        </button>
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
                            <input type="text" class="form-control fade-in-element" id="assunto" name="assunto" placeholder="Assunto" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control fade-in-element" id="mensagem" name="mensagem" rows="3" placeholder="Mensagem" required></textarea>
                        </div>
                        <button class="primary-btn fade-in-element" id="enviar">Denunciar</button>
                    </form>
                </div>
            </div>
        </section>

    </main>

    <menu>
        <div class="close-popup">
            <div class="close" onmouseover="startAnimation()" onmouseout="resetAnimation()">
                <svg class="close-ring" width="61" height="61">
                    <circle class="close-ring__circle" id="closeCircle" stroke="#fff" stroke-width="2" fill="transparent" r="28" cx="30" cy="30" />
                    <circle class="close-ring__circle-full" stroke="rgba(255, 255, 255, 0.3)" stroke-width="2" fill="transparent" r="28" cx="30" cy="30" />
                </svg>
                <svg class="x" viewBox="0 0 12 12" style="height: 12px; width: 12px;">
                    <path stroke="rgb(180, 180, 180)" fill="rgb(180, 180, 180)" d="M4.674 6L.344 1.05A.5.5 0 0 1 1.05.343L6 4.674l4.95-4.33a.5.5 0 0 1 .707.706L7.326 6l4.33 4.95a.5.5 0 0 1-.706.707L6 7.326l-4.95 4.33a.5.5 0 0 1-.707-.706L4.674 6z">
                    </path>
                </svg>
            </div>
        </div>
        <nav>
            <ul>
                <li><span><a href="index.php#sobre">SOBRE NÓS</a></span></li>
                <li><span><a href="index.php#sindicatos">SINDICATOS</a></span></li>
                <li><span><a href="index.php#galeria">GALERIA</a></span></li>
                <li><span><a href="index.php#contato">FALE CONOSCO</a></span></li>
                <li><span><a href="denuncia.php">DENÚNCIA ANÔNIMA</a></span></li>
                <li><span><a href="index.php#FAQ">FAQ</a></span></li>
            </ul>
        </nav>
    </menu>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="./js/header-effect.js"></script>
    <script src="./js/toggle-menu.js"></script>
    <script src="./js/fade-in-element.js"></script>
    <script src="./js/close-animation.js"></script>
    <script src="./js/denuncia-form.js"></script>

</body>

</html>