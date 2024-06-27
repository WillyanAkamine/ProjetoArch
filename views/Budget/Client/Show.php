<?php $this->layout('templates/main', ['title' => 'Página Inicial', 'user' => $user]) ?>

<section>
    <div class="flex row w-50 table-container bg-white shadow-lg rounded-lg overflow-hidden mx-auto">
        <h2 class="py-4 font-bold">Detalhes do orçamento</h2>

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
                <p class="p-0 m-0"><strong>Status</strong></p>
                <p><?= $budget->accepted ? 'Aceito' : 'Pendente' ?></p>
            </div>

            <?php if ($budget->pdf) : ?>
                <div>
                    <p><strong>Orçamento</strong></p>
                    <a class="btn btn-outline-dark mb-[5px]" target="_blank" href="/pdf/Budget/<?= $budget->pdf['name'] ?>" target="_blank"> <?= $budget->pdf['name'] ?> </a>
                </div>
            <?php endif ?>
        </div>

        <?php if ($budget->pdf && !$budget->accepted) : ?>
            <form id="budget-form">
                <input hidden type="text" id="id" name="id" value="<?= $budget->id ?>" />

                <div class="my-3">
                    <p><strong>Aceitar orçamento</strong></p>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="accepted" id="accepted" value="1">
                        <label class="form-check-label" for="accepted">
                            Aceitar
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="accepted" id="accepted" value="0">
                        <label class="form-check-label" for="accepted">
                            Não aceitar
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        <?php endif ?>
    </div>
</section>

<?php $this->push('scripts') ?>
<script src="/public/scripts/Budget/Accepted.js"></script>
<?php $this->end() ?>