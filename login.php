
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
        <?php if(isset($_GET['erro']) && $_GET['erro'] == 'true'): ?>
            <div style="color: red;">Usuário ou senha incorretos.</div>
        <?php endif; ?>
        <!-- Formulário de login -->
        <form method="POST" action="processar_login.php">
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
