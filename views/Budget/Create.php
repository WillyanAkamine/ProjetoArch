<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Criar Orçamento</title>
    <link rel="stylesheet" href="path/to/your/css/style.css">
    <script src="/public/scripts/Budget/Create.js" defer></script>
</head>
<body>
    <h1>Criar Orçamento</h1>

    <!-- Dados do Cliente -->
    <section id="dados-cliente">
        <h2>Dados do Cliente</h2>
        <form id="budget-form">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome">
            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco">
            <!-- Adicione outros campos conforme necessário -->
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id']; ?>">
        </form>
    </section>

    <!-- Etapas da Obra e Categorias -->
    <section id="etapas-obra">
        <h2>Etapas da Obra</h2>
        <div id="categorias">
            <!-- Categorias dinâmicas serão adicionadas aqui via JS -->
        </div>
        <button type="button" id="adicionarCategoria">Adicionar Nova Categoria</button>
    </section>

    <!-- Tabela de Itens Orçados -->
    <section id="itens-orcados">
        <h2>Itens Orçados</h2>
        <table id="orcamentoTable">
            <thead>
                <tr>
                    <th>Etapa</th>
                    <th>Material</th>
                    <th>Quantidade</th>
                    <th>Preço Unitário</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <!-- Linhas dinâmicas -->
            </tbody>
        </table>
    </section>

    <!-- Botões de Ação -->
    <section id="acoes">
        <button type="submit" form="budget-form">Salvar Orçamento</button>
        <button type="reset" form="budget-form">Limpar Formulário</button>
        <button type="button" id="adicionarItem">Adicionar Novo Item</button>
    </section>

    <!-- Modal para Adicionar Novo Item -->
    <div id="modalAdicionarItem" class="modal" style="display:none;">
        <div class="modal-content">
            <h2>Adicionar Material</h2>
            <form id="itemForm">
                <label for="material">Material:</label>
                <input type="text" id="material" name="material">
                <label for="quantidade">Quantidade:</label>
                <input type="number" id="quantidade" name="quantidade">
                <!-- Outros campos conforme necessário -->
            </form>
            <button type="button" id="fecharModal">Fechar</button>
            <button type="button" id="adicionarItemModal">Adicionar</button>
        </div>
    </div>

    <!-- Modal para Adicionar Nova Categoria -->
    <div id="modalAdicionarCategoria" class="modal" style="display:none;">
        <div class="modal-content">
            <h2>Adicionar Nova Categoria</h2>
            <form id="categoriaForm">
                <label for="nomeCategoria">Nome da Categoria:</label>
                <input type="text" id="nomeCategoria" name="nomeCategoria">
                <label for="itens">Itens:</label>
                <textarea id="itens" name="itens" placeholder="Insira os itens, um por linha"></textarea>
                <!-- Outros campos conforme necessário -->
            </form>
            <button type="button" id="fecharModalCategoria">Fechar</button>
            <button type="button" id="adicionarCategoriaModal">Adicionar</button>
        </div>
    </div>

</body>
</html>
