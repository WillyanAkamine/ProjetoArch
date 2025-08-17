<?php $this->layout('templates/main', ['title' => 'Clientes', 'user' => $user]) ?>

<section>
    <div class="flex row gap-3 w-50 bg-white shadow-lg rounded-lg overflow-hidden mx-auto">
        <h2 class="py-4 font-bold">Lista de Orçamentos</h2>

        <div class="flex justify-end mt-40px">
            <a href="/orcamentos/create">
                <img src="/public/icons/create.svg" class="w-[50px]" alt="Criar">
            </a>
        </div>
    </div>
    <div class="flex w-50 table-container shadow-lg rounded-lg overflow-hidden mx-auto bg-[#212529] mt-[25px]">
        <table class="table table-dark">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th scope="col" class="px-4 py-2">#</th>
                    <th scope="col" class="px-4 py-2">Obra</th>
                    <th scope="col" class="px-4 py-2">Descrição</th>
                    <th scope="col" class="px-4 py-2">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($budgets as $budget) : ?>
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
    </div>
</section>

<?php $this->push('scripts') ?>
<script src="/public/scripts/Budget.js"></script>
<?php $this->end() ?>
