<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Restaurant en Ligne</title>
    <link rel="stylesheet" href="public/styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">
  <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom ms-5 me-5">
        <div class="col-md-3 mb-2 mb-md-0">
          <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
            <svg class="bi" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
          </a>
        </div>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
          <li><a href="#" class="nav-link px-2">Accueil</a></li>
          <li><a href="#" class="nav-link px-2">Tarifs</a></li>
          <li><a href="#" class="nav-link px-2 d-none">Administrations</a></li>
        </ul>

        <div class="col-md-3 text-end">
          <a href="header('Location: ./view/front/user.php')" type="button" class="btn btn-outline-secondary me-2" id="userBtn">Profil</a>
        </div>
  </header>
</body>
</html>