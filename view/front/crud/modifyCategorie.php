<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle Catégorie</title>
</head>
<body>
    <form action="../../../controllers/controllerModify.php?action=Modify&table=categorie" method="POST" enctype="multipart/form-data">
        <h3>Ajouter une Catégorie</h3>
        
        <label for="libelle_categorie">Nom de la Catégorie :</label>
        <input type="text" id="libelle_categorie" name="libelle_categorie" required>

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>