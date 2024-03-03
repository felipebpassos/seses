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
        <a href="#" class="logo">
            <img src="./img/logo.png" alt="SESES - Logo">
        </a>

        <nav>
            <ul>
                <li><a href="#sobre">Sobre nós</a></li>
                <li><a href="#diretoria">Diretoria</a></li>
                <li><a href="#galeria">Galeria</a></li>
                <li><a href="#contato">Fale conosco</a></li>
                <li><a href="denuncia.php">Denúncia anônima</a></li>
            </ul>
        </nav>
    </header>

    <main>

        <section id="banner-principal">
            <img src="./img/banner.png" alt="Banner representando funcionário do comércio">
            <div class="overlay"></div>
            <div class="content">
                <h1 class="fade-in-element">Sindicato dos Empregados em<br>Supermercados no Estado de Sergipe</h1>
            </div>
        </section>

        <section id="sobre">
            <h1 class="titulo fade-in-element">SOBRE NÓS</h1>
            <div class="row m-auto">
                <p class="fade-in-element"><img src="XXXXXXXX" width="250"
                        alt="Mosaico de fotos que representem a instituição FECOMSE">
                    A Federação dos Empregados no Comércio e Serviços do Estado de Sergipe
                    (FECOMSE), entidade representativa dos comerciários de todo o estado, busca, através de
                    convenções
                    coletivas, estabelecer pisos salariais, conquistar direitos e melhores condições de trabalho de
                    todos aqueles
                    empregados no comércio e em bens de serviços em Sergipe.<br><br>Fundada em XX de XX de XXXX,
                    a FECOMSE foi oficialmente reconhecida pelo Ministério do Trabalho em XX
                    de XX do mesmo ano, ela engloba os sindicatos de comerciários do estado de Sergipe, tanto da
                    capital quanto do interior - aproximadamente XX sindicatos de base - assim como os municípios
                    que não contam com organizações sindicais.<br><br>A FECOMSE é afiliada da Confederação
                    Nacional dos Trabalhadores no Comércio (CNTC) e da Força Sindical. Atualmente a entidade é
                    presidida pelo comerciário XXXXXX, que atualmente também faz parte da diretoria tanto na CNTC,
                    quanto na Força Sindical.</p>

            </div>
        </section>

        <section id="diretoria">
            <h1 class="titulo fade-in-element">DIRETORIA</h1>
            <div class="row m-auto">
                <div class="col-lg-4 col-md-6 membro">
                    <div class="text-center">
                        <!-- Foto do membro -->
                        <div class="rounded-circle overflow-hidden mx-auto" style="width: 200px; height: 200px;">
                            <img src="./img/default.png" class="img-fluid" alt="Foto do membro">
                        </div>
                        <!-- Nome do membro -->
                        <h4 class="mt-3">Nome do Membro</h4>
                        <!-- Cargo do membro -->
                        <p>Cargo do Membro</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 membro">
                    <div class="text-center">
                        <!-- Foto do membro -->
                        <div class="rounded-circle overflow-hidden mx-auto" style="width: 200px; height: 200px;">
                            <img src="./img/default.png" class="img-fluid" alt="Foto do membro">
                        </div>
                        <!-- Nome do membro -->
                        <h4 class="mt-3">Nome do Membro</h4>
                        <!-- Cargo do membro -->
                        <p>Cargo do Membro</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 membro">
                    <div class="text-center">
                        <!-- Foto do membro -->
                        <div class="rounded-circle overflow-hidden mx-auto" style="width: 200px; height: 200px;">
                            <img src="./img/default.png" class="img-fluid" alt="Foto do membro">
                        </div>
                        <!-- Nome do membro -->
                        <h4 class="mt-3">Nome do Membro</h4>
                        <!-- Cargo do membro -->
                        <p>Cargo do Membro</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="galeria">
            <h1 class="titulo fade-in-element">GALERIA</h1>
            <div class="galeria-box">
                <div class="container" style="margin: 0;">
                    <div class="fade-right"></div>
                    <div class="row-album">
                        <?php
                        // Carrega os dados do arquivo JSON
                        $dados = file_get_contents('editor/dados.json');
                        $dados = json_decode($dados, true);

                        // Verifica se os dados foram carregados com sucesso e se não estão vazios
                        if ($dados !== null && !empty($dados)) {
                            // Itera sobre os dados para criar os álbuns dinamicamente, começando do último elemento
                            for ($i = count($dados) - 1; $i >= 0; $i--) {
                                $album = $dados[$i];
                                ?>
                                <div class="album">
                                    <div class="album-container">
                                        <div class="album-overlay"></div>
                                        <img src="<?php echo $album['images'][0]['filename']; ?>" alt="">
                                        <div class="album-info">
                                            <span class="titulo-album">
                                                <?php echo $album['title']; ?>
                                            </span>
                                            <div class="bottom-album">
                                                <span class="numero-fotos">
                                                    <?php echo count($album['images']); ?> fotos
                                                </span>
                                                <span class="ver-fotos">Ver album</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo "<p>Nenhum álbum encontrado.</p>";
                        }
                        ?>
                    </div>
                </div>
                <!-- Botões de navegação -->
                <div class="arrow nav-btn-galeria-left">
                    <svg width="12" height="24" viewBox="0 0 8 16" fill="rgb(223, 214, 207)">
                        <path d="M.732 9.547L8 16 4 8l4-8L.732 6.453A1.996 1.996 0 0 0 0 8c0 .623.285 1.18.732 1.547z">
                        </path>
                    </svg>
                </div>
                <div class="arrow nav-btn-galeria-right">
                    <svg width="12" height="24" viewBox="0 0 8 16" fill="rgb(223, 214, 207)">
                        <path
                            d="M7.268 9.547L0 16l4-8-4-8 7.268 6.453C7.715 6.82 8 7.377 8 8c0 .623-.285 1.18-.732 1.547z">
                        </path>
                    </svg>
                </div>
            </div>
        </section>

        <section id="contato">
            <h1 class="titulo fade-in-element">CONTATO</h1>
            <div class="row m-auto">
                <div class="col-md-6">
                    <form action="formulario.php" method="POST" id="contact-form">
                        <div class="mb-3 row m-auto">
                            <div class="col" style="padding-left: 0;">
                                <input type="text" class="form-control fade-in-element" id="nome" name="nome"
                                    placeholder="Nome" required>
                            </div>
                            <div class="col" style="padding-right: 0;">
                                <input type="email" class="form-control fade-in-element" id="email" name="email"
                                    placeholder="Email" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control fade-in-element" id="mensagem" name="mensagem" rows="3"
                                placeholder="Mensagem" required></textarea>
                        </div>
                        <button class="primary-btn fade-in-element" id="enviar">Enviar</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <button class="opcao fade-in-element" id="ligar" onclick="window.open('tel:+557933333333');">
                        <div class="icone">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="info">
                            <p>(79) 3333-3333</p>
                            <span>Ligue para mais informações</span>
                        </div>
                    </button>
                    <button class="opcao fade-in-element" id="localizacao"
                        onclick="window.open('https://www.google.com/maps/place/R.+Prof.+Jos%C3%A9+Le%C3%B4nidas+de+Menezes,+94+-+Grageru,+Aracaju+-+SE,+49025-640/@-10.9373716,-37.0521302,17z/data=!3m1!4b1!4m6!3m5!1s0x71ab392eb2713f3:0x85eb9e7e1df07560!8m2!3d-10.9373716!4d-37.0521302!16s%2Fg%2F11tdlcly37?entry=ttu');">
                        <div class="icone">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="info">
                            <p>Rua Prof. José Leônidas de Menezes, 94</p>
                            <span>Bairro Grageru, Aracaju, SE</span>
                        </div>
                    </button>
                </div>
            </div>
        </section>

    </main>

    <footer>
        <div class="row">
            <div class="col-md-5">
                <div class="logo2">
                    <img src="./img/logo_pb.jpg" alt="SESES - logo (P&B)">
                </div>
                <p>&copy; 2024 - SESES<br>Desenvolvido por <a href="https://www.instagram.com/simplifyweb/"
                        target="_blank">Simplify Web</a></p>
            </div>
            <div class="col-md-7" style="display: flex;">
                <div class="content">
                    <h4>Contato —</h4>
                    <p></p>
                    <p><i class="fa-solid fa-envelope"></i> seses@gmail.com</p>
                    <p><i class="fa-solid fa-phone"></i> (79) 3333-3333</p>
                </div>
                <div class="content">
                    <h4>Localização —</h4>
                    <p>Avenida Sete de Setembro, 675</p>
                    <p>Edf. Centerville, 7 andar, salas 701-703, Piedade, Salvador</p>
                </div>
            </div>
        </div>
    </footer>

    <div class="albumPopup" id="album">
        <div style="position: relative; width: 100%; height: 100vh;">

            <div class="popup-overlay"></div>

            <div class="close-popup">
                <div class="close" onmouseover="startAnimation()" onmouseout="resetAnimation()">
                    <svg class="close-ring" width="61" height="61">
                        <circle class="close-ring__circle" id="closeCircle" stroke="var(--azul-light)" stroke-width="2"
                            fill="transparent" r="28" cx="30" cy="30" />
                        <circle class="close-ring__circle-full" stroke="rgba(255, 255, 255, 0.2)" stroke-width="2"
                            fill="transparent" r="28" cx="30" cy="30" />
                    </svg>
                    <svg class="x" viewBox="0 0 12 12" style="height: 12px; width: 12px;">
                        <path stroke="rgb(180, 180, 180)" fill="rgb(180, 180, 180)"
                            d="M4.674 6L.344 1.05A.5.5 0 0 1 1.05.343L6 4.674l4.95-4.33a.5.5 0 0 1 .707.706L7.326 6l4.33 4.95a.5.5 0 0 1-.706.707L6 7.326l-4.95 4.33a.5.5 0 0 1-.707-.706L4.674 6z">
                        </path>
                    </svg>
                </div>
            </div>

            <div class="arrow foto-preview" onclick="plusFoto(-1)">
                <svg width="12" height="24" viewBox="0 0 8 16" fill="rgb(223, 214, 207)">
                    <path d="M.732 9.547L8 16 4 8l4-8L.732 6.453A1.996 1.996 0 0 0 0 8c0 .623.285 1.18.732 1.547z">
                    </path>
                </svg>
            </div>
            <div class="arrow foto-next" onclick="plusFoto(1)">
                <svg width="12" height="24" viewBox="0 0 8 16" fill="rgb(223, 214, 207)">
                    <path d="M7.268 9.547L0 16l4-8-4-8 7.268 6.453C7.715 6.82 8 7.377 8 8c0 .623-.285 1.18-.732 1.547z">
                    </path>
                </svg>
            </div>

            <div class="content">
                <div class="foto-container">
                    <img src="" alt="">
                    <div class="legenda">
                        <span></span>
                    </div>
                </div>
                <div class="carrossel-fotos">
                    <div class="nav-btn nav-btn-left"><i class="fa-solid fa-backward"></i></div>
                    <div class="fotos">
                        <ul class="fotos-lista">
                        </ul>
                    </div>
                    <div class="nav-btn nav-btn-right"><i class="fa-solid fa-forward"></i></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        // Aguarda o carregamento completo da página
        $(document).ready(function () {
            // Verifica se há uma mensagem de sucesso e exibe o alerta
            if ($('#success-alert').length > 0) {
                // Adiciona um temporizador para desaparecer após 3 segundos
                setTimeout(function () {
                    $('#success-alert').fadeOut('slow', function () {
                        // Remove o elemento após o fade out
                        $(this).remove();
                    });
                }, 3000); // 3000 milissegundos = 3 segundos
            }
        });
    </script>

    <script>
        function plusFoto(direction) {
            var fotoAtual = $('.foto.selecionada');
            var novaFoto;

            if (direction === 1) {
                novaFoto = fotoAtual.next('.foto');
                if (novaFoto.length === 0) {
                    novaFoto = $('.foto').first();
                }
            } else if (direction === -1) {
                novaFoto = fotoAtual.prev('.foto');
                if (novaFoto.length === 0) {
                    novaFoto = $('.foto').last();
                }
            }

            // Atualiza a imagem e a legenda na .foto-container
            var novaSrc = novaFoto.find('img').attr('src');
            var novaAlt = novaFoto.find('img').attr('alt');
            $('.foto-container img').attr('src', novaSrc);
            $('.foto-container img').attr('alt', novaAlt);
            $('.legenda span').text(novaAlt);

            // Atualiza a classe 'selecionada' na foto atual e na nova foto
            fotoAtual.removeClass('selecionada');
            novaFoto.addClass('selecionada');
        }
    </script>

    <script src="./js/header-effect.js"></script>
    <script src="./js/fade-in-element.js"></script>
    <script src="./js/scroll-to-section.js"></script>
    <script src="./js/section-view.js"></script>
    <script src="./js/carrossel-galeria.js"></script>
    <script src="./js/album-popup.js"></script>
    <script src="./js/close-animation.js"></script>
    <script src="./js/contato-form.js"></script>
    <script src="./js/carrossel-fotos.js"></script>

</body>

</html>