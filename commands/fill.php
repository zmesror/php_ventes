<?php

require_once 'vendor/autoload.php';

$faker = Faker\Factory::create();
$pdo = new PDO('mysql:host=127.0.0.1;dbname=ensaf_ventes', 'root', '');

$pdo->exec('TRUNCATE TABLE vetements');

$numberOfFixtures = 50;

for ($i = 0; $i < $numberOfFixtures; $i++) {
    $nom = $faker->word;
    $description = $faker->realText(50);
    $prix = $faker->randomFloat(2, 10, 1000);

    $picsumId = $faker->numberBetween(1, 1000);
    $imageUrl = "https://picsum.photos/400/300?id=$picsumId";

    $imageData = file_get_contents($imageUrl);

    $stmt = $pdo->prepare('INSERT INTO vetements (nom, description, prix, image_data) VALUES (?, ?, ?, ?)');
    $stmt->bindParam(1, $nom);
    $stmt->bindParam(2, $description);
    $stmt->bindParam(3, $prix);
    $stmt->bindParam(4, $imageData, PDO::PARAM_LOB);

    $stmt->execute();
}

echo "Fixtures generated successfully.";

?>
