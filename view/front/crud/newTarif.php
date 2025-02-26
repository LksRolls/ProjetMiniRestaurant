<?php
require_once '../../../model/Bdd.php';

// Connexion bdd
$db = Database::getConnection();

// recup les prestations qui existe
$queryPrestations = "SELECT id_prestation, type_prestation FROM prestation";
$stmtPrestations = $db->query($queryPrestations);
$prestations = $stmtPrestations->fetchAll(PDO::FETCH_ASSOC);

// Recup les categories qui existe
$queryCategories = "SELECT id_categorie, libelle_categorie FROM categorie";
$stmtCategories = $db->query($queryCategories);
$categories = $stmtCategories->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Tarif</title>
</head>
<body>
    <form action="../../../controllers/controllerCreated.php?action=Created&table=tarif" method="POST">
        <h3>Ajouter un Tarif</h3>

        <label for="id_prestation">Prestation :</label>
        <select id="id_prestation" name="id_prestation" required>
            <option value="">-- Sélectionner une prestation --</option>
            <?php foreach ($prestations as $prestation) : ?>
                <option value="<?= htmlspecialchars($prestation['id_prestation']) ?>">
                    <?= htmlspecialchars($prestation['id_prestation'] . ' - ' . $prestation['type_prestation']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="id_categorie">Catégorie :</label>
        <select id="id_categorie" name="id_categorie" required>
            <option value="">-- Sélectionner une catégorie --</option>
            <?php foreach ($categories as $categorie) : ?>
                <option value="<?= htmlspecialchars($categorie['id_categorie']) ?>">
                    <?= htmlspecialchars($categorie['id_categorie'] . ' - ' . $categorie['libelle_categorie']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="prix">Prix :</label>
        <input type="text" id="prix" name="prix" required>

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
