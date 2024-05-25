<?php
session_start(); // Inicia a sessão PHP

// Verifica se o usuário está logado
if(!isset($_SESSION["NomeUsuario"])) {
    // Se não estiver logado, redireciona para a página de login
    header("Location: login.php");
    exit();
}

// Configurações de conexão com o banco de dados
$servername = "localhost"; // Hostname do servidor MySQL
$username = "root"; // Nome de usuário do MySQL
$password = ""; // Senha do MySQL
$dbname = "bancowill"; // Nome do banco de dados

$dados1;

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi estabelecida com sucesso
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Obtém os dados do formulário
$login = $_SESSION["NomeUsuario"];
var_dump($login);
// Preparando e executando a consulta SQL
$sql = "SELECT * FROM clientes WHERE Nome = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $login);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se a consulta retornou resultados
if ($result->num_rows > 0) {
    // Obtendo os dados
    $funcao = $result->fetch_all(MYSQLI_ASSOC);
    $dados1 = $funcao;
} else {
    echo "Nenhum resultado encontrado.";
}


// Fechando a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Obra</title>
    <link rel="stylesheet" href="../css/obra.css"> <!-- Estilo CSS -->
</head>
<body>
    <header>
        <!-- Seu cabeçalho aqui -->
    </header>

 
    <footer>
        <!-- Seu rodapé aqui -->
    </footer>
</body>
</html>
