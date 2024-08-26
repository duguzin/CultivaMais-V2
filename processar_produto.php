<?php
// Conexão com o banco de dados
include("conexao.php");

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["productImages"]) && is_array($_FILES["productImages"]["tmp_name"])) {
        // Obter detalhes do produto do POST
        $productName = htmlspecialchars($_POST["productName"]);
        $productDescription = htmlspecialchars($_POST["productDescription"]);
        $productPrice = floatval($_POST["productPrice"]);
        $categoria = htmlspecialchars($_POST["productCategory"]);

        // Iniciar a sessão para obter o ID do usuário
        session_start();
        $usuario_id = $_SESSION['usuario_id'];

        $target_dir = "uploads/"; // Diretório para salvar imagens
        $image_paths = []; // Lista para armazenar caminhos das imagens

        // Processar todas as imagens enviadas
        foreach ($_FILES["productImages"]["tmp_name"] as $index => $tmp_name) {
            $target_file = $target_dir . basename($_FILES["productImages"]["name"][$index]);

            if (getimagesize($tmp_name) !== false) { // Verifique se é uma imagem válida
                if (move_uploaded_file($tmp_name, $target_file)) { // Mover para o diretório
                    $image_paths[] = $target_file; // Adicionar ao array
                } else {
                    echo "Erro ao enviar a imagem: " . htmlspecialchars($_FILES["productImages"]["name"][$index]);
                }
            } else {
                echo "O arquivo não é uma imagem válida.";
            }
        }

        // Se houver imagens válidas, insira o produto no banco de dados
        if (!empty($image_paths)) {
            // Insira o produto no banco de dados
            $sql = "INSERT INTO produtos (nome, descricao, preco, categoria, usuario_id) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdsi", $productName, $productDescription, $productPrice, $categoria, $usuario_id);
            $stmt->execute();
            $produto_id = $stmt->insert_id; // ID do produto inserido
            $stmt->close();

            // Insira cada caminho de imagem associado ao produto
            $sql_img = "INSERT INTO produto_imagens (produto_id, imagem_path) VALUES (?, ?)";
            $stmt_img = $conn->prepare($sql_img);

            foreach ($image_paths as $path) {
                $stmt_img->bind_param("is", $produto_id, $path);
                $stmt_img->execute();
            }

            $stmt_img->close();
            $conn->close();

            // Redirecione após sucesso
            header("Location: meus_produtos.php");
            exit();
        } else {
            echo "Nenhuma imagem válida foi enviada.";
        }
    } else {
        echo "Nenhuma imagem enviada ou erro no upload.";
    }

    $conn->close();
} else {
    // Se não for uma solicitação POST, redirecione para o formulário
    header("Location: add_product.php");
    exit();
}
?>
