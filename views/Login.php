<?php $this->layout('templates/main', ['title' => 'Login']) ?>

<section id="login">
    <h2>Login</h2>

    <?php if(isset($_GET['erro']) && $_GET['erro'] == 'true'): ?>
        <div style="color: red;">Usuário ou senha incorretos.</div>
    <?php endif; ?>

    <form method="POST" action="login">
        <label for="name">Nome:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Entrar</button>
    </form>
</section>