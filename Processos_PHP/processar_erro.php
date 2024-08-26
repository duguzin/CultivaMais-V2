<?php
// Inicie a sessão
session_start();

// Verifique se os campos de e-mail e senha foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"]) && isset($_POST["senha"])) {
    // Obtém os valores dos campos do formulário
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Realize a conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cultivamaislogin";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifique a conexão
    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    // Consulta SQL para verificar se o usuário existe e as credenciais estão corretas
    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $result = $conn->query($sql);

    // Verifique se há algum resultado
    if ($result->num_rows > 0) {
        // O usuário existe e as credenciais estão corretas, inicie a sessão e redirecione para a página de perfil
        $_SESSION["email"] = $email;
        header("Location: ../index.php");
    } else {
        // Se não houver nenhum resultado, exiba uma mensagem de erro
        header("Location: ../login_erro.php");
    }

    // Feche a conexão
    $conn->close();
}
?>
