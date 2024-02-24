<?php
use App\Model\Item;
use App\Config;

require_once(__DIR__ . '/../../auth/auth.php');

$title = 'Éditer un article';
$pdo = Config::getPDO();

$itemID = (int)$params['id'];

$sql = $pdo->prepare("SELECT * FROM vetements WHERE id = ?");
if ($sql->execute([$itemID])) {
    $items = $sql->fetchAll(PDO::FETCH_CLASS, Item::class);

    if ($items) {
        $item = $items[0];
    } else {
        header('Location: /admin');
        exit;
    }
} else {
    echo "Erreur lors de l'exécution de la requête.";
    exit;
}

$success = false;

if (!empty($_POST)) {
    $item->setNom(isset($_POST['name']) ? $_POST['name'] : '');
    
    if (isset($_POST['description'])) {
        $item->setDescription($_POST['description']);
    }
    

    $sql = $pdo->prepare("UPDATE vetements SET nom = :name, description = :description, prix = :prix, image_data = :image_data WHERE id = :id");

    $ok = false;

if (isset($_FILES['image_data']) && $_FILES['image_data']['error'] == UPLOAD_ERR_OK) {
    $image = file_get_contents($_FILES['image_data']['tmp_name']);
    $image = addslashes($image);

    $sql = $pdo->prepare("UPDATE vetements SET nom = :name, description = :description, prix = :prix, image_data = :image_data WHERE id = :id");

    $ok = $sql->execute([
        'id' => $params['id'],
        'name' => $item->getNom(),
        'description' => $item->getDescription(),
        'prix' => $item->getPrix(),
        'image_data' => $image
    ]);
} else {
    $sql = $pdo->prepare("UPDATE vetements SET nom = :name, description = :description, prix = :prix WHERE id = :id");

    $ok = $sql->execute([
        'id' => $params['id'],
        'name' => $item->getNom(),
        'description' => $item->getDescription(),
        'prix' => $item->getPrix()
    ]);
}

$success = $ok;
}


?>

<?php if ($success): ?>
    <div class="alert alert-success">
        L'article a bien été modifié
    </div>

<?php endif ?>

<h1>Éditer l'article <?= $item->getNom() ?></h1>

<form action="" method="POST" enctype="multipart/form-data" class="my-5">
    <div class="form-group">
        <label for="name">Titre</label>
        <input type="text" class="form-control" name="name" value="<?= $item->getNom() ?>">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description"><?= $item->getDescription() ?></textarea>
    </div>
    <div class="form-group">
        <label for="prix">Prix</label>
        <input type="text" class="form-control" name="prix" value="<?= $item->getPrix() ?>">
    </div>
    <div class="form-group">
        <label for="image_data">Image</label>
        <input type="file" class="form-control" name="image_data">
    </div>

    <button class="btn btn-primary">Modifier</button>
</form>