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

    <section id="obra-details">
        <h2>Detalhes da Obra</h2>
        <!-- Exibir informações da obra -->
        <div id="obra-info">
            <!-- Aqui você pode exibir as informações detalhadas da obra -->
        </div>

        <!-- Formulário para adicionar novas atualizações -->
        <?php
        // Verifica se o usuário tem função 0 ou 1
        if ($dados1[0]['funcao'] == 0) {
        ?>
        <form id="atualizacao-form" enctype="multipart/form-data">
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" rows="4" cols="50"></textarea><br>
            <label for="imagens">Imagens:</label>
            <input type="file" id="imagens" name="imagens" accept="image/*" multiple><br>
            <button type="submit">Enviar</button>
        </form>

        <!-- Seção para exibir atualizações anteriores -->
        <div id="atualizacoes-anteriores">
            <!-- Aqui você pode listar as atualizações anteriores, com descrição, fotos, etc. -->
        </div>
        <?php
        }
        ?>  
        
        <!-- Seção para exibir arquivos disponíveis -->
        <div id="arquivos-disponiveis">
            <h3>Arquivos Disponíveis</h3>
            <ul>
                <!-- Aqui você pode listar os arquivos disponíveis para esta obra -->
                <li><a href="caminho/do/arquivo1.pdf" target="_blank">Arquivo 1</a></li>
                <li><a href="caminho/do/arquivo2.pdf" target="_blank">Arquivo 2</a></li>
                <li><a href="caminho/do/arquivo3.pdf" target="_blank">Arquivo 3</a></li>
            </ul>
        </div>

        <!-- Botão de retorno -->
        <button onclick="window.history.back()">Voltar</button>
        
    </section>

    <footer>
        <!-- Seu rodapé aqui -->
    </footer>
</body>
</html>
