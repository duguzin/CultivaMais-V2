<?php
// Inicie a sessão
session_start();

include('./conexao.php')

// Verifique se o ID do produto foi passado via GET ou POST
if (isset($_POST["id"])) {
    $produto_id = intval($_POST["id"]);

    // Inicialize o carrinho na sessão, se necessário
    if (!isset($_SESSION["carrinho"])) {
        $_SESSION["carrinho"] = [];
    }

    // Adiciona ou atualiza a quantidade no carrinho
    if (isset($_SESSION["carrinho"][$produto_id])) {
        $_SESSION["carrinho"][$produto_id]++;
    } else {
        $_SESSION["carrinho"][$produto_id] = 1;
    }

    // Retorne uma resposta de sucesso para a requisição AJAX
    echo json_encode(["status" => "success"]);
} else {
    // Se o ID do produto não foi passado, retorne um erro
    echo json_encode(["status" => "error", "message" => "Produto não especificado."]);
}
