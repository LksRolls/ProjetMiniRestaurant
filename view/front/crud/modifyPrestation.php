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
$query = "SELECT * FROM prestation WHERE id_prestation = :id";
$stmt = $db->prepare($query);
$stmt->execute([':id' => $Id]);
$prestation = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Prestation</title>
</head>
<body>
    <form action="../../../controllers/controllerModify.php?action=Modify&table=prestation" method="POST">
        <h3>Modifier une Prestation</h3>

        <label for="id">ID Prestation :</label>
        <input type="number" id="id" name="id" value="<?= htmlspecialchars($Id) ?>" readonly>

        <label for="type_prestation">Type de Prestation :</label>
        <input type="text" id="type_prestation" name="type_prestation" value="<?= htmlspecialchars($prestation['type_prestation']) ?>" required>

        <button type="submit">Modifier</button>
    </form>
</body>
</html>
