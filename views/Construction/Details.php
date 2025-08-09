<?php $this->layout('templates/main', ['title' => 'Visualizar Construção', 'user' => $user]) ?>

<section class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Visualizar Construção</h1>
    
    <!-- Informações da Construção -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-4">
        <h2 class="text-xl font-semibold mb-2"><?= htmlspecialchars($construction->title) ?></h2>
        <div class="space-y-4">
            <div>
                <!-- TODO:: Colocar data inicio fim no cadastro. -->

                <strong>Data Início:</strong> <?= htmlspecialchars($construction->start_date) ?>
            </div>
            <div>
                <strong>Data Fim:</strong> <?= htmlspecialchars($construction->end_date) ?>
            </div>
            <div>
                <strong>Endereço:</strong> <?= htmlspecialchars($construction->address) ?>
            </div>
            <div>
                <strong>CEP:</strong> <?= htmlspecialchars($construction->zipcode) ?>
            </div>
            <div>
                <strong>Bairro:</strong> <?= htmlspecialchars($construction->neighborhood) ?>
            </div>
            <div>
                <strong>Cidade:</strong> <?= htmlspecialchars($construction->city) ?>
            </div>
            <div>
                <strong>Estado:</strong> <?= htmlspecialchars($construction->state) ?>
            </div>
            <div>
                <strong>Descrição:</strong> <?= htmlspecialchars($construction->description) ?>
            </div>
            <div class="mb-4">
                <strong>Progresso geral:</strong>
                <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-blue-600 bg-blue-200">
                    <?= htmlspecialchars($construction->progress) ?>%
                </span>
                <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-blue-200">
                    <div style="width:<?= htmlspecialchars($construction->progress) ?>%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"></div>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-dark">
        <thead class="bg-blue-600 text-white">
            <tr>
                <th scope="col" class="px-4 py-2">#</th>
                <th scope="col" class="px-4 py-2">Orçamento</th>
                <th scope="col" class="px-4 py-2">Descrição</th>
                <th scope="col" class="px-4 py-2">Ações</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($construction->budgets as $budget) : ?>
                <tr class="hover:bg-gray-100">
                    <td scope="row" class="px-4 py-2"><?= $budget['id'] ?></td>
                    <td class="px-4 py-2"><?= $budget['title'] ?></td>
                    <td class="px-4 py-2"><?= $budget['description'] ?></td>
                    <td class="px-4 py-2">
                        <div class="flex gap-2">
                            <a href="/budget/<?= $budget['id'] ?>/details"><img src="/public/icons/eye.svg" class="w-[35px]" alt="Vizualizar"></a>
                            <a href="/budget/<?= $budget['id'] ?>/edit"><img src="/public/icons/edit.svg" class="w-[35px]" alt="Editar"></a>
                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    
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
