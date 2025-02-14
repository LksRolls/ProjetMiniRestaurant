<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="public/styles/style.css">
</head>
<body>
    <h2>Connexion</h2>
    <form method="POST" action="index.php?action=login">
        <label>Email :</label>
        <input type="email" name="mail" required>

        <label>Mot de passe :</label>
        <input type="password" name="password" required>

        <button type="submit">Se connecter</button>
    </form>
    <p>Vous n'avez pas de compte? <a href="View/Front/register.php">Inscrivez-vous</a></p>
</body>
</html>

<?php
session_start();
require_once 'Router/FrontRouter.php'; // inclure le routeur
$action = isset($_GET['action']) ? $_GET['action'] : '';

$controller = new AuthController();

if ($action === 'register') {
    $controller->register(); // inscription
} elseif ($action === 'login') {
    $controller->login(); // connexion
}
?>

