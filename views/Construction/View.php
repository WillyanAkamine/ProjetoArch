<?php $this->layout('templates/main', ['title' => 'Visualizar Construção', 'user' => $user]) ?>

<section class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4"><?= htmlspecialchars($construction->title) ?></h1>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Dados da obra</h2>
            <div class="space-y-3">
                <div><strong>Endereço:</strong> <?= htmlspecialchars($construction->address) ?></div>
                <div><strong>CEP:</strong> <?= htmlspecialchars($construction->zipcode) ?></div>
                <div><strong>Bairro:</strong> <?= htmlspecialchars($construction->neighborhood) ?></div>
                <div><strong>Cidade:</strong> <?= htmlspecialchars($construction->city) ?> / <?= htmlspecialchars($construction->state) ?></div>
                <div><strong>Progresso geral:</strong> <?= htmlspecialchars($construction->progress) ?>%</div>
                <div class="w-full bg-gray-200 rounded-full h-4">
                    <div class="bg-green-600 h-4 rounded-full" style="width: <?= htmlspecialchars($construction->progress) ?>%;"></div>
                </div>
            </div>

            <div class="mt-6">
                <a href="/obra/<?= $construction->id ?>/report" class="btn btn-primary">Baixar relatório em PDF</a>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Adicionar registro</h2>
            <form action="/obra/<?= $construction->id ?>/schedule" method="post" class="space-y-3">
                <div>
                    <label class="form-label">Etapa</label>
                    <input type="text" name="description" class="form-control" required>
                </div>
                <div>
                    <label class="form-label">Progresso (%)</label>
                    <input type="number" name="progress" min="0" max="100" class="form-control" value="0" required>
                </div>
                <div>
                    <label class="form-label">Data de início</label>
                    <input type="date" name="start_date" class="form-control" required>
                </div>
                <div>
                    <label class="form-label">Data de conclusão</label>
                    <input type="date" name="end_date" class="form-control">
                </div>
                <div>
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="Inicio">Início</option>
                        <option value="Andamento">Em andamento</option>
                        <option value="Finalizado">Finalizado</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Salvar etapa</button>
            </form>

            <hr class="my-4" />

            <form action="/obra/<?= $construction->id ?>/note" method="post" enctype="multipart/form-data" class="space-y-3">
                <div>
                    <label class="form-label">Diálogo / observação</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Mensagem ou comentário da obra"></textarea>
                </div>
                <div>
                    <label class="form-label">Documento (PDF)</label>
                    <input type="file" name="pdf[]" class="form-control" accept="application/pdf" multiple>
                </div>
                <button type="submit" class="btn btn-primary">Adicionar nota</button>
            </form>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 mt-6">
        <h2 class="text-xl font-semibold mb-4">Cronograma da obra</h2>
        <?php $statuses = ['Inicio' => 'À iniciar', 'Andamento' => 'Em andamento', 'Finalizado' => 'Finalizados']; ?>
        <div class="grid gap-4 lg:grid-cols-3">
            <?php foreach ($statuses as $statusKey => $statusLabel) : ?>
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                    <h3 class="font-semibold mb-3"><?= $statusLabel ?></h3>
                    <?php $found = false; ?>
                    <?php foreach ($construction['schedules'] as $schedule) : ?>
                        <?php if ($schedule->status === $statusKey) : ?>
                            <?php $found = true; ?>
                            <div class="mb-3 p-3 bg-white rounded-lg shadow-sm border border-gray-200">
                                <div class="font-semibold"><?= htmlspecialchars($schedule->description) ?></div>
                                <div class="text-sm text-gray-600">Progresso: <?= htmlspecialchars($schedule->progress) ?>%</div>
                                <div class="text-sm text-gray-600">De <?= htmlspecialchars($schedule->start_date) ?> até <?= htmlspecialchars($schedule->end_date ?? '-') ?></div>
                            </div>
                        <?php endif ?>
                    <?php endforeach ?>
                    <?php if (!$found) : ?>
                        <p class="text-sm text-gray-500">Sem etapas nesta fase</p>
                    <?php endif ?>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 mt-6">
        <h2 class="text-xl font-semibold mb-4">Notas e documentos</h2>
        <?php if (!empty($construction['notes'])) : ?>
            <div class="space-y-3">
                <?php foreach ($construction['notes'] as $note) : ?>
                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div class="font-semibold"><?= htmlspecialchars($note->description) ?></div>
                        <div class="text-sm text-gray-600"><?= htmlspecialchars($note->created_at) ?></div>
                        <?php if ($note->pdf) : ?>
                            <div class="mt-2">
                                <a class="btn btn-outline-dark" target="_blank" href="/pdf/Notes/<?= $note->pdf->name ?>">Abrir documento</a>
                            </div>
                        <?php endif ?>
                    </div>
                <?php endforeach ?>
            </div>
        <?php else : ?>
            <p class="text-gray-500">Nenhuma nota registrada ainda.</p>
        <?php endif ?>
    </div>
</section>

<?php $this->push('scripts') ?>
<script src="/public/scripts/ConstructionView.js"></script>
<?php $this->end() ?>
