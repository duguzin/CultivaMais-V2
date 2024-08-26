<?php

include('../conexao.php');

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os valores dos campos do formulário
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $confirmar_senha = $_POST["confirmar_senha"];
    
    // Certifique-se de que o tipo de conta foi enviado e é válido
    if (isset($_POST['tipo_conta'])) {
        $tipo_de_conta = $_POST['tipo_conta'];
        // Verifica se o tipo de conta é um dos valores esperados
        if ($tipo_de_conta !== 'consumidor' && $tipo_de_conta !== 'vendedor') {
            die('Tipo de conta inválido!');
        }
    } else {
        die('Por favor, selecione um tipo de conta.');
    }

    // Verifica se as senhas coincidem
    if ($senha !== $confirmar_senha) {
        die("As senhas não coincidem.");
    }

    // Prepara a consulta de inserção
    // Importante: Use declarações preparadas para evitar injeção de SQL
    $sql = $conn->prepare("INSERT INTO usuarios (nome, sobrenome, email, senha, tipo_conta) VALUES (?, ?, ?, ?, ?)");
    $sql->bind_param("sssss", $nome, $sobrenome, $email, $senha, $tipo_de_conta); // 'sssss' indica o tipo de cada variável: 's' = string

    // Executa a consulta
    if ($sql->execute() === TRUE) {
        // Define uma variável de sessão para indicar que o registro foi inserido
        $_SESSION["registro_inserido"] = true;
        // Redireciona para a página de login
        header("Location: ../login.php");
        exit; // Encerra o script
    } else {
        echo "Erro ao inserir registro: " . $sql->error;
    }
    
    $_SESSION["tipo_de_conta"] = $tipoConta;
    // Fecha a conexão
    $conn->close();
}
?>
