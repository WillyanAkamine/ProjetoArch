<?php $this->layout('templates/main', ['title' => 'Home Page', 'user' => $user]) ?>

<section id="obra-details">
    <h2 class="py-[20px] text-bold">Detalhes da Obra</h2>

    <form id="construction-form" enctype="multipart/form-data">
        <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" id="description" name="description"></textarea>
            <label for="description">Descrição</label>
        </div>

        <div>
            <label for="pdf" class="form-label">Documentos</label>
            <input class="form-control form-control-lg" type="file" id="pdf" name="pdf" multiple><br>
        </div>

        <button type="submit">Enviar</button>
    </form>

    <div id="arquivos-disponiveis">
        <h3 class="mb-[20px]">Relatórios Disponíveis</h3>
        <ul class="h-[300px] overflow-y-auto">
            <li><a class="btn btn-outline-dark mb-[5px]" href="caminho/do/arquivo1.pdf" target="_blank">Arquivo 1</a></li>
            <li><a class="btn btn-outline-dark mb-[5px]" href="caminho/do/arquivo2.pdf" target="_blank">Arquivo 2</a></li>
            <li><a class="btn btn-outline-dark mb-[5px]" href="caminho/do/arquivo3.pdf" target="_blank">Arquivo 3</a></li>
        </ul>
    </div>
</section>