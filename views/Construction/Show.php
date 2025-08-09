<?php $this->layout('templates/main', ['title' => 'Gerenciamento de Obras', 'user' => $user]) ?>

<section>
    <div class="flex row gap-3 w-50 bg-white shadow-lg rounded-lg overflow-hidden mx-auto">
        <h2 class="py-4 font-bold">Detalhes da Obra</h2>

        <!-- Botão para adicionar uma nova obra -->
        <button id="add-construction-btn" class="btn btn-success mb-3">Adicionar Nova Obra</button>

        <!-- Formulário para criar ou editar obra (inicialmente escondido) -->
        <form id="construction-form" style="display:none;">
            <input class="form-control form-control-lg" hidden type="text" id="user_id" name="user_id" value="<?= $client_id ?>">
            <input class="form-control form-control-lg" hidden type="text" id="construction_id" name="construction_id">

            <div class="mb-3">
                <label for="name" class="form-label">Nome da Obra</label>
                <input class="form-control form-control-lg" type="text" id="name" name="name" placeholder="Nome da Obra" required>
            </div>

            <div class="mb-3">
                <textarea class="form-control w-100" placeholder="Adicione uma descrição" id="description" name="description" rows="7"></textarea>
            </div>

            <div class="mb-3">
                <label for="pdf" class="form-label">Upload PDF</label>
                <input class="form-control form-control-lg" type="file" id="pdf" name="pdf" multiple><br>
            </div>

            <button class="btn btn-primary" type="submit">Salvar Obra</button>
        </form>

        <hr/>



        <div>
            <h3 class="mb-[20px]">Relatórios Disponíveis</h3>
            <ul class="h-[300px] overflow-y-auto">
                <?php foreach ($documents as $document) : ?>
                    <div class="mb-3">
                        <li>
                            <a class="btn btn-outline-dark mb-[5px]" target="_blank" href="/pdf/Construction/<?= $document->name ?>" target="_blank"> <?= $document->name ?> </a>
                            <button class="btn btn-danger btn-sm" onclick="deleteDocument(<?= $document->id ?>)">Excluir</button>
                        </li>
                    </div>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
</section>

<?php $this->push('scripts') ?>
<script src="/public/scripts/Construction.js"></script>
<?php $this->end() ?>
