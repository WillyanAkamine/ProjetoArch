<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->e($title) ?></title>
    <link rel="stylesheet" href="public/css/style.css" />
    <script src="public/scripts/tailwind.js"></script>
    <script src="public/scripts/tailwind-config.js"></script>
    
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="/" class="text-blue">Home</a></li>
                <li><a href="obra">Obra</a></li>
                <li><a href="orcamento">Orçamento</a></li>
                <li><a href="notas">Notas a Pagar</a></li>
                <li><a href="custo">Custo de Obra</a></li>

                <?php if (empty($user)) : ?>

                    <li class="login">
                        <a href="login">Login</a>
                    </li>

                <?php else : ?>

                    <li class="logout"><a href="logout">Logout</a></li>

                <?php endif ?>
            </ul>
        </nav>
    </header>

    <?= $this->section('content') ?>

    <footer>

    </footer>
</body>
</html>