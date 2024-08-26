<?php

// Realiza a conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cultivamais";

$conn = new mysqli($servername, $username, $password, $dbname);

 // Verifica a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

?>