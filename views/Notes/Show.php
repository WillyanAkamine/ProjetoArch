   <?php $this->layout('templates/main', ['title' => 'Home Page', 'user' => $user]) ?>


   <section>
       <div class="flex row gap-3 w-50 bg-white shadow-lg rounded-lg overflow-hidden mx-auto">
           <h2 class="py-4 font-bold">Detalhes da Obra</h2>

           <form id="notes-form">
               <input class="form-control form-control-lg" hidden type="text" id="user_id" name="user_id" value="<?= $client_id ?>">

               <div class="mb-3">
                   <textarea class="form-control" placeholder="Leave a comment here" id="description" name="description"></textarea>
                   <label for="description">Descrição</label>
               </div>

               <div class="mb-3">
                   <label for="pdf" class="form-label">Documentos</label>
                   <input class="form-control form-control-lg" type="file" id="pdf" name="pdf" multiple><br>
               </div>

               <button class="btn btn-primary"  type="submit">Enviar</button>
           </form>

           <hr/>

           <div id="arquivos-disponiveis">
               <h3 class="mb-[20px]">Relatórios Disponíveis</h3>
               <ul class="h-[300px] overflow-y-auto">
                   <?php foreach ($documents as $document) : ?>
                       <div class="mb-3">
                           <li>
                               <a class="btn btn-outline-dark mb-[5px]" target="_blank" href="/pdf/Notes/<?= $document->name ?>" target="_blank"> <?= $document->name ?> </a>
                           </li>
                       </div>
                   <?php endforeach ?>
               </ul>
           </div>
       </div>
   </section>

   <?php $this->push('scripts') ?>
   <script src="/public/scripts/Notes.js"></script>
   <?php $this->end() ?>