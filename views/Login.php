
<?php $this->layout('templates/main', ['title' => 'Login']) ?>

<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<section id="login" class="max-w-md mx-auto mt-12 p-6 border border-gray-300 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>

    <?php if (isset($_GET['erro']) && $_GET['erro'] == 'true'): ?>
        <div class="text-red-500 text-center mb-4">Usuário ou senha incorretos.</div>
    <?php endif; ?>

    <form method="POST" action="login">
        <label for="name" class="block mb-2 font-semibold">Nome:</label>
        <input type="text" id="name" name="name" class="w-full p-3 mb-4 border border-gray-300 rounded-lg" required>
        
        <label for="password" class="block mb-2 font-semibold">Senha:</label>
        <input type="password" id="password" name="password" class="w-full p-3 mb-4 border border-gray-300 rounded-lg" required>
        
        <button type="submit" class="w-full py-3 bg-green-500 text-white font-bold rounded-lg hover:bg-green-600">Entrar</button>
    </form>
</section>

