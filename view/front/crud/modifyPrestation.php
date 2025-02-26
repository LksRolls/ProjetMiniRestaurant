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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/styles/style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h3 class="text-center mb-4">Modifier une Prestation</h3>

            <form action="../../../controllers/controllerModify.php?action=Modify&table=prestation" method="POST">
                <div class="mb-3">
                    <label for="type_prestation" class="form-label fw-bold">Type de Prestation :</label>
                    <input type="text" id="type_prestation" name="type_prestation" value="<?= htmlspecialchars($prestation['type_prestation']) ?>" class="form-control" required>
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
