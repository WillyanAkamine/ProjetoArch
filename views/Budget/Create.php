<?php $this->layout('templates/main', ['title' => 'Criar Orçamento', 'user' => $user]) ?>

<section class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Criar Orçamento</h1>

    <!-- Orçamento Rápido -->
    <div class="bg-gray-100 p-4 rounded-lg mb-6">
        <h2 class="text-xl font-bold mb-4">Orçamento Rápido</h2>
        <form id="quick-budget-form" class="space-y-4">
            <div>
                <label for="tipo_obra">Tipo de Obra</label>
                <select id="tipo_obra" name="tipo_obra" required class="mt-1 block w-full border-gray-300 rounded-md">
                    <option value="">Selecione</option>
                    <option value="R-1">Residencial R-1</option>
                    <option value="PP-4">Residencial PP-4</option>
                    <option value="R-8">Residencial R-8</option>
                    <option value="R-16">Residencial R-16</option>
                    <option value="PIS">Residencial PIS</option>
                    <option value="CAL-8">Comercial CAL-8</option>
                    <option value="CSL-8">Comercial CSL-8</option>
                    <option value="CSL-16">Comercial CSL-16</option>
                    <option value="GI">Industrial GI</option>
                    <option value="RP1Q">Popular RP1Q</option>
                </select>
            </div>
            <div>
                <label for="padrao">Padrão</label>
                <select id="padrao" name="padrao" required class="mt-1 block w-full border-gray-300 rounded-md">
                    <option value="">Selecione o tipo de obra primeiro</option>
                </select>
            </div>
            <div>
                <label for="regiao">Região</label>
                <select id="regiao" name="regiao" required class="mt-1 block w-full border-gray-300 rounded-md">
                    <option value="SP">SP</option>
                </select>
            </div>
            <div>
                <label for="area">Área construída (m²)</label>
                <input type="number" id="area" name="area" min="1" required class="mt-1 block w-full border-gray-300 rounded-md">
            </div>
            <div class="md:col-span-2 flex items-end">
                <button type="button" id="btn-calcular-rapido"
                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    Calcular orçamento rápido
                </button>
            </div>
        </form>
        <div id="resultado-orcamento-rapido" class="mt-4 text-lg font-semibold text-green-700"></div>
        <div class="text-xs text-gray-500 mt-2">* Valor estimado com base em dados Siduscom. Pode variar conforme acabamento.</div>
    </div>

    <!-- Legenda dos tipos de obra -->
    <div class="mb-4 p-4 bg-blue-50 rounded">
        <strong>Legenda dos tipos de obra:</strong>
        <ul class="list-disc ml-6 text-sm">
            <li><b>R-1</b>: Residência unifamiliar</li>
            <li><b>PP-4</b>: Prédio popular até 4 pavimentos</li>
            <li><b>R-8</b>: Prédio residencial até 8 pavimentos</li>
            <li><b>R-16</b>: Prédio residencial até 16 pavimentos</li>
            <li><b>PIS</b>: Programa de Interesse Social</li>
            <li><b>CAL-8</b>: Comercial andares livres</li>
            <li><b>CSL-8</b>: Comercial salas e lojas até 8 pavimentos</li>
            <li><b>CSL-16</b>: Comercial salas e lojas até 16 pavimentos</li>
            <li><b>GI</b>: Galpão industrial</li>
            <li><b>RP1Q</b>: Residência popular</li>
        </ul>
    </div>

    <!-- Orçamento Detalhado -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <form id="budget-form" class="space-y-4" method="POST" action="/orcamentos/create">
            <!-- Cliente -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700">Cliente</label>
                    <select id="user_id" name="user_id" required class="mt-1 block w-full border-gray-300 rounded-md">
                        <option value="">Selecione um cliente</option>
                        <?php foreach ($users as $user): ?>
                        <option value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div>
                    <label for="construction_id" class="block text-sm font-medium text-gray-700">Obra</label>
                    <select id="construction_id" name="construction_id" required
                        class="mt-1 block w-full border-gray-300 rounded-md">
                        <option value="">Selecione uma obra</option>
                        <?php foreach ($constructions as $construction): ?>
                        <option value="<?= $construction['id'] ?>"><?= $construction['title'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                    <input type="text" id="title" name="title" required
                        class="mt-1 block w-full border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="status" name="status" required class="mt-1 block w-full border-gray-300 rounded-md">
                        <option value="Pendente">Pendente</option>
                        <option value="Aceito">Aceito</option>
                        <option value="Nao_aceito">Não aceito</option>
                    </select>
                </div>
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                <textarea id="description" name="description" rows="3" required
                    class="mt-1 block w-full border-gray-300 rounded-md"></textarea>
            </div>

            <!-- Etapas e Materiais -->
            <h2 class="text-xl font-bold mt-6">Etapas da Construção</h2>
            <div class="flex space-x-4 mb-4">
                <?php
                $etapas = ['Fundacao', 'Alvenaria', 'Eletrica', 'Hidraulica', 'Cobertura'];
                foreach ($etapas as $etapa): ?>
                <button type="button" class="etapa-tab bg-gray-200 px-4 py-2 rounded-md hover:bg-gray-300"
                    data-etapa="<?= strtolower($etapa) ?>">
                    <?= $etapa ?>
                </button>
                <?php endforeach; ?>
            </div>

            <div id="materiais-container" class="mt-4">
                <?php foreach ($etapas as $etapa): ?>
                <div class="materiais-list hidden" id="materiais-<?= strtolower($etapa) ?>">
                    <h3 class="text-lg font-semibold"><?= $etapa ?> - Materiais</h3>
                    <table class="w-full mt-2 border">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-2 py-1">Material</th>
                                <th class="border px-2 py-1">Quantidade</th>
                                <th class="border px-2 py-1">Preço Unitário</th>
                                <th class="border px-2 py-1">Total</th>
                                <th class="border px-2 py-1">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($materials as $material): ?>
                            <?php if (strtolower($material['category']) === strtolower($etapa)): ?>
                            <tr>
                                <td class="border px-2 py-1"><?= $material['name'] ?></td>
                                <td class="border px-2 py-1">
                                    <input type="number" min="1" class="w-16 border p-1 quantidade-input"
                                        name="materials[<?= $material['id'] ?>][quantity]"
                                        data-price="<?= $material['price'] ?>">
                                    <input type="hidden" name="materials[<?= $material['id'] ?>][id]"
                                        value="<?= $material['id'] ?>">
                                    <input type="hidden" name="materials[<?= $material['id'] ?>][price]"
                                        value="<?= $material['price'] ?>">
                                </td>
                                <td class="border px-2 py-1">R$ <?= number_format($material['price'], 2, ',', '.') ?>
                                </td>
                                <td class="border px-2 py-1 item-total">R$ 0,00</td>
                                <td class="border px-2 py-1"><button type="button" class="text-red-500">Remover</button>
                                </td>
                            </tr>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Botões -->
            <div class="flex space-x-4 mt-4">
                <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                    Criar
                </button>
                <button type="reset"
                    class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                    Limpar
                </button>
            </div>
        </form>
    </div>
</section>

<?php $this->push('scripts') ?>
<script>
const padraoPorObra = {
    "R-1": ["Baixo", "Normal", "Alto"],
    "PP-4": ["Baixo", "Normal"],
    "R-8": ["Baixo", "Normal", "Alto"],
    "R-16": ["Normal", "Alto"],
    "PIS": ["Baixo"],
    "CAL-8": ["Normal", "Alto"],
    "CSL-8": ["Normal", "Alto"],
    "CSL-16": ["Normal", "Alto"],
    "GI": ["Normal"],
    "RP1Q": ["Normal"]
};

document.getElementById('tipo_obra').addEventListener('change', function() {
    const tipo = this.value;
    const padraoSelect = document.getElementById('padrao');
    padraoSelect.innerHTML = '<option value="">Selecione</option>';
    if (padraoPorObra[tipo]) {
        padraoPorObra[tipo].forEach(function(padrao) {
            padraoSelect.innerHTML += `<option value="${padrao}">${padrao}</option>`;
        });
    } else {
        padraoSelect.innerHTML = '<option value="">Selecione o tipo de obra primeiro</option>';
    }
});

// Orçamento rápido
document.getElementById('btn-calcular-rapido').addEventListener('click', function() {
    const form = document.getElementById('quick-budget-form');
    const data = new FormData(form);
    fetch('/api/orcamentos/rapido', {
        method: 'POST',
        body: data
    })
    .then(response => response.json())
    .then(result => {
        if (result.valor_m2_total) {
            document.getElementById('resultado-orcamento-rapido').innerHTML =
                `<b>Valor estimado total:</b> R$ ${result.total.toLocaleString('pt-BR', {minimumFractionDigits: 2})}<br>
                 <b>Mão de obra:</b> R$ ${result.mao_obra_total.toLocaleString('pt-BR', {minimumFractionDigits: 2})}<br>
                 <b>Material:</b> R$ ${result.material_total.toLocaleString('pt-BR', {minimumFractionDigits: 2})}<br>
                 <b>Administrativo:</b> R$ ${result.adm_total.toLocaleString('pt-BR', {minimumFractionDigits: 2})}<br>
                 <span class="text-xs text-gray-500">* Valores por m²: Mão de obra R$ ${result.mao_obra_m2}, Material R$ ${result.material_m2}, Adm R$ ${result.adm_m2}</span>`;
        } else {
            document.getElementById('resultado-orcamento-rapido').textContent = result.message;
        }
    })
    .catch(() => {
        document.getElementById('resultado-orcamento-rapido').textContent =
            'Erro ao consultar orçamento rápido.';
    });
});
</script>
<?php $this->end() ?>