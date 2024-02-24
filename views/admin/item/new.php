<?php
use App\Model\Item;
use App\Config;

require_once(__DIR__ . '/../../auth/auth.php');

$pdo = Config::getPDO();

$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newItem = new Item();

    $newItem->setNom(isset($_POST['name']) ? $_POST['name'] : '');
    $newItem->setDescription(isset($_POST['description']) ? $_POST['description'] : '');
    $newItem->setPrix(isset($_POST['prix']) ? $_POST['prix'] : '');

    $imageData = null;

    if (isset($_FILES['image_data']) && $_FILES['image_data']['error'] == UPLOAD_ERR_OK) {
        $imageData = file_get_contents($_FILES['image_data']['tmp_name']);
    }

    $name = $newItem->getNom();
    $description = $newItem->getDescription();
    $prix = $newItem->getPrix();

    $sql = $pdo->prepare("INSERT INTO vetements (nom, description, prix, image_data) VALUES (?, ?, ?, ?)");
    $sql->bindParam(1, $name);
    $sql->bindParam(2, $description);
    $sql->bindParam(3, $prix);
    $sql->bindParam(4, $imageData, PDO::PARAM_LOB);

    $success = $sql->execute();

    if ($success) {
        header('Location:' . $router->generate('admin'));
        exit;
    }
}
?>

<?php if ($success): ?>
    <div class="alert alert-success">
        L'article a bien été ajouté
    </div>
<?php endif ?>

<h1>Ajouter un nouvel article</h1>

<form action="" method="POST" enctype="multipart/form-data" class="my-5">
    <div class="form-group">
        <label for="name">Titre</label>
        <input type="text" class="form-control" name="name" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description"></textarea>
    </div>
    <div class="form-group">
        <label for="prix">Prix</label>
        <input type="text" class="form-control" name="prix" required>
    </div>
    <div class="form-group">
        <label for="image_data">Image</label>
        <input type="file" class="form-control" name="image_data">
    </div>

    <button class="btn btn-primary">Ajouter</button>
</form>
