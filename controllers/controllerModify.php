<?php
require_once '../model/Bdd.php';

session_start();

// Vérifier que l'action et la table sont bien envoyées
if (!isset($_GET['action']) || !isset($_GET['table'])) {
    header("Location: ../index.php");
    exit();
}

$action = $_GET['action'];
$table = $_GET['table'];
$db = Database::getConnection();

// Vérifier que l'action est bien "Modify"
if ($action !== "Modify") {
    header("Location: ../index.php");
    exit();
}

// Vérifier que la table est valide
$validTables = ["categorie", "droits", "prestation", "tarif", "users"];
if (!in_array($table, $validTables)) {
    header("Location: ../index.php");
    exit();
}

// Modifier en fonction de la table
function updateEntry($db, $table) {
    if (!isset($_POST['id'])) { 
        header("Location: ../index.php");
        exit();
    }

    $Id = intval($_POST['id']); // Sécuriser l'ID

    switch ($table) {
        case "categorie":
            if (!isset($_POST['libelle_categorie'])) {
                header("Location: ../index.php");
                exit();
            }

            $query = "UPDATE categorie SET libelle_categorie = :libelle WHERE id_categorie = :id";
            $params = [":libelle" => $_POST['libelle_categorie'], ":id" => $Id];
            break;

        case "droits":
            if (!isset($_POST['libelle_droits'])) {
                header("Location: ../index.php");
                exit();
            }
            $query = "UPDATE droits SET libelle_droits = :libelle WHERE id_droits = :id";
            $params = [":libelle" => $_POST['libelle_droits'], ":id" => $Id];
            break;

        case "prestation":
            if (!isset($_POST['type_prestation'])) {
                header("Location: ../index.php");
                exit();
            }
            $query = "UPDATE prestation SET type_prestation = :type WHERE id_prestation = :id";
            $params = [":type" => $_POST['type_prestation'], ":id" => $Id];
            break;

        case "tarif":
            if (!isset($_POST['id_prestation'], $_POST['id_categorie'], $_POST['prix'])) {
                header("Location: ../index.php");
                exit();
            }
            
            $query = "UPDATE tarif SET prix = :prix WHERE id_prestation = :id_prestation AND id_categorie = :id_categorie";
            $params = [
                ":id_prestation" => intval($_POST['id_prestation']),
                ":id_categorie" => intval($_POST['id_categorie']),
                ":prix" => $_POST['prix']
            ];
            break;            

        case "users":
            if (!isset($_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['droits'])) {
                header("Location: ../index.php");
                exit();
            }

            $query = "UPDATE users SET nom = :nom, prenom = :prenom, mail = :mail, droits = :droits WHERE id_users = :id";
            $params = [
                ":nom" => $_POST['nom'],
                ":prenom" => $_POST['prenom'],
                ":mail" => $_POST['mail'],
                ":droits" => $_POST['droits'],
                ":id" => $Id
            ];
            break;

        default:
            header("Location: ../index.php");
            exit();
    }

    executeQuery($db, $query, $params);
}

// ✅ Exécuter la mise à jour
function executeQuery($db, $query, $params) {
    try {
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        header("Location: ../index.php");        
        exit();
    } catch (PDOException $e) {
        header("Location: ../index.php");
        exit();
    }
}

// ✅ Lancer la mise à jour
updateEntry($db, $table);
