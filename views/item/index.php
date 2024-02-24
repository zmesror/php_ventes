<?php
use App\Helpers\Text;
use App\Model\Item;
use App\Config;

require __DIR__ . '/../auth/auth.php';

$title = 'Home';

$pdo = Config::getPDO();

$page = $_GET['page'] ?? 1;

if(!filter_var($page, FILTER_VALIDATE_INT)) {
    throw new Exception('Numéro de page invalid');
}

if ($page === '1') {
    header('location: ' . $router->generate('home'));
    exit();
}

$currentPage = (int)($_GET['page'] ?? 1) ?: 1;
if ($currentPage <= 0) {
    throw new Exception('Numéro de page invalid');
}
$count = (int)$pdo->query('SELECT COUNT(id) FROM vetements')->fetch(PDO::FETCH_NUM)[0];
$perPage = 12;
$pages = ceil($count / $perPage);
if ($currentPage > $pages) {
    throw new Exception('Cette page n\'existe pas');
}
$offset = $perPage * ($currentPage - 1);
$sql = $pdo->query("SELECT * FROM vetements LIMIT $perPage OFFSET $offset");
$clothingList = $sql->fetchAll(PDO::FETCH_CLASS, Item::class);
$featuredProducts = $pdo->query('SELECT * FROM vetements ORDER BY RAND() LIMIT 3')->fetchAll(PDO::FETCH_CLASS, Item::class);

?>

<section class="py-5 text-center text-white bg-primary">
    <div class="container">
        <h2 class="display-4">Découvrez la mode qui vous inspire</h2>
        <p class="lead">Explorez notre collection exceptionnelle de vêtements et trouvez le style qui vous correspond. Chez ModaMix, la mode rencontre l'élégance.</p>
        <a href="<?= $router->generate('home') ?>" class="btn btn-light btn-lg">Commencez votre shopping</a>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Découvrez nos produits phares</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($featuredProducts as $featuredItem): ?>
                <div class="col">
                    <div class="card h-100">
                        <?php
                        $imageData = $featuredItem->getImageData();
                        $imageBase64 = 'data:image/jpeg;base64,' . base64_encode($imageData);
                        ?>
                        <img class="card-img-top" src="<?= $imageBase64 ?>" alt="<?= $featuredItem->getNom() ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlentities($featuredItem->getNom()) ?></h5>
                            <p class="card-text"><?= $featuredItem->getExcerpt() ?></p>
                            <a href="<?= $router->generate('item', ['id' => $featuredItem->getID(), 'name' => $featuredItem->getNom()]) ?>" class="btn btn-primary">Voir plus</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>

<div class="container py-5">
    <h1 class="my-4" id="collection">Nouvelle Collection</h1>
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        <?php foreach ($clothingList as $clothingItem): ?>
            <div class="col">
                <div class="card h-100">
                    <?php
                    $imageData = $clothingItem->getImageData();
                    $imageBase64 = 'data:image/jpeg;base64,' . base64_encode($imageData);
                    ?>
                    <img class="card-img-top" src="<?= $imageBase64 ?>" alt="<?= $clothingItem->getNom() ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlentities($clothingItem->getNom()) ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?= $clothingItem->getPrix() ?></h6>
                        <p class="card-text"><?= $clothingItem->getExcerpt() ?></p>
                        <a href="<?= $router->generate('item', ['id' => $clothingItem->getID(), 'name' => $clothingItem->getNom()])?>" class="btn btn-primary">Voir plus</a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>

<div class="d-flex justify-content-between my-4">
    <?php if ($currentPage > 1): ?>
        <?php
        $link = $router->generate('home');
        if ($currentPage > 2) $link .= '?page=' . $currentPage - 1;
        ?>
        <a href="<?= $link ?>#collection" class="btn btn-primary">&laquo; Page précédente</a>
    <?php endif ?>
    <?php if ($currentPage < $pages): ?>
        <a href="<?= $router->generate('home') ?>?page=<?= $currentPage + 1 ?>#collection" class="btn btn-primary ml-auto">&laquo; Page suivante &raquo;</a>
    <?php endif ?>
</div>