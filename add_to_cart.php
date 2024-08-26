<?php
session_start();
include("./conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_produto = isset($_POST["id"]) ? intval($_POST["id"]) : null;
    $quantity = isset($_POST["quantity"]) ? intval($_POST["quantity"]) : 1;

    if ($id_produto && $quantity > 0) {
        if (!isset($_SESSION["carrinho"])) {
            $_SESSION["carrinho"] = [];
        }

        if (isset($_SESSION["carrinho"][$id_produto])) {
            $_SESSION["carrinho"][$id_produto] += $quantity;
        } else {
            $_SESSION["carrinho"][$id_produto] = $quantity;
        }

        $user_id = $_SESSION['usuario_id'];
        $sql = "INSERT INTO carrinho (usuario_id, produto_id, quantidade) VALUES (?, ?, ?)
                ON DUPLICATE KEY UPDATE quantidade = quantidade + ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iiii', $user_id, $id_produto, $quantity, $quantity);
        $stmt->execute();

        echo "Produto adicionado ao carrinho!";
    } else {
        echo "Dados inválidos.";
    }
}
?>
