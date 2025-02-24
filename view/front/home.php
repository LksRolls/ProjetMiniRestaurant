<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../../public/styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php session_start(); ?>
    <?php require_once __DIR__ . '/../../controllers/checkAuth.php'; ?>
    <?php include '../template/header.php'; ?>
    <div>
        <?php include '../front/tarifs.php'; ?>  
    <?php 
        if ($droits = 1) {
            include '../front/Admin.php';
        }
    ?>
    </div>  
    <?php include '../template/footer.php'; ?>
</body>
</html>