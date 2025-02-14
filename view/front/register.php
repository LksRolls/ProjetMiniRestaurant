<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="public/styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<form action="../../index.php?action=register" method="POST" enctype="multipart/form-data">
    <h2>Inscription</h2>
    <!-- Photo de profil -->
    <label for="avatar">Photo de profil</label>
    <input type="file" id="avatar" name="avatar" accept="image/*">
    <!-- Nom -->
    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom" required>
    <!-- Prénom -->
    <label for="prenom">Prenom</label>
    <input type="text" id="prenom" name="prenom" required>
    <!-- Mail -->
    <label for="email">Email</label>
    <input type="email" id="mail" name="mail" required>
    <!-- Mdp -->
    <label for="password">Mot de passe</label>
    <input type="password" id="password" name="password" required>
    <!-- Droits -->
    <label for="droits">Droits</label>
    <select name="droits" id="droits">
        <option value="2">Utilisateur</option>
        <option value="1">Admin</option>
    </select>

    <button type="submit">S'inscrire</button>
</form>
    <p>Vous avez deja un compte? <a href="../../index.php">Connectez-vous</a></p>
</body>
</html>
