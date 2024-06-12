<?php $this->layout('templates/main', ['title' => 'Home Page', 'user' => $user]) ?>


<section id="custo-da-obra" class="container my-5">
  <h2>Custo da Obra</h2>

  <form id="cost-form">
    <div class="mb-3">
      <label for="labor" class="form-label">Mão de obra</label>
      <input type="text" class="form-control" id="labor" name="labor" placeholder="100">
    </div>

    <div class="mb-3">
      <label for="equip" class="form-label">Equipamentos</label>
      <input type="text" class="form-control" id="equip" name="equip" placeholder="100">
    </div>

    <div class="mb-3">
      <label for="third" class="form-label">Terceiros</label>
      <input type="text" class="form-control" id="third" name="third" placeholder="100">
    </div>

    <div class="mb-3">
      <label for="adm" class="form-label">Taxa ADM:</label>
      <input type="text" class="form-control" id="adm" name="adm" placeholder="100">
    </div>

    <div class="mb-3">
      <label for="pdf" class="form-label">Relatório:</label>
      <input type="file" class="form-control" id="pdf" name="pdf" placeholder="100">
    </div>
    <button type="submit" class="mb-[20px]">Enviar</button>

    <div id="arquivos-disponiveis">
      <h3 class="mb-[20px]"><b>Relatórios Disponíveis</b></h3>
      <ul class="h-[300px] overflow-y-auto">
        <?php foreach ($documents as $document) : ?>
          <div class="mb-3">
            <li>
              <a class="btn btn-outline-dark mb-[5px]" target="_blank" href="/pdf/Cost/<?= $document->name ?>" target="_blank"> <?= $document->name ?> </a>
            </li>
          </div>
        <?php endforeach ?>
      </ul>
    </div>
  </form>

  <div id="relatorios-anteriores">
    <h3 class="mb-[20px]"><b>Relatórios Atual</b></h3>

    <div class="relatorio">
      <p>Data: <?= $last_cost['date'] ?></p>
      <p>Mão de Obra: <?= $last_cost['labor'] ?></p>
      <p>Equipamentos: <?= $last_cost['equip'] ?></p>
      <p>Terceiros: R$ <?= $last_cost['third'] ?></p>
      <p>Taxa ADM: R$ <?= $last_cost['adm'] ?></p>
      <a href="caminho/do/arquivo1.pdf" target="_blank">Ver Relatório</a>
    </div>
  </div>

  <div id="total-custos" class="relatorio">
    <h3 class="mb-[20px]"><b>Total dos Custos da Obra</b></h3>
    <p>Mão de Obra: <?= $total['labor'] ?></p>
    <p>Equipamentos: <?= $total['equip'] ?></p>
    <p>Terceiros: R$ <?= $total['third'] ?></p>
    <p>Taxa ADM: R$ <?= $total['adm'] ?></p>
    <p>Total custo obra: R$ <?= $total['total'] ?></p>
  </div>

</section>

<?php $this->push('scripts') ?>
<script src="/public/scripts/Cost.js"></script>
<?php $this->end() ?>