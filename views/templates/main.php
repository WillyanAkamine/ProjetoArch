<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->e($title) ?></title>
    <link rel="stylesheet" href="/public/css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="/public/scripts/axios.min.js"></script>
</head>

<body>
    <header>
        <nav class="nav">
            <a class="nav-link text-white" href="/">Home</a>
            <a class="nav-link text-white" href="/obras">Obras</a>
            <a class="nav-link text-white" href="/orcamentos">Orçamentos</a>
            <a class="nav-link text-white" href="/notas">Notas a Pagar</a>
            <a class="nav-link text-white" href="/custos">Custos de Obra</a>

            <?php if (empty($user)) : ?>
                <a class="nav-link text-white" href="/login">Login</a>
            <?php else : ?>
                <a class="nav-link text-white" href="/logout">Logout</a>
            <?php endif ?>
            
        <!-- <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul> -->
        </nav>
    </header>

    <?= $this->section('content') ?>

    <footer>

    </footer>

    <script src="/public/scripts/tailwind.js"></script>
    <script src="/public/scripts/tailwind-config.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <?= $this->section('scripts') ?>
    <script src="/public/scripts/app.js"></script>
</body>

</html>