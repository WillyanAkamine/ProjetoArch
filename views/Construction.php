<?php $this->layout('templates/main', ['title' => 'Home Page', 'user' => $user]) ?>



<section id="obra-details">
    <h2>Detalhes da Obra</h2>
    <!-- Exibir informações da obra -->
    <div id="obra-info">
        <!-- Aqui você pode exibir as informações detalhadas da obra -->
    </div>

    <!-- Formulário para adicionar novas atualizações -->
        <form id="atualizacao-form" enctype="multipart/form-data" action="obra" method="POST">
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" rows="4" cols="50"></textarea><br>
            <label for="pdf">Documentos:</label>
            <input type="file" id="pdf" name="pdf" multiple><br>
            <button type="submit">Enviar</button>
        </form>

        <!-- Seção para exibir atualizações anteriores -->
        <div id="atualizacoes-anteriores">
            <!-- Aqui você pode listar as atualizações anteriores, com descrição, fotos, etc. -->
        </div>

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