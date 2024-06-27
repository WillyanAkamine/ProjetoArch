<?php $this->layout('templates/main', ['title' => 'Clientes', 'user' => $user]) ?>

<section>
    <div class="flex flex-column w-50 table-container bg-white shadow-lg rounded-lg overflow-hidden mx-auto">
        <div class="flex w-100 justify-end">
            <a class="btn btn-primary" href="orcamentos/solicitar">Solicitar Orçamento</a>
        </div>
        <table class="table m-2">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th scope="col" class="px-4 py-2">#</th>
                    <?php if ($user['role_id'] == 1) : ?>
                        <th scope="col" class="px-4 py-2">Cliente</th>
                    <?php endif ?>
                    <th scope="col" class="px-4 py-2">Titulo</th>
                    <th scope="col" class="px-4 py-2">Status</th>
                    <th scope="col" class="px-4 py-2">Ações</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($budgets as $budget) : ?>
                    <tr class="hover:bg-gray-100">
                        <th scope="row" class="px-4 py-2"><?= $budget['id'] ?></th>
                        <?php if ($user['role_id'] == 1) : ?>
                            <th scope="row" class="px-4 py-2"><?= $budget['client']['name'] ?></th>
                        <?php endif ?>
                        <th scope="row" class="px-4 py-2"><?= $budget['title'] ?></th>
                        <th scope="row" class="px-4 py-2"><?= $budget['accepted'] ? 'Aceito' : 'Pendente' ?></th>
                        <td class="px-4 py-2">
                            <a class="btn btn-primary" href="/orcamentos/ver/<?= $budget['id'] ?>">Ver</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</section>