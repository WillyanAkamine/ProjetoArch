<?php $this->layout('templates/main', ['title' => 'Página Inicial', 'user' => $user]) ?>

<section class="container my-5">
    <h2 class="py-4 font-bold">Solicitar Orçamento</h2>

    <form id="budget-form" action="" method="POST" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="name" class="form-label">Nome:</label>
            <input type="text" class="form-control" id="name" name="name" required>
            <div class="invalid-feedback">
                Por favor, preencha seu nome.
            </div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" required>
            <div class="invalid-feedback">
                Por favor, insira um e-mail válido.
            </div>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Telefone:</label>
            <input type="tel" class="form-control" id="phone" name="phone">
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Mensagem:</label>
            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            <div class="invalid-feedback">
                Por favor, insira sua mensagem.
            </div>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>
</section>