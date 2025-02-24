<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvel Utilisateur</title>
</head>
<body>
    <form action="../../index.php?action=register" method="POST" enctype="multipart/form-data">
        <h2>Inscription</h2>
        <label for="avatar">Photo de profil</label>
        <input type="file" id="avatar" name="avatar" accept="image/*">

        <label for="nom">Nom</label>
        <input type="text" id="nom" name="nom" required>

        <label for="prenom">Prenom</label>
        <input type="text" id="prenom" name="prenom" required>

        <label for="email">Email</label>
        <input type="email" id="mail" name="mail" required>

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>
        
        <label for="droits">Droits</label>
        <select name="droits" id="droits">
            <option value="2">Utilisateur</option>
            <option value="1">Admin</option>
        </select>

        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>