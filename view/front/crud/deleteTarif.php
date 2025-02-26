<?php
// Verif si id est rempli
if (!isset($_GET['id_prestation']) || !isset($_GET['id_categorie'])) {
    header("Location: ../index.php?error=missing_params");
    exit();
}

// Recup id et sucur
$id_prestation = intval($_GET['id_prestation']);
$id_categorie = intval($_GET['id_categorie']);

// Connexion bdd
require_once '../../../model/Bdd.php';
$db = Database::getConnection();

// prepare requete
$query = "DELETE FROM tarif WHERE id_prestation = :id_prestation AND id_categorie = :id_categorie";
$stmt = $db->prepare($query);

try {
    $stmt->execute([
        ':id_prestation' => $id_prestation,
        ':id_categorie' => $id_categorie
    ]);
    header("Location: ../../../index.php?success=deleted");
    exit();
} catch (PDOException $e) {
    header("Location: ../../../index.php?error=sql_error");
    exit();
}
?>
