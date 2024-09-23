<?php $this->layout('templates/main', ['title' => 'Criar Construção', 'user' => $user]) ?>

<section class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Criar Construção</h1>
    
    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="/construction/create" method="POST" class="space-y-4">
            <!-- Título -->
            <div class="flex space-x-4">
                <div class="w-full">
                    <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                    <input type="text" id="title" name="title" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                </div>
                
                <!-- Endereço -->
                <div class="w-full">
                    <label for="address" class="block text-sm font-medium text-gray-700">Endereço</label>
                    <input type="text" id="address" name="address" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                </div>
            </div>

            <!-- CEP e Bairro -->
            <div class="flex space-x-4">
                <div class="w-full">
                    <label for="cep" class="block text-sm font-medium text-gray-700">CEP</label>
                    <input type="text" id="cep" name="cep" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                </div>
                <div class="w-full">
                    <label for="neighborhood" class="block text-sm font-medium text-gray-700">Bairro</label>
                    <input type="text" id="neighborhood" name="neighborhood" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                </div>
            </div>

            <!-- Cidade e Estado -->
            <div class="flex space-x-4">
                <div class="w-full">
                    <label for="city" class="block text-sm font-medium text-gray-700">Cidade</label>
                    <input type="text" id="city" name="city" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                </div>
                <div class="w-full">
                    <label for="state" class="block text-sm font-medium text-gray-700">Estado</label>
                    <input type="text" id="state" name="state" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                </div>
            </div>

            <!-- Cliente -->
            <div>
                <label for="client" class="block text-sm font-medium text-gray-700">Cliente</label>
                <select id="client" name="client" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="">Selecione um cliente</option>
                    <?php foreach ($clients as $client): ?>
                        <option value="<?= $client['id'] ?>"><?= $client['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <!-- Descrição -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                <textarea id="description" name="description" rows="3" required
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
            </div>

            <!-- Botões -->
            <div class="flex space-x-4">
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
<script src="/public/scripts/Construction.js"></script>
<?php $this->end() ?>
