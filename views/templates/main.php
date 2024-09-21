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
    <header class="p-0 flex bg-[#343A40]">
        <nav class="nav w-100 bg-[#343A40]">
            <a class="nav-link text-white" href="/">Home</a>
            <a class="nav-link text-white" href="/obras">Obras</a>
            <a class="nav-link text-white" href="/orcamentos">Orçamentos</a>
            <a class="nav-link text-white" href="/notas">Notas a Pagar</a>
            <a class="nav-link text-white" href="/custos">Custos de Obra</a>
            
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

        <div class="flex w-100 justify-end mr-[43px] items-center">
            <?php if (empty($user)) : ?>
                <a class="nav-link text-white" href="/login">Login</a>
            <?php else : ?>
                <div class="dropdown">
                    <button class="btn bg-none" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="flex flex-row items-center gap-2">
                            <img src="/public/icons/user.svg" alt="User Logo">
                            <p class="text-white"><?= $user['name'] ?></p>
                        </div>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="/logout">Logout</a></li>
                    </ul>
                </div>
            <?php endif ?>
        </div>
    </header>

    <?= $this->section('content') ?>

    <!-- <footer>

    </footer> -->

    <script src="/public/scripts/tailwind.js"></script>
    <script src="/public/scripts/tailwind-config.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <?= $this->section('scripts') ?>
    <script src="/public/scripts/app.js"></script>
</body>

</html>