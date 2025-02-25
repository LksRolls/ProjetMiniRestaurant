<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Prestation</title>
</head>
<body>
    <form action="../../../controllers/controllerCreated.php?action=Created&table=prestation" method="POST">
        <h3>Ajouter une Prestation</h3>

        <label for="type_prestation">Nom de la Prestation :</label>
        <input type="text" id="type_prestation" name="type_prestation" required>

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
