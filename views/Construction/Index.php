<?php $this->layout('templates/main', ['title' => 'Clientes', 'user' => $user]) ?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-lg-down">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form id="construction-form w-100">
            <input class="form-control form-control-lg" hidden type="text" id="user_id" name="user_id" value="<?= $client_id ?>" />
        
            <div class="mb-3 w-100">
                <label for="title" class="form-label">Título</label>
                <input class="form-control-lg" type="text" placeholder="Título">
            </div>

            <div class="mb-3 w-100">
                <label for="description" class="form-label">Descrição</label>
                <textarea class="form-control w-100" placeholder="Adicione uma descrição" id="description" name="description" rows="7"></textarea>
            </div>

            <div class="mb-3 w-100">
                <label for="pdf" class="form-label">Upload PDF</label>
                <input class="form-control form-control-lg" type="file" id="pdf" name="pdf" multiple><br>
            </div>

            <div class="mb-3 w-100">
                <label for="floatingSelect">Clientes</label>
                <select class="form-select" id="client_id" name="client_id" aria-label="Clientes">
                    <option selected>Selecione um cliente</option>
                    <option value="1">Will</option>
                    <option value="2">Marcelo</option>
                    <option value="3">Fabio</option>
                </select>
            </div>

            <button type="submit">Enviar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<section class="container mt-5">
        <div class="table-container bg-white shadow-lg rounded-lg overflow-hidden w-50 mx-auto">
            <table class="table w-100">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th scope="col" class="px-4 py-2">#</th>
                        <th scope="col" class="px-4 py-2">Nome</th>
                        <th scope="col" class="px-4 py-2">Ações</th>
                        <th scope="col" class="px-4 py-2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            +
                        </button>
                        </th>
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