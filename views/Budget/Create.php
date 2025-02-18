<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Criar Orçamento</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="/public/scripts/Budget.js"></script>
</head>
<body>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Criar Orçamento</h1>
        <form id="budget-form" class="bg-white p-6 rounded-lg shadow-lg" method="post" enctype="multipart/form-data">
            <div id="cliente" class="mb-4">
                <h2 class="text-xl font-semibold">Dados do Cliente</h2>
                <p>Nome: <?= $_SESSION['user']['name'] ?></p>
                <p>Endereço: <?= $_SESSION['user']['address'] ?></p>
                <!-- Adicione mais informações conforme necessário -->
            </div>
            <div id="orcamento">
                <h2 class="text-xl font-semibold mb-2">Etapas da Obra</h2>
                <div id="categorias">
                    <?php foreach ($materials as $material): ?>
                        <div class="mb-4">
                            <h3 class="text-lg font-medium"><?= $material['category'] ?></h3>
                            <ul>
                                <li class="flex items-center mb-2">
                                    <?= $material['name'] ?>
                                    <input 
                                        type="number" 
                                        name="materials[<?= $material['id'] ?>][quantity]" 
                                        min="0" 
                                        class="ml-2 p-2 border rounded" 
                                        placeholder="Quantidade">
                                    <input 
                                        type="hidden" 
                                        name="materials[<?= $material['id'] ?>][step]" 
                                        value="<?= $material['category'] ?>">
                                </li>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Gerar Orçamento</button>
        </form>
    </div>
</body>
</html>
