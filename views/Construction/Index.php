<?php $this->layout('templates/main', ['title' => 'Clientes', 'user' => $user]) ?>

<section>
    <div class="flex w-50 table-container bg-white shadow-lg rounded-lg overflow-hidden mx-auto">
        <table class="table m-2">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th scope="col" class="px-4 py-2">#</th>
                    <th scope="col" class="px-4 py-2">Nome</th>
                    <th scope="col" class="px-4 py-2">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($users as $user) : ?>
                    <tr class="hover:bg-gray-100">
                        <th scope="row" class="px-4 py-2"><?= $user['id'] ?></th>
                        <td class="px-4 py-2"><?= $user['name'] ?></td>
                        <td class="px-4 py-2">
                            <a class="btn btn-primary" href="/obra/<?= $user['id'] ?>">Ver</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</section>

<?php $this->push('scripts') ?>
<script src="/public/scripts/Construction.js"></script>
<?php $this->end() ?>