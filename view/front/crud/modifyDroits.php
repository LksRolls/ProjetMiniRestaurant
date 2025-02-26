<?php
require_once '../../../model/Bdd.php';

// Verif si ID dans url
if (!isset($_GET['Id'])) {
    header("Location: ../../index.php");
    exit();
}

$Id = intval($_GET['Id']); // secur l'ID
$db = Database::getConnection();

// Recup info pour remplir
$query = "SELECT * FROM droits WHERE id_droits = :id";
$stmt = $db->prepare($query);
$stmt->execute([':id' => $Id]);
$droits = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un droit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/styles/style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h3 class="text-center mb-4">Modifier un droit</h3>
            <form action="../../../controllers/controllerModify.php?action=Modify&table=droits" method="POST">
                <div class="mb-3">
                    <label for="libelle_droits" class="form-label fw-bold">Nom du Droit :</label>
                    <input type="text" id="libelle_droits" name="libelle_droits" value="<?= htmlspecialchars($droits['libelle_droits']) ?>" class="form-control" required>
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