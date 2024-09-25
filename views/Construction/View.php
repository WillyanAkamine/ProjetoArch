<?php $this->layout('templates/main', ['title' => 'Visualizar Construção', 'user' => $user]) ?>

<section class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4"><?= htmlspecialchars($construction['title']) ?></h1>
    
    <!-- Informações principais -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Título</label>
                <input type="text" value="<?= htmlspecialchars($construction['title']) ?>" disabled
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Endereço</label>
                <input type="text" value="<?= htmlspecialchars($construction['address']) ?>" disabled
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">CEP</label>
                <input type="text" value="<?= htmlspecialchars($construction['cep']) ?>" disabled
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Bairro</label>
                <input type="text" value="<?= htmlspecialchars($construction['neighborhood']) ?>" disabled
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Cidade</label>
                <input type="text" value="<?= htmlspecialchars($construction['city']) ?>" disabled
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Estado</label>
                <input type="text" value="<?= htmlspecialchars($construction['state']) ?>" disabled
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm" />
            </div>
        </div>
        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700">Previsão de Início</label>
            <input type="text" value="Início previsto para mês de <?= htmlspecialchars($construction['start_date']) ?>" disabled
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm" />
        </div>
    </div>

    <!-- Informações adicionais -->
    <h2 class="text-xl font-bold mb-4">Informações adicionais</h2>
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <!-- Progresso geral -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Progresso geral</label>
            <div class="w-full bg-gray-200 rounded-full h-4">
                <div class="bg-green-600 h-4 rounded-full" style="width: <?= $construction['progress'] ?>%;"></div>
            </div>
        </div>

        <!-- Cronograma -->
        <div class="grid grid-cols-3 gap-4">
            <!-- A Iniciar -->
            <div>
                <h3 class="text-md font-bold">À iniciar</h3>
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h4 class="font-bold text-gray-800">Card Title</h4>
                    <p class="text-gray-600">Some quick example text to build on the card title and make up the bulk...</p>
                    <span class="inline-block bg-yellow-400 text-white px-2 py-1 rounded-full text-xs">Pendente</span>
                </div>
            </div>

            <!-- Em Andamento -->
            <div>
                <h3 class="text-md font-bold">Em andamento</h3>
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h4 class="font-bold text-gray-800">Card Title</h4>
                    <p class="text-gray-600">Some quick example text to build on the card title and make up the bulk...</p>
                    <span class="inline-block bg-green-500 text-white px-2 py-1 rounded-full text-xs">Finalizado</span>
                </div>
            </div>

            <!-- Finalizados -->
            <div>
                <h3 class="text-md font-bold">Finalizados</h3>
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h4 class="font-bold text-gray-800">Card Title</h4>
                    <p class="text-gray-600">Some quick example text to build on the card title and make up the bulk...</p>
                    <span class="inline-block bg-green-500 text-white px-2 py-1 rounded-full text-xs">Finalizado</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Botões de Ação -->
    <div class="flex space-x-4">
        <a href="/construction/edit/<?= $construction['id'] ?>" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
            Editar
        </a>
        <a href="/construction/delete/<?= $construction['id'] ?>" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
            Excluir
        </a>
    </div>
</section>

<?php $this->push('scripts') ?>
<script src="/public/scripts/ConstructionView.js"></script>
<?php $this->end() ?>
