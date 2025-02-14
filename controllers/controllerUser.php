<?php
require_once 'model/users.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

$controller = new AuthController();

if ($action === 'register') {
    $controller->register();
} elseif ($action === 'login') {
    $controller->login();
}

class AuthController {
    // montre le form 
    public function showLoginForm() {
        require 'View/Front/login.php';
    }

    // fonction inscription
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['password'], $_POST['droits'], $_FILES['avatar'])) {
                // Recup les données
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $email = $_POST['mail'];
                $password = $_POST['password'];
                $droits = $_POST['droits'];
                
                // Traite de l'avatar
                $avatar = $_FILES['avatar'];
    
                // Vérifier si un fichier a été téléchargé
                if ($avatar['error'] == 0) {
                    // on verif le type de fichier
                    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    if (in_array($avatar['type'], $allowedTypes)) {
                        // Définir le nom du fichier de l'image
                        $imageNom = uniqid() . "_" . basename($avatar['name']); // Utilisation de uniqid() pour éviter les conflits
                        $uploadDir = 'Upload/'; // fichier de stockage
                        $uploadFilePath = $uploadDir . $imageNom;   
    
                        // Déplacer l'image téléchargée vers le répertoire uploads/
                        if (move_uploaded_file($avatar['tmp_name'], $uploadFilePath)) {
                            // download okk
                            $imagePath = $uploadFilePath; // Le chemin de l'image à enregistrer dans la base de données
                        } else {
                            echo "Erreur lors du téléchargement de l'image.";
                            return;
                        }
                    } else {
                        echo "Le fichier téléchargé n'est pas une image valide.";
                        return;
                    }
                } else {
                    // Si aucun fichier est téléchargé,pas mettre d'image 
                    $imagePath = null;
                }
    
                // on hash le mdp 
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
                // inscrit le compte et lien pour se co 
                $userModel = new User();
                if ($userModel->createUser($nom, $prenom, $email, $hashedPassword, $droits, $imagePath)) {
                    echo "Inscription réussie ! <a href='../index.php'>Connectez-vous ici</a>";
                } else {
                    echo "Erreur lors de l'inscription.";
                }
            } else {
                echo "Tous les champs sont requis.";
            }
        }
    }
    
    

    // Traiter la connexion
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['mail']); 
            $password = $_POST['password'];
    
            if (empty($email) || empty($password)) {
                echo "Tous les champs sont requis.";
                return;
            }
    
            $userModel = new User();
            $user = $userModel->getUserByEmail($email);
    
            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['nom'] = $user['nom']; // Stocker aux besoin
                $_SESSION['droits'] = $user['droits']; // Vérif si admin 
                header('Location: ./view/front/home.php'); // Redirection
                exit();
            } else {
                echo "Identifiants incorrects.";
            }
        }
    }    

    public function logout() {
        session_start();
        session_destroy();
        header('Location: ./view/front/home.php');
        exit();
    }

    public function VerifAdmin() {
        session_start();
        if ($_SESSION['droits'] != 'admin') {
            header('Location: ./view/front/home.php');
            exit();
        }
    }
}
?>
