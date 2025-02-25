<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau Tarif</title>
</head>
<body>
    <form action="../../../controllers/controllerModify.php?action=Modify&table=tarif" method="POST" enctype="multipart/form-data">
        <h3>Ajouter un Tarif</h3>
        
        <label for="id_prestation">ID Prestation :</label>
        <input type="number" id="id_prestation" name="id_prestation" required>

        <label for="id_categorie">ID Catégorie :</label>
        <input type="number" id="id_categorie" name="id_categorie" required>

        <label for="prix">Prix :</label>
        <input type="text" id="prix" name="prix" required>

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>