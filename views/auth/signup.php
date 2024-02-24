<?php
use App\Config;

$pdo = Config::getPDO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, password_hash) VALUES (:username, :password)");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "Utilisateur enregistré avec succès.";
            header("Location:" . $router->generate('login'));
        } else {
            echo "Erreur lors de l'enregistrement de l'utilisateur.";
        }
    } catch (PDOException $e) {
        echo "Erreur PDO : " . $e->getMessage();
    }
}
?>

<div class="container">
    <form action="" method="post">
        <div class="form-group">
            <label for="username">Nom d'utilisateur : </label>
            <input type="text" class="form-control" id="username" name="username" required><br>
            <label for="password">Mot de passe : </label>
            <input type="password" class="form-control" id="password" name="password" required><br>
            <input type="submit" value="S'inscrire" class="btn btn-primary">
        </div>
    </form>
</div>

