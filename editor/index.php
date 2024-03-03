<?php
session_start();

// Verifica se o usuário não está logado, se não estiver, redireciona para a página de login
if (!isset($_SESSION['username'])) {
    header("Location: http://localhost/sindicatos/seses/editor/login.php");
    exit;
}

// Função para carregar os dados do arquivo JSON
function carregarDados()
{
    $context = stream_context_create(['http' => ['ignore_errors' => true], 'ssl' => ['verify_peer' => false, 'verify_peer_name' => false]]);
    $dados = file_exists('dados.json') ? file_get_contents('dados.json', false, $context) : null;
    return json_decode($dados, true);
}


// Função para salvar os dados no arquivo JSON
function salvarDados($dados)
{
    file_put_contents('dados.json', json_encode($dados, JSON_PRETTY_PRINT));
}

// Verifica se o formulário de criação de álbum foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['album_title'])) {
    $dados = carregarDados();
    $novoAlbum = [
        'title' => $_POST['album_title'],
        'images' => [],
        'hidden' => isset($_POST['hidden']) ? 'true' : 'false'
    ];
    $dados[] = $novoAlbum;
    salvarDados($dados);
}

// Verifica se o formulário de adição de imagem foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['album_id']) && isset($_FILES['image']) && isset($_POST['caption'])) {
    $albumId = $_POST['album_id'];
    $imageFile = $_FILES['image'];
    $caption = $_POST['caption'];
    $hidden = isset($_POST['hidden']) ? 'true' : 'false';

    // Verifica se um arquivo foi selecionado
    if (!empty($imageFile['name'])) {
        // Verifica o tamanho do arquivo
        $maxFileSize = 3 * 1024 * 1024; // 3 MB em bytes
        if ($imageFile['size'] <= $maxFileSize) {
            // Gera um nome único para o arquivo de imagem
            $uniqueFilename = uniqid() . '_' . basename($imageFile["name"]);

            // Define o diretório de destino para salvar as imagens
            $targetDir = "images/";
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true); // Cria o diretório com permissões 0755 (permissões padrão)
            }
            $targetFilePath = $targetDir . $uniqueFilename;

            // Move o arquivo para o diretório de destino
            if (move_uploaded_file($imageFile["tmp_name"], $targetFilePath)) {
                // Adiciona a nova imagem ao álbum
                $dados = carregarDados();
                $novaImagem = [
                    'filename' => './editor/' . $targetFilePath,
                    'caption' => $caption,
                    'hidden' => $hidden // Adicionando o status de visibilidade da foto
                ];
                $dados[$albumId]['images'][] = $novaImagem;
                salvarDados($dados);
            } else {
                // Se houver um erro ao mover o arquivo, exibe uma mensagem de erro
                echo "Erro ao fazer upload do arquivo.";
            }
        } else {
            // Se o arquivo exceder o tamanho máximo permitido, exiba uma mensagem de erro
            echo "Erro: O arquivo selecionado excede o tamanho máximo permitido (3 MB).";
        }
    } else {
        // Se nenhum arquivo for selecionado, exiba uma mensagem de erro
        echo "Erro: Nenhum arquivo selecionado.";
    }
}

// Verifica se a solicitação de exclusão de uma foto foi feita
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'delete_photo' && isset($_POST['album_id']) && isset($_POST['photo_index'])) {
    $albumId = $_POST['album_id'];
    $photoIndex = $_POST['photo_index'];

    // Carrega os dados
    $dados = carregarDados();

    // Obtém o nome do arquivo da foto
    $filename = str_replace('./editor/', './', $dados[$albumId]['images'][$photoIndex]['filename']);

    // Remove a foto do álbum
    unset($dados[$albumId]['images'][$photoIndex]);

    // Salva os dados atualizados
    salvarDados($dados);

    // Exclui o arquivo da foto do sistema de arquivos
    if (file_exists($filename)) {
        unlink($filename);
    }
}

// Verifica se a solicitação de exclusão de um álbum foi feita
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'delete_album' && isset($_POST['album_id'])) {
    $albumId = $_POST['album_id'];

    // Carrega os dados
    $dados = carregarDados();

    // Obtém o álbum a ser excluído
    $album = $dados[$albumId];

    // Remove o álbum
    unset($dados[$albumId]);

    // Reindexa os índices do array
    $dados = array_values($dados);

    // Salva os dados atualizados
    salvarDados($dados);

    // Exclui os arquivos de imagem do sistema de arquivos
    foreach ($album['images'] as $image) {
        // Obtém o nome do arquivo da foto
        $filename = str_replace('./editor/', './', $image['filename']);
        if (file_exists($filename)) {
            unlink($filename);
        }
    }
}

// Verifica se a solicitação de ocultar um álbum foi feita
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'hide_album' && isset($_POST['album_id'])) {
    $albumId = $_POST['album_id'];

    // Carrega os dados
    $dados = carregarDados();

    // Define o status de ocultação do álbum como "true"
    $dados[$albumId]['hidden'] = 'true';

    // Salva os dados atualizados
    salvarDados($dados);

    // Responde com sucesso
    echo json_encode(["success" => true]);
    exit;
}

// Verifica se a solicitação de desocultar um álbum foi feita
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'unhide_album' && isset($_POST['album_id'])) {
    $albumId = $_POST['album_id'];

    // Carrega os dados
    $dados = carregarDados();

    // Define o status de ocultação do álbum como "false"
    $dados[$albumId]['hidden'] = 'false';

    // Salva os dados atualizados
    salvarDados($dados);

    // Responde com sucesso
    echo json_encode(["success" => true]);
    exit;
}

// Verifica se a solicitação de ocultar uma foto foi feita
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'hide_photo' && isset($_POST['album_id']) && isset($_POST['photo_index'])) {
    $albumId = $_POST['album_id'];
    $photoIndex = $_POST['photo_index'];

    // Carrega os dados
    $dados = carregarDados();

    // Define o status 'oculto' para a foto
    $dados[$albumId]['images'][$photoIndex]['hidden'] = true;

    // Salva os dados atualizados
    salvarDados($dados);
}

// Verifica se a solicitação de desocultar uma foto foi feita
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'unhide_photo' && isset($_POST['album_id']) && isset($_POST['photo_index'])) {
    $albumId = $_POST['album_id'];
    $photoIndex = $_POST['photo_index'];

    // Carrega os dados
    $dados = carregarDados();

    // Define o status de ocultação da foto como "false" (visível)
    $dados[$albumId]['images'][$photoIndex]['hidden'] = 'false';

    // Salva os dados atualizados
    salvarDados($dados);

    // Responde com sucesso
    echo json_encode(["success" => true]);
    exit;
}

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor de conteúdo | SESES</title>
    <!-- Adicionando o Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <style>
        /* Estilo customizado para centralizar o conteúdo */
        body {
            padding-top: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        header {
            display: flex;
            justify-content: space-between;
            padding: 20px 0;
        }

        form {
            width: 100%;
            max-width: 400px;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <div class="logo">
                <img src="../img/logo.png" height="60" alt="logo | SESES">
            </div>
            <a href="logout.php" class="btn btn-primary">Sair <i class="fa-solid fa-right-from-bracket"></i></a>
        </header>

        <!-- Formulário para adicionar novo álbum -->
        <div class="card mt-4">
            <div class="card-body">
                <h3 class="card-title">Adicionar Novo Álbum</h3>
                <form action="index.php" method="post">
                    <div class="form-group">
                        <label for="album_title">Título do Álbum:</label>
                        <input type="text" id="album_title" name="album_title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="album_hidden">Ocultar álbum:</label>
                        <input type="checkbox" name="hidden" id="album_hidden" value="true">
                    </div>
                    <button type="submit" class="btn btn-primary">Adicionar Álbum</button>
                </form>
            </div>
        </div>

        <!-- Formulário para adicionar nova imagem -->
        <div class="card mt-4">
            <div class="card-body">
                <h3 class="card-title">Adicionar Nova Imagem</h3>
                <form action="index.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="album_id">Selecione o Álbum:</label>
                        <select name="album_id" id="album_id" class="form-control">
                            <?php
                            $dados = carregarDados();
                            foreach ($dados as $index => $album) {
                                echo "<option value=\"$index\">{$album['title']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Selecione a Imagem:</label>
                        <input type="file" name="image" id="image" class="form-control-file" required>
                    </div>
                    <div class="form-group">
                        <label for="caption">Legenda:</label>
                        <input type="text" name="caption" id="caption" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="image_hidden">Ocultar foto:</label>
                        <input type="checkbox" name="hidden" id="image_hidden" value="true">
                    </div>
                    <button type="submit" class="btn btn-primary">Adicionar Imagem</button>
                </form>
            </div>
        </div>

        <?php if ($dados && is_array($dados)): ?>
            <?php foreach ($dados as $albumIndex => $album): ?>
                <div class="card mt-4">
                    <div class="card-body">
                        <h3 class="card-title">
                            <?php echo $album['title']; ?>
                        </h3>
                        <button class="btn btn-danger" onclick="deleteAlbum(<?php echo $albumIndex; ?>)">Excluir Álbum</button>
                        <?php if ($album['hidden'] === 'true'): ?>
                            <button class="btn btn-secondary" onclick="unhideAlbum(<?php echo $albumIndex; ?>)">Desocultar
                                Álbum</button>
                        <?php else: ?>
                            <button class="btn btn-secondary" onclick="hideAlbum(<?php echo $albumIndex; ?>)">Ocultar Álbum</button>
                        <?php endif; ?>
                        <div class="row">
                            <?php
                            // Separando fotos visíveis das ocultas
                            $visiblePhotos = [];
                            $hiddenPhotos = [];
                            if (isset($album['images']) && is_array($album['images'])) {
                                foreach ($album['images'] as $photoIndex => $photo) {
                                    if ($photo['hidden'] === 'false') {
                                        $visiblePhotos[] = [$photoIndex, $photo];
                                    } else {
                                        $hiddenPhotos[] = [$photoIndex, $photo];
                                    }
                                }
                            }
                            ?>
                            <div class="col-md-12 mt-3">
                                <h4>Fotos Visíveis</h4>
                                <div class="row">
                                    <?php foreach ($visiblePhotos as list($photoIndex, $photo)): ?>
                                        <div class="col-md-3 mt-3">
                                            <div class="card">
                                                <img src="<?php echo str_replace('./editor/', './', $photo['filename']); ?>"
                                                    class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <p class="card-text">
                                                        <?php echo $photo['caption']; ?>
                                                    </p>
                                                    <button class="btn btn-danger"
                                                        onclick="deletePhoto(<?php echo $albumIndex; ?>, <?php echo $photoIndex; ?>)">Excluir
                                                        Foto</button>
                                                    <!-- Botão para ocultar a foto -->
                                                    <button class="btn btn-secondary"
                                                        id="hide_photo_<?php echo $albumIndex; ?>_<?php echo $photoIndex; ?>"
                                                        onclick="hidePhoto(<?php echo $albumIndex; ?>, <?php echo $photoIndex; ?>)">Ocultar
                                                        Foto</button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <h4>Fotos Ocultas</h4>
                                <div class="row">
                                    <?php foreach ($hiddenPhotos as list($photoIndex, $photo)): ?>
                                        <div class="col-md-3 mt-3">
                                            <div class="card">
                                                <img src="<?php echo str_replace('./editor/', './', $photo['filename']); ?>"
                                                    class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <p class="card-text">
                                                        <?php echo $photo['caption']; ?>
                                                    </p>
                                                    <button class="btn btn-danger"
                                                        onclick="deletePhoto(<?php echo $albumIndex; ?>, <?php echo $photoIndex; ?>)">Excluir
                                                        Foto</button>
                                                    <!-- Botão para desocultar a foto -->
                                                    <button class="btn btn-secondary"
                                                        id="unhide_photo_<?php echo $albumIndex; ?>_<?php echo $photoIndex; ?>"
                                                        onclick="unhidePhoto(<?php echo $albumIndex; ?>, <?php echo $photoIndex; ?>)">Desocultar
                                                        Foto</button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum álbum disponível.</p>
        <?php endif; ?>

    </div>

    <!-- Adicionando o Bootstrap JavaScript e o jQuery (opcional, necessário para funcionalidades avançadas do Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Script para exclusão de álbuns e fotos -->
    <script>
        function deletePhoto(albumId, photoIndex) {
            if (confirm("Tem certeza que deseja excluir esta foto?")) {
                var formData = new FormData();
                formData.append('action', 'delete_photo');
                formData.append('album_id', albumId);
                formData.append('photo_index', photoIndex);

                fetch('index.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => {
                        // Adiciona um parâmetro de consulta único à URL
                        var timestamp = new Date().getTime();
                        window.location.href = 'index.php?timestamp=' + timestamp;
                    })
                    .catch(error => console.error('Erro ao excluir foto:', error));
            }
        }

        function deleteAlbum(albumId) {
            if (confirm("Tem certeza que deseja excluir este álbum?")) {
                var formData = new FormData();
                formData.append('action', 'delete_album');
                formData.append('album_id', albumId);

                fetch('index.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => {
                        // Adiciona um parâmetro de consulta único à URL
                        var timestamp = new Date().getTime();
                        window.location.href = 'index.php?timestamp=' + timestamp;
                    })
                    .catch(error => console.error('Erro ao excluir álbum:', error));
            }
        }

        function hideAlbum(albumIndex) {
            if (confirm("Tem certeza que deseja ocultar este álbum?")) {
                var formData = new FormData();
                formData.append('action', 'hide_album');
                formData.append('album_id', albumIndex);

                fetch('index.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => {
                        // Adiciona um parâmetro de consulta único à URL
                        var timestamp = new Date().getTime();
                        window.location.href = 'index.php?timestamp=' + timestamp;
                    })
                    .catch(error => console.error('Erro ao ocultar álbum:', error));
            }
        }

        function unhideAlbum(albumIndex) {
            if (confirm("Tem certeza que deseja desocultar este álbum?")) {
                var formData = new FormData();
                formData.append('action', 'unhide_album');
                formData.append('album_id', albumIndex);

                fetch('index.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => {
                        // Adiciona um parâmetro de consulta único à URL
                        var timestamp = new Date().getTime();
                        window.location.href = 'index.php?timestamp=' + timestamp;
                    })
                    .catch(error => console.error('Erro ao desocultar álbum:', error));
            }
        }

        function hidePhoto(albumId, photoIndex) {
            if (confirm("Tem certeza que deseja ocultar esta foto?")) {
                var formData = new FormData();
                formData.append('action', 'hide_photo');
                formData.append('album_id', albumId);
                formData.append('photo_index', photoIndex);

                fetch('index.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => {
                        // Adiciona um parâmetro de consulta único à URL
                        var timestamp = new Date().getTime();
                        window.location.href = 'index.php?timestamp=' + timestamp;
                    })
                    .catch(error => console.error('Erro ao ocultar foto:', error));
            }
        }

        function unhidePhoto(albumId, photoIndex) {
            if (confirm("Tem certeza que deseja desocultar esta foto?")) {
                var formData = new FormData();
                formData.append('action', 'unhide_photo');
                formData.append('album_id', albumId);
                formData.append('photo_index', photoIndex);

                fetch('index.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => {
                        // Adiciona um parâmetro de consulta único à URL
                        var timestamp = new Date().getTime();
                        window.location.href = 'index.php?timestamp=' + timestamp;
                    })
                    .catch(error => console.error('Erro ao desocultar foto:', error));
            }
        }

    </script>
</body>

</html>