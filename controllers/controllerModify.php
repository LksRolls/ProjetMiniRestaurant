<?php
require_once '../model/Bdd.php';

session_start();

// verif si les id sont bien rempli
if (!isset($_GET['action']) || !isset($_GET['table'])) {
    RedirigeAvecErreur("Il manque un paramètre");
}

$action = $_GET['action'];
$table = $_GET['table'];
$db = Database::getConnection();

// verif si bien modifier
if ($action !== "Modify") {
    RedirigeAvecErreur("Erreur de redirection");
}

// verif table existe bien
$validTables = ["categorie", "droits", "prestation", "tarif", "users"];
if (!in_array($table, $validTables)) {
    RedirigeAvecErreur("La table n'existe pas");
}

// requete en fonction de la table
function updateEntry($db, $table) {
    switch ($table) {
        case "categorie":
            if (!isset($_POST['id'], $_POST['libelle_categorie'])) {
                RedirigeAvecErreur("Erreur lors de la modification de categorie");
            }
            $query = "UPDATE categorie SET libelle_categorie = :libelle WHERE id_categorie = :id";
            $params = [":libelle" => $_POST['libelle_categorie'], ":id" => intval($_POST['id'])];
            break;

        case "droits":
            if (!isset($_POST['id'], $_POST['libelle_droits'])) {
                RedirigeAvecErreur("Erreur lors de la modification du droit");
            }
            $query = "UPDATE droits SET libelle_droits = :libelle WHERE id_droits = :id";
            $params = [":libelle" => $_POST['libelle_droits'], ":id" => intval($_POST['id'])];
            break;

        case "prestation":
            if (!isset($_POST['id'], $_POST['type_prestation'])) {
                RedirigeAvecErreur("Erreur lors de la modification de la prestation");
            }
            $query = "UPDATE prestation SET type_prestation = :type WHERE id_prestation = :id";
            $params = [":type" => $_POST['type_prestation'], ":id" => intval($_POST['id'])];
            break;

        case "tarif":
            if (!isset($_POST['id_prestation'], $_POST['id_categorie'], $_POST['prix'])) {
                RedirigeAvecErreur("Erreur lors de la modification du tarif");
            }
            $query = "UPDATE tarif SET prix = :prix WHERE id_prestation = :id_prestation AND id_categorie = :id_categorie";
            $params = [
                ":id_prestation" => intval($_POST['id_prestation']),
                ":id_categorie" => intval($_POST['id_categorie']),
                ":prix" => $_POST['prix']
            ];
            break;

        case "users":
            if (!isset($_POST['id'], $_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['droits'])) {
                RedirigeAvecErreur("Erreur lors de la modification de l'user");
            }
            $query = "UPDATE users SET nom = :nom, prenom = :prenom, mail = :mail, droits = :droits WHERE id_users = :id";
            $params = [
                ":nom" => $_POST['nom'],
                ":prenom" => $_POST['prenom'],
                ":mail" => $_POST['mail'],
                ":droits" => intval($_POST['droits']),
                ":id" => intval($_POST['id'])
            ];
            break;

        default:
            RedirigeAvecErreur("Table inconnue");
    }

    executeQuery($db, $query, $params);
}

// exec requet
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

// maj 
updateEntry($db, $table);
