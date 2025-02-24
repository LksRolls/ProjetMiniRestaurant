<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau Droit</title>
</head>
<body>
    <form action="../../../controllers/controllerModify.php?action=Modify&table=droits" method="POST" enctype="multipart/form-data">
        <h3>Ajouter un Droit</h3>
        
        <label for="libelle_droits">Nom du Droit :</label>
        <input type="text" id="libelle_droits" name="libelle_droits" required>

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>