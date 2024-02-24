<?php
// Page d'inscription des utilisateurs
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $password_hached = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password_hash) VALUES ('$username', '$password_hached')";

    if ($conn->query($sql) === TRUE) {
        echo "Utilisateur enregistré avec succès.";
        header("Location: connexion.php");
    } else {
        echo "Erreur lors de l'enregistrement de l'utilisateur : " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'inscription</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/monstyle.css">
</head>

<body>
    <div class="container">
        <!-- Formulaire d'inscription -->
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
</body>

</html>