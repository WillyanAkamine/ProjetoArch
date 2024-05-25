<?php

session_start();

// Verifica se os dados do formulário foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Configurações de conexão com o banco de dados


  // Obtém os dados do formulário
  $login = $_POST["Nome"];
  $senha = $_POST["Senha"];

  // Cria uma conexão com o banco de dados
  $conn = new mysqli($servername, $username, $password, $dbname, $port);

  // Verifica se a conexão foi estabelecida com sucesso
  if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
  }

  // Prepara uma instrução SQL para buscar o usuário no banco de dados
  $sql = "SELECT * FROM clientes WHERE Nome = ? AND Senha = ?";

  // Prepara a instrução SQL para execução
  $stmt = $conn->prepare($sql);

  // Verifica se a preparação da instrução SQL foi bem-sucedida
  if ($stmt === false) {
    die("Erro ao preparar a instrução SQL: " . $conn->error);
  }

  // Associa os parâmetros da instrução SQL aos valores dos dados do formulário
  $stmt->bind_param("ss", $login, $senha);

  // Executa a instrução SQL
  $stmt->execute();

  // Obtém o resultado da consulta
  $result = $stmt->get_result();

  // Verifica se o usuário foi encontrado
  if ($result->num_rows > 0) {
    // O usuário foi encontrado, redireciona para a página principal
    $_SESSION['NomeUsuario'] = $login;
    header("Location: index.php");
    exit();
  } else {
    // O usuário não foi encontrado, exibe mensagem de erro
    $mensagem_erro = "Usuário ou senha incorretos.";
  }

  // Fecha a conexão com o banco de dados
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="css/login.css"> <!-- Estilo CSS -->
</head>

<body>
  <header>
    <!-- Cabeçalho aqui -->
  </header>

  <section id="login">
    <h2>Login</h2>
    <!-- Mensagem de erro -->
    <?php if (isset($mensagem_erro)) : ?>
      <div style="color: red;"><?php echo $mensagem_erro; ?></div>
    <?php endif; ?>
    <!-- Formulário de login -->
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <label for="Nome">Nome:</label>
      <input type="text" id="Nome" name="Nome" required><br>
      <label for="Senha">Senha:</label>
      <input type="password" id="Senha" name="Senha" required><br>
      <button type="submit">Entrar</button>
    </form>
  </section>

  <footer>
    <!-- Rodapé aqui -->
  </footer>
</body>

</html>
