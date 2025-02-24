<?php
$Id = isset($_GET['Id']) ? $_GET['Id'] : '';

// Verif si id est rempli
if (!isset($Id)) {
    header("Location: ../index.php?error=missing_params");
    exit();
}

// Connexion bdd
require_once '../../../model/Bdd.php';
$db = Database::getConnection();
// prepare requete
$query = "DELETE FROM `users` as us WHERE us.id_users= $Id ";
$stmt = $db->prepare($query);

try {
    $stmt->execute($id);
    header("Location: ../../../index.php");
    exit();
} catch (PDOException $e) {
    header("Location: ../../../index.php");
    exit();
}
?>
