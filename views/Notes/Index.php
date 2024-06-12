<?php $this->layout('templates/main', ['title' => 'Clientes', 'user' => $user]) ?>

<section>
    <table class="table w-50">
        <thead>
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
                        <a href="/nota/<?=$user['id']?>">Ver</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</section>

<?php $this->push('scripts') ?>
<script src="/public/scripts/Notes.js"></script>
<?php $this->end() ?>