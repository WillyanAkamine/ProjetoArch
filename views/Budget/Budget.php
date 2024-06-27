<?php $this->layout('templates/main', ['title' => 'Página Inicial', 'user' => $user]) ?>

<section>
<div class="flex row w-50 table-container bg-white shadow-lg rounded-lg overflow-hidden mx-auto">
    <h2 class="py-4 font-bold">Solicitar Orçamento</h2>

    <form id="budget-form" class="needs-validation" novalidate>
        <input hidden type="text" id="user_id" name="user_id" value="<?= $user['id'] ?>"/>

        <div class="mb-3">
            <label for="title" class="form-label">Título:</label>
            <input type="text" class="form-control" id="title" name="title" required>
            <div class="invalid-feedback">
                Por favor, preencha seu nome.
            </div>
        </div>
     
        <div class="mb-3">
            <label for="message" class="form-label">Descrição:</label>
            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            <div class="invalid-feedback">
                Por favor, insira sua mensagem.
            </div>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>
</div>
</section>

<?php $this->push('scripts') ?>
<script src="/public/scripts/Budget/Create.js"></script>
<?php $this->end() ?>