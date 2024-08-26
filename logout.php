<?php
// Verifique se o botão de logout foi clicado
if (isset($_POST["logout"])) {
    // Limpe todas as variáveis de sessão
    session_unset();
    // Destrua a sessão
    session_destroy();
    // Redirecione de volta para a página de login (ou qualquer outra página)
    header("Location: index.php");
    exit(); // Certifique-se de sair do script após o redirecionamento
}

?>