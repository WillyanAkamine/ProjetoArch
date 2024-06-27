<?php $this->layout('templates/main', ['title' => 'Clientes', 'user' => $user]) ?>

<section>
<div class="flex w-50 table-container bg-white shadow-lg rounded-lg overflow-hidden mx-auto">
    <table class="table m-2">
        <thead class="bg-blue-600 text-white">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <th scope="row"><?= $user['id']?></th>
                    <td><?= $user['name']?></td>
                    <td>
                        <a class="btn btn-primary" href="/nota/<?=$user['id']?>">Ver</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
</section>

<?php $this->push('scripts') ?>
<script src="/public/scripts/Notes.js"></script>
<?php $this->end() ?>