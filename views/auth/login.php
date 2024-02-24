<?php
use App\Model\Item;
use App\Config;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    if ($_SESSION['role'] == 'admin') {
        header('Location: ' . $router->generate('admin'));
        exit;
    } else {
        header('Location: ' . $router->generate('home'));
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $pdo = Config::getPDO();
    $stmt = $pdo->prepare('SELECT id, username, password_hash, role FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['loggedin'] = true;

        if ($_SESSION['role'] == 'admin') {
            header('Location: ' . $router->generate('admin'));
            exit;
        } else {
            header('Location: ' . $router->generate('home'));
            exit;
        }
    } else {
        $error = "Identifiants incorrects";
    }

    setcookie('remember_user', $username, time() + 3600, '/');
}
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Connexion</h2>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Nom d'utilisateur</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Se connecter</button>
                    </form>
                    <p class="mt-3 text-center">Vous n'avez pas de compte ? <a href="<?= $router->generate('signup') ?>">Créer un compte</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
