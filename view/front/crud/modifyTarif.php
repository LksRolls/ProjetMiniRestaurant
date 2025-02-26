<?php
require_once '../../../model/Bdd.php';

// Verif si ID dans URL
if (!isset($_GET['id_prestation']) || !isset($_GET['id_categorie'])) {
    header("Location: ../../index.php");
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
    header("Location: ../../index.php");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Tarif</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/styles/style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h3 class="text-center mb-4">Modifier un Tarif</h3>

            <form action="../../../controllers/controllerModify.php?action=Modify&table=tarif" method="POST">
                <input type="hidden" name="id_prestation" value="<?= htmlspecialchars($id_prestation) ?>">
                <input type="hidden" name="id_categorie" value="<?= htmlspecialchars($id_categorie) ?>">

                <div class="mb-3">
                    <label for="prix" class="form-label fw-bold">Prix :</label>
                    <input type="text" id="prix" name="prix" value="<?= htmlspecialchars($tarif['prix']) ?>" class="form-control" required>
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-info">Modifier</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
