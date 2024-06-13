<?php $this->layout('templates/main', ['title' => 'Home Page', 'user' => $user]) ?>

<section id="obra-details" class="container my-5">

    <h2 class="py-4 font-bold">Detalhes da Obra</h2>



    <div id="arquivos-disponiveis">
        <h3 class="mb-[20px]">Relatórios Disponíveis</h3>
        <ul class="h-[300px] overflow-y-auto">
            <?php foreach ($documents as $document) : ?>
                <div class="mb-3">
                    <li>
                        <a class="btn btn-outline-dark mb-[5px]" target="_blank" href="/pdf/Construction/<?= $client_id ?>/<?= $document->name ?>" target="_blank"> <?= $document->construction->description ?> </a>
                    </li>
                </div>
            <?php endforeach ?>
        </ul>
    </div>
</section>

<?php $this->push('scripts') ?>
<script src="/public/scripts/Construction.js"></script>
<?php $this->end() ?>