<?php $this->layout('templates/main', ['title' => 'Home Page', 'user' => $user]) ?>

<section id="obra-details" class="container my-5">
    <h2 class="py-4 font-bold">Detalhes da Obra</h2>

    <form id="construction-form">
        <div class="mb-3">
            <textarea class="form-control" placeholder="Leave a comment here" id="description" name="description"></textarea>
            <label for="description">Descrição</label>
        </div>

        <div class="mb-3"> 
            <label for="pdf" class="form-label">Documentos</label>
            <input class="form-control form-control-lg" type="file" id="pdf" name="pdf" multiple><br>
        </div>

        <button type="submit">Enviar</button>
    </form>

    <div id="arquivos-disponiveis">
        <h3 class="mb-[20px]">Relatórios Disponíveis</h3>
        <ul class="h-[300px] overflow-y-auto">
            <?php foreach($documents as $document): ?>
                <div class="mb-3">
                <li>
                    <a class="btn btn-outline-dark mb-[5px]" target="_blank" href="/pdf/Construction/<?=$document->name?>" target="_blank"> <?=$document->name?> </a>
                </li>
                </div>
            <?php endforeach?>
        </ul>
    </div>
</section>

<?php $this->push('scripts') ?>
    <script src="/public/scripts/Construction.js"></script>
<?php $this->end() ?>