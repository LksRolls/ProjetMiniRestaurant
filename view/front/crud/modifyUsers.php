<?php
require_once '../../../model/Bdd.php';

// Verif si ID dans URL
if (!isset($_GET['Id'])) {
    header("Location: ../../index.php?error=missing_id");
    exit();
}

$Id = intval($_GET['Id']); // Sécurise l'ID
$db = Database::getConnection();

// Recup info pour remplir 
$query = "SELECT * FROM users WHERE id_users = :id";
$stmt = $db->prepare($query);
$stmt->execute([':id' => $Id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Utilisateur</title>
</head>
<body>
    <form action="../../../controllers/controllerModify.php?action=Modify&table=users" method="POST">
        <h3>Modifier un Utilisateur</h3>

        <label for="id">ID Utilisateur :</label>
        <input type="number" id="id" name="id" value="<?= htmlspecialchars($Id) ?>" readonly>

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($user['prenom']) ?>" required>

        <label for="mail">Email :</label>
        <input type="email" id="mail" name="mail" value="<?= htmlspecialchars($user['mail']) ?>" required>
        
        <label for="avatar">Photo de profil</label>
        <input type="file" id="avatar" name="avatar" accept="image/*">
        
        <label for="droits">Droits :</label>
        <select id="droits" name="droits">
            <option value="1" <?= ($user['droits'] == 1) ? 'selected' : '' ?>>Admin</option>
            <option value="2" <?= ($user['droits'] == 2) ? 'selected' : '' ?>>Utilisateur</option>
        </select>

        <button type="submit">Modifier</button>
    </form>
</body>
</html>
