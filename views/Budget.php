<?php $this->layout('templates/main', ['title' => 'Home Page', 'user' => $user]) ?>

<section>
        <h2>Solicitar Orçamento</h2>
        <!-- Formulário para solicitar orçamento -->
        <form id="orcamento-form" action="" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required><br>
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required><br>
            <label for="telefone">Telefone:</label>
            <input type="tel" id="telefone" name="telefone"><br>
            <label for="mensagem">Mensagem:</label>
            <textarea id="mensagem" name="mensagem" rows="4" cols="50" required></textarea><br>
            <button type="submit">Enviar</button>
            
        </form>

        <button onclick="window.history.back()">Voltar</button>
    </section>