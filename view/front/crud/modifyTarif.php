<?php
require_once '../../../model/Bdd.php';

// Verif si ID dans url
if (!isset($_GET['id_prestation']) || !isset($_GET['id_categorie'])) {
    header("Location: ../../index.php?error=missing_id");
    exit();
}

$id_prestation = intval($_GET['id_prestation']); // secur l'id
$id_categorie = intval($_GET['id_categorie']);   // secur l'id

$db = Database::getConnection();

// Recup info pour remplir 
$query = "SELECT * FROM tarif WHERE id_prestation = :id_prestation AND id_categorie = :id_categorie";
$stmt = $db->prepare($query);
$stmt->execute([
    ':id_prestation' => $id_prestation,
    ':id_categorie' => $id_categorie
]);

$tarif = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$tarif) {
    header("Location: ../../index.php?error=not_found");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Tarif</title>
</head>
<body>
    <form action="../../../controllers/controllerModify.php?action=Modify&table=tarif" method="POST">
        <h3>Modifier un Tarif</h3>

            <label for="id_prestation">ID Prestation :</label>
            <input type="number" id="id_prestation" name="id_prestation" value="<?= htmlspecialchars($id_prestation) ?>" readonly>

            <label for="id_categorie">ID Catégorie :</label>
            <input type="number" id="id_categorie" name="id_categorie" value="<?= htmlspecialchars($id_categorie) ?>" readonly>

        <label for="prix">Prix :</label>
        <input type="text" id="prix" name="prix" value="<?= htmlspecialchars($tarif['prix']) ?>" required>

        <button type="submit">Modifier</button>
    </form>
</body>
</html>
