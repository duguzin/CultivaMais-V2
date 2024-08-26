<?php

function displayCart() {
    if (isset($_SESSION["carrinho"]) && !empty($_SESSION["carrinho"])) {
        include("./conexao.php");

        $produtos_ids = array_keys($_SESSION["carrinho"]);
        $produtos_ids_string = implode(",", $produtos_ids);

        $sql = "SELECT id, nome, preco, imagem_path FROM produtos WHERE id IN ($produtos_ids_string)";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $total = 0;

            // Início do HTML
            ?>
            <div class="carrinho">
            <?php

while($row = $result->fetch_assoc()) {
        // Obtém os dados do produto
        $produto_id = $row["id"];
        $produto_nome = $row["nome"];
        $produto_preco = $row["preco"];
        $quantidade = $_SESSION["carrinho"][$produto_id];

        // Calcula o subtotal do produto e acumula no total geral
        $subtotal = $produto_preco * $quantidade;
        $total += $subtotal;

        $sql_imagens = "SELECT imagem_path FROM produto_imagens WHERE produto_id = ?";
        $stmt_imagens = $conn->prepare($sql_imagens);
        $stmt_imagens->bind_param("i", $produto_id);
        $stmt_imagens->execute();
        $result_imagens = $stmt_imagens->get_result();

        $imagem_path = $result_imagens->fetch_assoc(); // Obtém a primeira imagem
        $stmt_imagens->close();
?>


    <a href="item.php?id=<?= htmlspecialchars($produto_id) ?>" style="text-decoration: none;">
       <div class="produto">
            <?php if ($imagem_path && file_exists($imagem_path['imagem_path'])): ?>
                <img src="<?= htmlspecialchars($imagem_path['imagem_path']) ?>" alt="<?= htmlspecialchars($produto_nome) ?>" />
            <?php else : ?>
                <img src="uploads/semfoto.jfif" alt="Imagem Indisponível" />
            <?php endif; ?>
            <div class="produto-info">
                <h3><?= htmlspecialchars($produto_nome) ?></h3>
                <p>R$<?= number_format($produto_preco, 2, ',', '.') ?></p>
                <p><?= $quantidade ?></p> 
            </div>
        </div>  
    </a>
   

<?php
}

// Exibe o total de todos os produtos
?>

<div class="total">
    <h3>Total: R$ <?= number_format($total, 2, ',', '.') ?></h3>
</div>
            <?php

        } else {
            ?>
            <p>O carrinho está vazio.</p>
            <?php
        }

        $conn->close();
    } else {
        ?>
        <p>O carrinho está vazio.</p>
        <?php
    }
}

function getTotalProdutosNoCarrinho() {
    if (isset($_SESSION["carrinho"])) {
        return array_sum($_SESSION["carrinho"]);
    }
    return 0;
}
?>
