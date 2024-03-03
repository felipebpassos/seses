<?php
session_start();

// Destroi a sessão
session_unset();
session_destroy();

// Redireciona de volta para a página de login
header("Location: http://localhost/sindicatos/seses/editor/login.php");
exit;
