   <?php $this->layout('templates/main', ['title' => 'Home Page', 'user' => $user]) ?>


   <section>
       <div class="flex flex-col gap-3 w-50 bg-white shadow-lg rounded-lg overflow-hidden mx-auto p-4">
           <h2 class="py-4 font-bold">Detalhes da Obra</h2>

           <form id="notes-form" action="/obra/<?= $construction_id ?>/note" method="post" enctype="multipart/form-data">
               <div class="mb-3">
                   <label for="description" class="form-label">Descrição</label>
                   <textarea class="form-control" placeholder="Digite o comentário ou registro da obra" id="description" name="description"></textarea>
               </div>

               <div class="mb-3">
                   <label for="pdf" class="form-label">Documentos</label>
                   <input class="form-control form-control-lg" type="file" id="pdf" name="pdf[]" multiple accept="application/pdf"><br>
               </div>

               <button class="btn btn-primary" type="submit">Enviar</button>
           </form>

           <hr/>

           <div id="arquivos-disponiveis">
               <h3 class="mb-[20px]">Histórico de notas</h3>
               <?php if (!empty($notes)) : ?>
                   <?php foreach ($notes as $note) : ?>
                       <div class="mb-3 p-3 border rounded bg-gray-50">
                           <p class="mb-1"><strong><?= htmlspecialchars($note->description) ?></strong></p>
                           <p class="text-sm text-gray-600">Registrado em <?= htmlspecialchars($note->created_at) ?></p>
                           <?php if ($note->pdf) : ?>
                               <p class="mt-2">
                                   <a class="btn btn-outline-dark" target="_blank" href="/pdf/Notes/<?= $note->pdf->name ?>">Ver documento</a>
                               </p>
                           <?php endif ?>
                       </div>
                   <?php endforeach ?>
               <?php else : ?>
                   <p class="text-gray-500">Nenhuma nota registrada ainda.</p>
               <?php endif ?>
           </div>

           <hr/>

           <div id="documentos-disponiveis">
               <h3 class="mb-[20px]">Documentos</h3>
               <ul class="h-[300px] overflow-y-auto list-disc pl-5">
                   <?php foreach ($documents as $document) : ?>
                       <li class="mb-2">
                           <a class="btn btn-outline-dark" target="_blank" href="/pdf/Notes/<?= htmlspecialchars($document->name) ?>"><?= htmlspecialchars($document->name) ?></a>
                       </li>
                   <?php endforeach ?>
               </ul>
           </div>
       </div>
   </section>

   <?php $this->push('scripts') ?>
   <script src="/public/scripts/Notes.js"></script>
   <?php $this->end() ?>