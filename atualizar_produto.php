<?php
// Inclua a conexão com o banco de dados
include('./conexao.php');

// Verifique se o método da requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifique se todos os campos necessários foram enviados e não estão vazios
    if (
        isset($_POST["produto_nome"]) && !empty($_POST["produto_nome"]) &&
        isset($_POST["produto_descricao"]) && !empty($_POST["produto_descricao"]) &&
        isset($_POST["produto_preco"]) && !empty($_POST["produto_preco"]) &&
        isset($_POST["produto_id"]) && !empty($_POST["produto_id"])
    ) {
        // Capture os valores do POST
        $produto_id = intval($_POST["produto_id"]);
        $produto_nome = $_POST["produto_nome"];
        $produto_descricao = $_POST["produto_descricao"];
        $produto_preco = floatval($_POST["produto_preco"]);

        // SQL para atualizar o produto
        $sql = "UPDATE produtos SET nome = ?, descricao = ?, preco = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdi", $produto_nome, $produto_descricao, $produto_preco, $produto_id);

        // Execute a atualização
        if ($stmt->execute()) {
            header("Location: meus_produtos.php");
        } else {
            echo "Erro ao atualizar o produto.";
        }

        // Feche a consulta
        $stmt->close();
    } else {
        echo "Todos os campos são obrigatórios.";
    }
} else {
    echo "Método de requisição inválido.";
}

// Feche a conexão com o banco de dados
$conn->close();
?>
