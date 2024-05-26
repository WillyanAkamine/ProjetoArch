<?php $this->layout('templates/main', ['title' => 'Home Page', 'user' => $user]) ?>

<header>
        <!-- Seu cabeçalho aqui -->
    </header>

    <section id="custo-da-obra">
        <h2>Custo da Obra</h2>
        <!-- Formulário para adicionar novo relatório de custo -->
        <form id="relatorio-form" action="" method="POST" enctype="multipart/form-data">
            <label for="labor">Mão de Obra:</label>
            <input type="number" id="labor" name="labor" required><br>
            <label for="equip">Equipamentos:</label>
            <input type="number" id="equip" name="equip" required><br>
            <label for="third">Terceiros:</label>
            <input type="number" id="third" name="third" required><br>
            <label for="adm">Taxa ADM:</label>
            <input type="number" id="adm" name="adm" required><br>
            <label for="pdf">Relatório:</label>
            <input type="file" id="pdf" name="pdf" accept=".pdf"><br>
            <button type="submit">Enviar</button>
        </form>
        <!-- Seção para exibir relatórios anteriores -->
        <div id="relatorios-anteriores">
            <h3>Relatórios Anteriores</h3>
            <!-- Aqui você pode listar os relatórios anteriores -->
            <?php foreach():?>
            
            <div class="relatorio">
                <p>Data: 01/01/2024</p>
                <p>Mão de Obra: R$ 1000</p>
                <p>Equipamentos: R$ 500</p>
                <p>Terceiros: R$ 800</p>
                <p>Taxa ADM: R$ 200</p>
                <a href="caminho/do/arquivo1.pdf" target="_blank">Ver Relatório</a>
            </div>
            <div class="relatorio">
                <!-- Outros relatórios anteriores -->
            </div>
        </div>

        <!-- Total dos custos da obra -->
        <div id="total-custos">
            <h3>Total dos Custos da Obra</h3>
            <p>Mão de Obra: R$ XX</p>
            <p>Equipamentos: R$ XX</p>
            <p>Terceiros: R$ XX</p>
            <p>Taxa ADM: R$ XX</p>
            <p>Total Geral: R$ XX</p>
        </div>
        

    </section>
    <button onclick="window.history.back()">Voltar</button>
    <footer>
        <!-- Seu rodapé aqui -->
    </footer>