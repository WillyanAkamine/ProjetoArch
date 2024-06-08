   <?php $this->layout('templates/main', ['title' => 'Home Page', 'user' => $user]) ?>

   <header>
       <!-- Seu cabeçalho aqui -->
   </header>

   <section id="notas-pagar" class="container my-5">
       <h2 class="py-4 font-bold">Notas a Pagar</h2>

       <!-- Formulário para adicionar nova nota a pagar -->
       <form id="adicionar-nota-form" action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
           <div class="mb-3">
               <label for="descricao" class="form-label">Descrição:</label>
               <input type="text" class="form-control" id="descricao" name="descricao" required>
               <div class="invalid-feedback">
                   Por favor, preencha a descrição.
               </div>
           </div>

           <div class="mb-3">
               <label for="pdf" class="form-label">PDF da nota:</label>
               <input type="file" class="form-control" id="pdf" name="pdf" accept=".pdf" required>
               <div class="invalid-feedback">
                   Por favor, envie um arquivo PDF.
               </div>
           </div>

           <div id="arquivos-disponiveis">
               <h3 class="mb-[20px]">Relatórios Disponíveis</h3>
               <ul class="h-[300px] overflow-y-auto">
                   <li><a class="btn btn-outline-dark mb-[5px]" href="caminho/do/arquivo1.pdf" target="_blank">Arquivo 1</a></li>
                   <li><a class="btn btn-outline-dark mb-[5px]" href="caminho/do/arquivo2.pdf" target="_blank">Arquivo 2</a></li>
                   <li><a class="btn btn-outline-dark mb-[5px]" href="caminho/do/arquivo3.pdf" target="_blank">Arquivo 3</a></li>
               </ul>
           </div>

           <div class="mb-3">
               <button type="submit" class="btn btn-primary">Adicionar Nota</button>
           </div>
       </form>
   </section>