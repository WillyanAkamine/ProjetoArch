<?php $this->layout('templates/main', ['title' => 'Visualizar Construção', 'user' => $user]) ?>

<section class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Visualizar Construção</h1>
    
    <!-- Informações da Construção -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-4">
        <h2 class="text-xl font-semibold mb-2"><?= htmlspecialchars($construction->title) ?></h2>
        <div class="space-y-4">
            <div class="flex space-x-4">
                <div class="w-full">
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Data Início</label>
                    <input type="date" id="start_date" name="start_date" value="<?= htmlspecialchars($construction->start_date) ?>"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                </div>
                <div class="w-full">
                    <label for="end_date" class="block text-sm font-medium text-gray-700">Data Fim</label>
                    <input type="date" id="end_date" name="end_date" value="<?= htmlspecialchars($construction->end_date) ?>"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                </div>
            </div>

            <div class="flex space-x-4">
                <div class="w-full">
                    <label for="address" class="block text-sm font-medium text-gray-700">Endereço</label>
                    <input type="text" id="address" name="address" value="<?= htmlspecialchars($construction->address) ?>"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                </div>
                <div class="w-full">
                    <label for="zipcode" class="block text-sm font-medium text-gray-700">CEP</label>
                    <input type="text" id="zipcode" name="zipcode" value="<?= htmlspecialchars($construction->zipcode) ?>"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                </div>
            </div>

            <div class="flex space-x-4">
                <div class="w-full">
                    <label for="neighborhood" class="block text-sm font-medium text-gray-700">Bairro</label>
                    <input type="text" id="neighborhood" name="neighborhood" value="<?= htmlspecialchars($construction->neighborhood) ?>"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                </div>
                <div class="w-full">
                    <label for="city" class="block text-sm font-medium text-gray-700">Cidade</label>
                    <input type="text" id="city" name="city" value="<?= htmlspecialchars($construction->city) ?>"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                </div>
                <div class="w-full">
                    <label for="state" class="block text-sm font-medium text-gray-700">Estado</label>
                    <input type="text" id="state" name="state" value="<?= htmlspecialchars($construction->state) ?>"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"><?= htmlspecialchars($construction->description) ?></textarea>
            </div>

            <div class="mb-4">
                <label for="progress" class="block text-sm font-medium text-gray-700">Progresso geral</label>
                <div class="relative pt-1">
                    <div class="flex mb-2 items-center justify-between">
                        <div>
                            <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-blue-600 bg-blue-200">
                                <?= htmlspecialchars($construction->progress) ?>%
                            </span>
                        </div>
                        <div class="text-right">
                            <span class="text-xs font-semibold inline-block text-blue-600">
                                Completo
                            </span>
                        </div>
                    </div>
                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-blue-200">
                        <div style="width:<?= htmlspecialchars($construction->progress) ?>%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Cards para Relatórios -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-2">Relatórios da Obra</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="bg-gray-100 p-4 rounded-md shadow-sm">
                <h3 class="font-semibold">Relatório de Progresso</h3>
                <p class="text-sm text-gray-500">Visualize e baixe o relatório detalhado do progresso da obra.</p>
                <button class="mt-2 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Baixar Relatório</button>
            </div>
            <div class="bg-gray-100 p-4 rounded-md shadow-sm">
                <h3 class="font-semibold">Relatório Financeiro</h3>
                <p class="text-sm text-gray-500">Obtenha informações financeiras detalhadas da obra.</p>
                <button class="mt-2 bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">Baixar Relatório</button>
            </div>
            <div class="bg-gray-100 p-4 rounded-md shadow-sm">
                <h3 class="font-semibold">Relatório de Materiais</h3>
                <p class="text-sm text-gray-500">Acompanhe o uso e o estoque de materiais da obra.</p>
                <button class="mt-2 bg-yellow-600 text-white px-4 py-2 rounded-md hover:bg-yellow-700">Baixar Relatório</button>
            </div>
        </div>
    </div>
</section>

<?php $this->push('scripts') ?>
<script src="/public/scripts/Construction.js"></script>
<?php $this->end() ?>
