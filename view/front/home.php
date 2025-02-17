<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../../public/styles/style.css">
</head>
<body>
    <?php session_start(); ?>
    <?php require_once __DIR__ . '/../../controllers/checkAuth.php'; ?>
    <?php include '../template/header.php'; ?>
    <div>
        <?php include '../front/tarifs.php'; ?>
    </div>    
    <?php 
        if ($droits = 1) {
            include '../front/Admin.php';
        }
    ?>
    <?php include '../template/footer.php'; ?>
</body>
</html>