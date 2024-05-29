<?php $this->layout('templates/main', ['title' => 'Home Page', 'user' => $user]) ?>

<section id="custo-da-obra">
  <h2>Custo da Obra</h2>

  <form id="cost-form">
    <label for="labor">Mão de Obra:</label>
    <input type="number" id="labor" name="labor" required>
    <label for="equip">Equipamentos:</label>
    <input type="number" id="equip" name="equip" required>
    <label for="third">Terceiros:</label>
    <input type="number" id="third" name="third" required>
    <label for="adm">Taxa ADM:</label>
    <input type="number" id="adm" name="adm" required>
    <label for="pdf">Relatório:</label>
    <input type="file" id="pdf" name="pdf" accept=".pdf">
    <button type="submit">Enviar</button>
  </form>

  <div id="relatorios-anteriores">
    <h3>Relatórios Atual</h3>

    <div class="relatorio">
      <p>Data: <?= $last_cost['date'] ?></p>
      <p>Mão de Obra: <?= $last_cost['labor'] ?></p>
      <p>Equipamentos: <?= $last_cost['equip'] ?></p>
      <p>Terceiros: R$ <?= $last_cost['third'] ?></p>
      <p>Taxa ADM: R$ <?= $last_cost['adm'] ?></p>
      <a href="caminho/do/arquivo1.pdf" target="_blank">Ver Relatório</a>
    </div>
    <div class="relatorio">
    </div>
  </div>
  <div id="total-custos">
    <h3>Total dos Custos da Obra</h3>
    <p>Mão de Obra: <?= $total['labor'] ?></p>
    <p>Equipamentos: <?= $total['equip'] ?></p>
    <p>Terceiros: R$ <?= $total['third'] ?></p>
    <p>Taxa ADM: R$ <?= $total['adm'] ?></p>
    <p>Total custo obra: R$ <?= $total['total'] ?></p>
  </div>


</section>
<button onclick="window.history.back()">Voltar</button>
