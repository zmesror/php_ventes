<?php
use App\Model\Item;
use App\Config;

require_once(__DIR__ . '/../../auth/auth.php');

$title = 'Administration';
$pdo = Config::getPDO();
$sql = $pdo->query("SELECT * FROM vetements");
$items = $sql->fetchAll(PDO::FETCH_CLASS, Item::class);
?>

<?php if (isset($_GET['delete'])): ?>
<div class="alert alert-success">
    L'enregistrement a bien été supprimé
</div>
<?php endif ?>

<a href="<?= $router->generate('admin_item_new') ?>" class="btn btn-success">Nouvel Article</a>
<table class="table">
    <thead>
        <th>#</th>
        <th>Nom</th>
        <th>Actions</th>
    </thead>
    <tbody>
        <?php foreach($items as $item): ?>
        <tr>
            <td>#<?= $item->getID() ?></td>
            <td>
                <a href="<?= $router->generate('admin_item_update', ['id' => $item->getID()]) ?>">
                    <?= $item->getNom() ?>
                </a>
            </td>
            <td>
                <a href="<?= $router->generate('admin_item_update', ['id' => $item->getID()]) ?>" class="btn btn-primary">
                    Editer
                </a>
                <form action="<?= $router->generate('admin_item_delete', ['id' => $item->getID()]) ?>" method="POST"
                    style="display: inline;"
                    onclick="return confirm('Voulez-vous vraiment supprimer cet article ?')">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
