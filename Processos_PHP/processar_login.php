<?php
// Inicie a sessão antes de acessar ou definir variáveis de sessão
session_start();

include('../conexao.php');

// Verifique se os campos de e-mail e senha foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"]) && isset($_POST["senha"])) {
    // Obtém os valores dos campos do formulário
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Consulta SQL para verificar se o usuário existe e as credenciais estão corretas
    $sql = "SELECT id, nome, tipo_conta FROM usuarios WHERE email = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifique se a consulta foi bem-sucedida
    if ($result) {
        // Verifique se há algum resultado
        if ($result->num_rows > 0) {
            // O usuário existe e as credenciais estão corretas, obtenha o nome do usuário, o tipo de conta e o ID do usuário
            $row = $result->fetch_assoc();
            $usuario_id = $row["id"];
            $nome = $row["nome"];
            $tipoConta = $row["tipo_conta"];

            // Armazene as informações do usuário na sessão
            $_SESSION["usuario_id"] = $usuario_id;
            $_SESSION["email"] = $email;
            $_SESSION["nome"] = $nome;
            $_SESSION["tipo_conta"] = $tipoConta;
            $_SESSION["logado"] = true; // Defina a flag de login como verdadeira

            // Carregue o carrinho do banco de dados
            carregarCarrinho($usuario_id, $conn);

            // Redirecione para a página principal ou para a página onde os produtos serão exibidos
            header("Location: ../index.php");
            exit(); // Certifique-se de sair do script após o redirecionamento
        } else {
            // Se não houver nenhum resultado, redirecione para a página de erro de login
            header("Location: ../login_erro.php");
            exit(); // Certifique-se de sair do script após o redirecionamento
        }
    } else {
        // Se ocorrer um erro na consulta SQL, exiba uma mensagem de erro
        echo "Erro na consulta SQL: " . $conn->error;
    }
}

// Função para carregar o carrinho do banco de dados
function carregarCarrinho($user_id, $conn) {
    $_SESSION["carrinho"] = [];

    $sql = "SELECT produto_id, quantidade FROM carrinho WHERE usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $_SESSION["carrinho"][$row['produto_id']] = $row['quantidade'];
    }
}

// Feche a conexão
$conn->close();
?>
