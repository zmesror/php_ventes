<?php
use App\Config;
use App\Model\Item;

require __DIR__ . '/../auth/auth.php';

$id = (int)$params['id'];
$name = $params['name'];

$pdo = Config::getPDO();
$query = $pdo->prepare('SELECT * FROM vetements WHERE id = :id');
$query->execute(['id' => $id]);
$query->setFetchMode(PDO::FETCH_CLASS, Item::class);
$item = $query->fetch();

if ($item === false) {
    throw new Exception('Aucun article ne correspond à cet ID');
}

if ($item->getNom() !== $name) {
    $url = $router->generate('item', ['name' => $item->getNom(), 'id' => $id]);
    http_response_code(301);
    header('Location: ' . $url);
}
?>

<div class="container mt-5">
    <?php
    $imageData = $item->getImageData();
    $imageBase64 = 'data:image/jpeg;base64,' . base64_encode($imageData);
    ?>
    <div class="row">
        <div class="col-md-6">
            <img id="zoom-image" class="img-fluid" src="<?= $imageBase64 ?>" alt="Image de l'article">
        </div>
        <div class="col-md-6">
            <h2><?= htmlentities($item->getNom()) ?></h2>
            <h4 class="text-muted"><?= $item->getPrix() . ' DH' ?></h4>
            <p><?= $item->getDescription() ?></p>
            <button class="btn btn-primary">Ajouter au panier</button>
        </div>
    </div>
</div>


<!-- Include the medium-zoom script -->
<script src="https://unpkg.com/medium-zoom"></script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        mediumZoom('#zoom-image');
    });
</script>

