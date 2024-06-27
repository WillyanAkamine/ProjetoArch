<?php $this->layout('templates/main', ['title' => 'Página Inicial', 'user' => $user]) ?>

<section>
    <div class="flex row w-50 table-container bg-white shadow-lg rounded-lg overflow-hidden mx-auto">
        <h2 class="py-4 font-bold">Orçamento</h2>

        <div class="flex row">
            <div class="mb-3">
                <p class="p-0 m-0"><strong>Título</strong></p>
                <p><?= $budget->title ?></p>
            </div>

            <div class="mb-3">
                <p class="p-0 m-0"><strong>Descrição</strong></p>
                <p><?= $budget->description ?></p>
            </div>

            <div class="mb-3">
                <p class="p-0 m-0"><strong>Aceito?</strong></p>
                <p><?= $budget->accepted ? 'Aceito' : 'Pendente' ?></p>
            </div>
        </div>

        <?php if (!$budget->pdf) : ?>
            <form id="send-budget-form">
                <input hidden type="text" id="id" name="id" value="<?= $budget->id ?>" />

                <div class="mb-3">
                    <label for="title" class="form-label">Orçamento em PDF:</label>
                    <input type="file" class="form-control" id="pdf" name="pdf" required>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>

        <?php else : ?>

            <div>
                <p><strong>Orçamento já enviado!</strong></p>
                <!-- <a class="btn btn-outline-dark mb-[5px]" target="_blank" href="/pdf/Budget/<?= $budget->pdf['name'] ?>" target="_blank"> <?= $budget->pdf['name'] ?> </a> -->
            </div>

        <?php endif ?>
    </div>
</section>

<?php $this->push('scripts') ?>
<script src="/public/scripts/Budget/Send.js"></script>
<?php $this->end() ?>