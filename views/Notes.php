<?php $this->layout('templates/main', ['title' => 'Home Page', 'user' => $user]) ?>

<header>
        <!-- Seu cabeçalho aqui -->
    </header>

    <section id="notas-pagar">
        <h2>Notas a Pagar</h2>

        <!-- Formulário para adicionar nova nota a pagar -->
        <form id="adicionar-nota-form" action="" method="POST" enctype="multipart/form-data">
            <label for="descricao">Descrição:</label>
            <input type="text" id="descricao" name="descricao" required><br>
            <label for="valor">Valor:</label>
            <input type="number" id="valor" name="valor" required><br>
            <label for="pdf">PDF da nota:</label>
            <input type="file" id="pdf" name="pdf" accept=".pdf" required><br>
            <button type="submit">Adicionar Nota</button>
        </form>

        <!-- Seção para exibir notas a pagar existentes -->
        <div id="notas-existentes">
            <!-- Aqui você pode listar as notas a pagar existentes -->
            <!-- Exemplo: -->
            <!-- <div class="nota">
                <p>Descrição: </p>
                <p>Valor: </p>
                <a href="caminho/do/arquivo.pdf" target="_blank">Ver PDF</a>
            </div> -->
        </div>

        <button onclick="window.history.back()">Voltar</button>
    </section>

    <footer>
        <!-- Seu rodapé aqui -->
    </footer>