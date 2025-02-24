<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle Prestation</title>
</head>
<body>
    <form action="../../../controllers/controllerModify.php?action=Modify&table=prestation" method="POST" enctype="multipart/form-data">
        <h3>Ajouter une Prestation</h3>
        
        <label for="type_prestation">Type de Prestation :</label>
        <input type="text" id="type_prestation" name="type_prestation" required>

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>