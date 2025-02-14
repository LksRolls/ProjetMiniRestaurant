<?php

// Inclure le contrôleur
require_once 'Controllers/ControllerUser.php';

// Créer une instance du contrôleur
$controller = new AuthController();

// get l'url verifi si action et agir en conséquence 
$action = isset($_GET['action']) ? $_GET['action'] : '';

//redirection pour inscritpion 
if ($action === 'register') {
    $controller = new AuthController();
    $controller->register();
} elseif ($action === 'home'){
    $controller = new AuthController();
    $controller->login();
}
