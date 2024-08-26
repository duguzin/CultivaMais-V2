<?php
include('./conexao.php');

// Verifique se o ID do produto foi fornecido
if (isset($_GET['id'])) {
    $produto_id = $_GET['id'];

    // Excluir produto do banco de dados
    $sql = "DELETE FROM produtos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $produto_id);
    if ($stmt->execute()) {
        header("Location: meus_produtos.php");
    } else {
        echo "Erro ao excluir produto.";
    }
} else {
    echo "Requisição inválida. ID do produto não fornecido.";
}

// Feche a conexão
$stmt->close();
$conn->close();
?>
