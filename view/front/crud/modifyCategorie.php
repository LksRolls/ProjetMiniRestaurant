<?php
require_once '../../../model/Bdd.php';

// Verif si ID dans url
if (!isset($_GET['Id'])) {
    header("Location: ../../index.php");
    exit();
}

$Id = intval($_GET['Id']); // sécurise l'ID
$db = Database::getConnection();

// Recup info pour remplir 
$query = "SELECT * FROM categorie WHERE id_categorie = :id";
$stmt = $db->prepare($query);
$stmt->execute([':id' => $Id]);
$categorie = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Catégorie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/styles/style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h3 class="text-center mb-4">Modifier une Catégorie</h3>

            <form action="../../../controllers/controllerModify.php?action=Modify&table=categorie" method="POST">
                <div class="mb-3">
                    <label for="id" class="form-label fw-bold">ID Catégorie :</label>
                    <input type="number" id="id" name="id" value="<?= htmlspecialchars($Id) ?>" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label for="libelle_categorie" class="form-label fw-bold">Nom de la Catégorie :</label>
                    <input type="text" id="libelle_categorie" name="libelle_categorie" value="<?= htmlspecialchars($categorie['libelle_categorie']) ?>" class="form-control" required>
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