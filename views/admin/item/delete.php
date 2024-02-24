<?php
use App\Model\Item;
use App\Config;
use App\Auth;

require_once(__DIR__ . '/../../auth/auth.php');

$pdo = Config::getPDO();
$sql = $pdo->prepare("DELETE FROM vetements WHERE id = ?");
$ok = $sql->execute([$params['id']]);

if ($ok === false) {
    throw new \Exception("Impossible de supprimer $id");
}



header('Location: ' . $router->generate('admin') . '?delete=1');


?>

<h1>Suppression de <?= $params['id'] ?></h1>