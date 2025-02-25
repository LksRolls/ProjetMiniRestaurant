<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau droit</title>
</head>
<body>
    <form action="../../../controllers/controllerCreated.php?action=Created&table=droits" method="POST">
        <h3>Nouveau droit</h3>

        <label for="libelle_droits">Nom du droit :</label>
        <input type="text" id="libelle_droits" name="libelle_droits" required>

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
