<?php

use App\Enums\CategoryEnum;

require_once 'vendor/autoload.php';

$faker = Faker\Factory::create();

$DB_HOST = 'host.docker.internal';
$DB_USER = 'admin';
$DB_PASS = 'admin';
$DB_NAME = 'admin';
$DB_PORT = '3306';

try {
    $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

try {
    $stmt = $pdo->prepare("INSERT INTO roles (label) VALUES (?)");
    $roles = [
        'admin' => [
            'label' => 'admin'
        ],
        'user' => [
            'label' => 'user'
        ],
    ];
    foreach ($roles as $role) {

        $stmt->execute([$role['label']]);
        echo "Inserted role: ".$role['label']. "\n"; // Optional progress output
    }

    echo "Users inserted successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

//USERS
try {
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role_id) VALUES (?, ?, ?, ?)");
    $users =[
        [
            'name' => 'Will',
            'email' => 'willyan@gamil.com',
            'password' => '1234',
            'role_id' => 2
        ],
        [
            'name' => 'admin',
            'email' => 'admin',
            'password' => 'admin',
            'role_id' => 1
        ],
        [
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => $faker->password,
            'role_id' => 2
        ]
        ];

    foreach ($users as $user) {
        $stmt->execute([$user['name'], $user['email'], $user['password'], $user['role_id']]);
        echo "Inserted user: ".$user['name']. "\n"; // Optional progress output
    }

    echo "Users inserted successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


//MATERIALS
try {
    $stmt = $pdo->prepare("INSERT INTO materials (name, description, price, category) VALUES (?, ?, ?, ?)");
$materials = [
    [
        'name' => 'Tijolo',
        'description' => 'un',
        'price' => '1.50',
        'category' => CategoryEnum::Alvenaria->value
    ],
    [
        'name' => 'Bloco de Concreto',
        'description' => 'un',
        'price' => '3.00',
        'category' => CategoryEnum::Alvenaria->value
    ],
    [
        'name' => 'Vergalhão 8mm',
        'description' => 'barra',
        'price' => '35.00',
        'category' => CategoryEnum::Fundacao->value
    ],
    [
        'name' => 'Cal Hidratada',
        'description' => 'saco 20kg',
        'price' => '20.00',
        'category' => CategoryEnum::Alvenaria->value
    ],
    [
        'name' => 'Tubulação PVC 100mm',
        'description' => 'm',
        'price' => '25.00',
        'category' => CategoryEnum::Hidraulica->value
    ],
    [
        'name' => 'Fio Elétrico 2,5mm',
        'description' => 'rolo 100m',
        'price' => '250.00',
        'category' => CategoryEnum::Eletrica->value
    ],
    [
        'name' => 'Caixa de Passagem 4x4',
        'description' => 'un',
        'price' => '5.00',
        'category' => CategoryEnum::Eletrica->value
    ],
    [
        'name' => 'Telha de Cerâmica',
        'description' => 'un',
        'price' => '3.50',
        'category' => CategoryEnum::Cobertura->value
    ],
    [
        'name' => 'Argamassa ACIII',
        'description' => 'saco 20kg',
        'price' => '28.00',
        'category' => CategoryEnum::Alvenaria->value
    ],
];

    foreach ($materials as $material) {
        $stmt->execute([$material['name'], $material['description'], $material['price'], $material['category']]);
        echo "Inserted material: ".$material['name']. "\n"; // Optional progress output
    }

    echo "Users inserted successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

//OBRAS
try {
    $stmt = $pdo->prepare("
        INSERT INTO constructions (title, description, progress, address, zipcode, neighborhood, city, state, user_id)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $constructions = [
        [
            'title'        => 'Residência Will',
            'description'  => 'Construção de residência unifamiliar',
            'progress'     => '0%',
            'address'      => 'Rua das Flores, 123',
            'zipcode'      => '86010-100',
            'neighborhood' => 'Centro',
            'city'         => 'Londrina',
            'state'        => 'PR',
            'user_id'      => 1
        ],
        [
            'title'        => 'Obra Admin',
            'description'  => 'Construção de edifício comercial',
            'progress'     => '50%',
            'address'      => 'Av. Paulista, 1000',
            'zipcode'      => '01310-100',
            'neighborhood' => 'Bela Vista',
            'city'         => 'São Paulo',
            'state'        => 'SP',
            'user_id'      => 2
        ],
        [
            'title'        => 'Galpão Industrial',
            'description'  => 'Construção de galpão para armazenagem',
            'progress'     => '25%',
            'address'      => 'Rua Industrial, 500',
            'zipcode'      => '86070-200',
            'neighborhood' => 'Distrito Industrial',
            'city'         => 'Londrina',
            'state'        => 'PR',
            'user_id'      => 3
        ],
    ];

    foreach ($constructions as $construction) {
        $stmt->execute([
            $construction['title'],
            $construction['description'],
            $construction['progress'],
            $construction['address'],
            $construction['zipcode'],
            $construction['neighborhood'],
            $construction['city'],
            $construction['state'],
            $construction['user_id'],
        ]);
        echo "Inserted construction: " . $construction['title'] . "\n";
    }

    echo "Constructions inserted successfully!\n";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}