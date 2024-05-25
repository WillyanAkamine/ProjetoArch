<?php $this->layout('templates/main', ['title' => 'Login']) ?>

<section id="login">
    <h2>Login</h2>

    <?php if(isset($_GET['erro']) && $_GET['erro'] == 'true'): ?>
        <div style="color: red;">Usuário ou senha incorretos.</div>
    <?php endif; ?>

    <form method="POST" action="login">
        <label for="Nome">Nome:</label>
        <input type="text" id="Nome" name="Nome" required><br>
        <label for="Senha">Senha:</label>
        <input type="password" id="Senha" name="Senha" required><br>
        <button type="submit">Entrar</button>
    </form>
</section>