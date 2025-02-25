<?php

// avatar par defaut au cas ou probleme
$avatarPath = "../../Upload/default.png";

// verif utilisateurs connecte
if (isset($_SESSION['avatar']) && !empty($_SESSION['avatar'])) {
    $avatarPath = "../../" . $_SESSION['avatar'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Restaurant en Ligne</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 border-bottom fixed-top">
      <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <img src="<?= htmlspecialchars($avatarPath) ?>" class="bi me-2 rounded-circle" alt="Bootstrap" width="75" height="75">
      </a>

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="#Tarifs" class="nav-link px-2 link-dark">Acceuil</a></li>
        <li><a href="#Tarifs" class="nav-link px-2 link-dark">Tarifs</a></li>
        <li><a href="#Admins" class="nav-link px-2 link-dark">Admin</a></li>
      </ul>

      <div class="col-md-3 text-end">
        <a class="btn btn-primary m-3" href="user.php" type="button" id="Button">Profil</a>
        <a class="btn btn-primary m-3" href="../../router/frontRouter.php?action=logout" type="button" id="Button">Déconnexion</a>

      </div>
    </header>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
