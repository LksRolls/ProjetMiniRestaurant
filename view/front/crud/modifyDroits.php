<?php
require_once '../../../model/Bdd.php';

// Verif si ID dans url
if (!isset($_GET['Id'])) {
    header("Location: ../../index.php?error=missing_id");
    exit();
}

$Id = intval($_GET['Id']); // secur l'id
$db = Database::getConnection();

// Recup info pour remplir 
$query = "SELECT * FROM droits WHERE id_droits = :id";
$stmt = $db->prepare($query);
$stmt->execute([':id' => $Id]);
$categorie = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un droit</title>
</head>
<body>
    <form action="../../../controllers/controllerModify.php?action=Modify&table=categorie" method="POST">
        <h3>Modifier un droit</h3>

        <label for="id">ID Droits :</label>
        <input type="number" id="id" name="id" value="<?= htmlspecialchars($Id) ?>" readonly>

        <label for="libelle_droits">Nom de la Catégorie :</label>
        <input type="text" id="libelle_droits" name="libelle_droits" value="<?= htmlspecialchars($categorie['libelle_droits']) ?>" required>

        <button type="submit">Modifier</button>
    </form>
</body>
</html>
