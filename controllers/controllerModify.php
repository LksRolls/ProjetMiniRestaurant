<?php
require_once '../model/Bdd.php';

// Vérifier si l'action et la table sont bien envoyées
if (!isset($_GET['action']) || !isset($_GET['table'])) {
    header("Location: ../index.php?error=missing_params");
    exit();
}

$action = $_GET['action'];
$table = $_GET['table'];
$db = Database::getConnection();

// Verif si bien modif
if ($action !== "Modify") {
    header("Location: ../index.php");
    exit();
}

// Verif si table OK
$validTables = ["categorie", "droits", "prestation", "tarif", "users"];
if (!in_array($table, $validTables)) {
    header("Location: ../index.php");
    exit();
}

// Redirige
updateEntry($db, $table);

// modifie en fonction de la table
function updateEntry($db, $table) {
    switch ($table) {
        case "categorie":
            $query = "UPDATE categorie SET libelle_categorie = :libelle WHERE id_categorie = :id";
            $params = [":libelle" => $_POST['libelle_categorie'], ":id" => $_POST['id']];
            break;

        case "droits":
            $query = "UPDATE droits SET libelle_droits = :libelle WHERE id_droits = :id";
            $params = [":libelle" => $_POST['libelle_droits'], ":id" => $_POST['id']];
            break;

        case "prestation":
            $query = "UPDATE prestation SET type_prestation = :type WHERE id_prestation = :id";
            $params = [":type" => $_POST['type_prestation'], ":id" => $_POST['id']];
            break;

        case "tarif":
            $query = "UPDATE tarif SET prix = :prix WHERE id_prestation = :id_prestation AND id_categorie = :id_categorie";
            $params = [
                ":id_prestation" => $_POST['id_prestation'],
                ":id_categorie" => $_POST['id_categorie'],
                ":prix" => $_POST['prix']
            ];
            break;
    }

    executeQuery($db, $query, $params, "updated");
}

// execute 
    try {
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        header("Location: ../index.php?success=$successMessage");
        exit();
    } catch (PDOException $e) {
        header("Location: ../index.php?error=db_error");
        exit();
    }
?>
