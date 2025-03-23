<?php $this->layout('templates/main', ['title' => 'Criar Orçamento', 'user' => $user]) ?>

<section class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Criar Orçamento</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form id="budget-form" class="space-y-4">
            <!-- Cliente -->
            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700">Cliente</label>
                <select id="user_id" name="user_id" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="">Selecione um cliente</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <!-- Descrição -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                <textarea id="description" name="description" rows="3" required
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
            </div>

            <!-- Seção de Etapas -->
            <h2 class="text-xl font-bold mt-6">Etapas da Construção</h2>
            <div class="flex space-x-4">
                <?php
                $etapas = ['Fundação', 'Alvenaria', 'Elétrica', 'Hidráulica', 'Cobertura'];
                foreach ($etapas as $etapa): ?>
                    <button type="button" class="etapa-tab bg-gray-200 px-4 py-2 rounded-md hover:bg-gray-300"
                            data-etapa="<?= strtolower($etapa) ?>">
                        <?= $etapa ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <!-- Lista de Materiais por Etapa -->
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
                                    <?php if ($material['etapa'] === strtolower($etapa)): ?>
                                        <tr>
                                            <td class="border px-2 py-1"><?= $material['name'] ?></td>
                                            <td class="border px-2 py-1"><input type="number" min="1" class="w-16 border p-1"></td>
                                            <td class="border px-2 py-1">R$ <?= number_format($material['price'], 2, ',', '.') ?></td>
                                            <td class="border px-2 py-1">R$ 0,00</td>
                                            <td class="border px-2 py-1"><button type="button" class="text-red-500">Remover</button></td>
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
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                    Criar
                </button>
                <button type="reset" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                    Limpar
                </button>
            </div>
        </form>
    </div>
</section>

<?php $this->push('scripts') ?>
<script src="/public/scripts/Budget/Create.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const etapaTabs = document.querySelectorAll(".etapa-tab");
        const materiaisSections = document.querySelectorAll(".materiais-list");

        etapaTabs.forEach(tab => {
            tab.addEventListener("click", () => {
                const etapa = tab.dataset.etapa;
                materiaisSections.forEach(section => section.classList.add("hidden"));
                document.getElementById(`materiais-${etapa}`).classList.remove("hidden");
            });
        });
    });
</script>
<?php $this->end() ?>
