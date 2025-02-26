<?php
require_once '../model/Bdd.php';

session_start();

// Vérifier si l'action et la table sont bien envoyées
if (!isset($_GET['action']) || !isset($_GET['table'])) {
    RedirigeAvecErreur("Un parametre est manquant");
}

$action = $_GET['action'];
$table = $_GET['table'];
$db = Database::getConnection();

// Vérifier que l'action est bien "Created"
if ($action !== "Created") {
    RedirigeAvecErreur("Erreur de redirection");
}

// Verif si table valide    
$validTables = ["categorie", "droits", "prestation", "tarif", "users"];
if (!in_array($table, $validTables)) {
    RedirigeAvecErreur("La table n'existe pas");
}

// insere en fonction de la table
function insertEntry($db, $table) {
    switch ($table) {
        case "categorie":
            if (!isset($_POST['libelle_categorie'])) {
                RedirigeAvecErreur("Erreur lors de l'insertion ( Verifier que tous les champs soit remplit )");
            }
            $query = "INSERT INTO categorie (libelle_categorie) VALUES (:libelle)";
            $params = [":libelle" => $_POST['libelle_categorie']];
            break;

        case "droits":
            if (!isset($_POST['libelle_droits'])) {
                RedirigeAvecErreur("Erreur lors de l'insertion ( Verifier que tous les champs soit remplit )");
            }
            $query = "INSERT INTO droits (libelle_droits) VALUES (:libelle)";
            $params = [":libelle" => $_POST['libelle_droits']];
            break;

        case "prestation":
            if (!isset($_POST['type_prestation'])) {
                RedirigeAvecErreur("Erreur lors de l'insertion ( Verifier que tous les champs soit remplit )");
            }
            $query = "INSERT INTO prestation (type_prestation) VALUES (:type)";
            $params = [":type" => $_POST['type_prestation']];
            break;

        case "tarif":
            if (!isset($_POST['id_prestation'], $_POST['id_categorie'], $_POST['prix'])) {
                RedirigeAvecErreur("Erreur lors de l'insertion ( Verifier que tous les champs soit remplit )");
            }

            // Verif si existe
            $checkQuery = "SELECT COUNT(*) FROM tarif WHERE id_prestation = :id_prestation AND id_categorie = :id_categorie";
            $checkStmt = $db->prepare($checkQuery);
            $checkStmt->execute([
                ":id_prestation" => $_POST['id_prestation'],
                ":id_categorie" => $_POST['id_categorie']
            ]);
            $exists = $checkStmt->fetchColumn();

            if ($exists > 0) {
                RedirigeAvecErreur("Ce tarif existe deja, merci de le modifier ou de le supprimer");
            }

            // Insere si existe pas logique
            $query = "INSERT INTO tarif (id_prestation, id_categorie, prix) VALUES (:id_prestation, :id_categorie, :prix)";
            $params = [
                ":id_prestation" => $_POST['id_prestation'],
                ":id_categorie" => $_POST['id_categorie'],
                ":prix" => $_POST['prix']
            ];
            break;

        default:
            RedirigeAvecErreur("Table invalide.");
    }

    executeQuery($db, $query, $params);
}

// Execute
function executeQuery($db, $query, $params) {
    try {
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        header("Location: ../index.php");
        exit();
    } catch (PDOException $e) {
        RedirigeAvecErreur("Erreur lors de l'insertion en bdd");
    }
}

// pour rediriger avec le message d'erreur pour prevenir utilisateur
function RedirigeAvecErreur($message) {
    header("Location: ../view/front/home.php?error=" . $message);
    exit();
}

// execut
insertEntry($db, $table);
?>