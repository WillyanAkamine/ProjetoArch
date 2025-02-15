<?php $this->layout('templates/main', ['title' => 'Atualizar Construção', 'user' => $user]) ?>

<section class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Atualizar Construção</h1>
    
    <div class="bg-white shadow-md rounded-lg p-6">
    <input type="hidden" name="_method" value="PUT">

        <form action="/construction/update/<?= htmlspecialchars($construction->id) ?>" method="POST" class="space-y-4">
            
            Adicione o token CSRF, se estiver utilizando
            <!-- <input type="hidden" name="_token" value="<?= csrf_token() ?>"> -->
            <!-- <input type="hidden" name="_method" value="PUT">

            <-- Título -->
            <div class="flex space-x-4">
                <div class="w-full">
                    <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                    <input type="text" id="title" name="title" value="<?= htmlspecialchars($construction->title) ?>" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                </div>
                
                <!-- Endereço -->
                <div class="w-full">
                    <label for="address" class="block text-sm font-medium text-gray-700">Endereço</label>
                    <input type="text" id="address" name="address" value="<?= htmlspecialchars($construction->address) ?>" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                </div>
            </div>

            <!-- CEP e Bairro -->
            <div class="flex space-x-4">
                <div class="w-full">
                    <label for="zipcode" class="block text-sm font-medium text-gray-700">CEP</label>
                    <input type="text" id="zipcode" name="zipcode" value="<?= htmlspecialchars($construction->zipcode) ?>" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                </div>
                <div class="w-full">
                    <label for="neighborhood" class="block text-sm font-medium text-gray-700">Bairro</label>
                    <input type="text" id="neighborhood" name="neighborhood" value="<?= htmlspecialchars($construction->neighborhood) ?>" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                </div>
            </div>

            <!-- Cidade e Estado -->
            <div class="flex space-x-4">
                <div class="w-full">
                    <label for="city" class="block text-sm font-medium text-gray-700">Cidade</label>
                    <input type="text" id="city" name="city" value="<?= htmlspecialchars($construction->city) ?>" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                </div>
                <div class="w-full">
                    <label for="state" class="block text-sm font-medium text-gray-700">Estado</label>
                    <input type="text" id="state" name="state" value="<?= htmlspecialchars($construction->state) ?>" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                </div>
            </div>

            <!-- Descrição -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                <textarea id="description" name="description" rows="3" required
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"><?= htmlspecialchars($construction->description) ?></textarea>
            </div>

            <!-- Progresso -->
            <div>
                <label for="progress" class="block text-sm font-medium text-gray-700">Progresso</label>
                <input type="number" id="progress" name="progress" value="<?= htmlspecialchars($construction->progress) ?>" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
            </div>

            <!-- Botões -->
            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Atualizar</button>
                <button type="reset" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">Limpar</button>
            </div>
        </form>
    </div>
</section>

<?php $this->push('scripts') ?>
<script src="/public/scripts/Construction.js"></script>
<?php $this->end() ?>
