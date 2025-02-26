<?php
    if ($_GET['error']){
        $erreur = $_GET['error'];
        echo "<script type='text/javascript'>alert('$erreur');</script>";
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/styles/style.css">
</head>
<body>
    <?php 
        session_start(); 
        require_once __DIR__ . '/../../controllers/checkAuth.php'; 
        // verif que la personne a bien un droit
        $droits = isset($_SESSION['droits']) ? $_SESSION['droits'] : null;
        
        if ($droits == 1) {
            include '../template/headerAdmin.php'; 
        } else {
            include '../template/header.php'; 
        }
    ?>
    <?php include '../front/tarifs.php'; ?>  

    <?php 
    // affiche seulement si la personne est admin
    if ($droits == 1) {
        include '../front/Admin.php';
    }
    ?>  

    <?php include '../template/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
