<?php
// Verif si utilisateur connecté et admin
if (!isset($_SESSION['user_id']) || $_SESSION['droits'] != 1) {
    header("Location: ../../index.php?action=login");
    exit();
}

require_once '../../model/Bdd.php';

// Connexion bdd
$db = Database::getConnection();

// Requete pour recup donnée
$tables = [
    "categorie" => "SELECT * FROM categorie", 
    "prestation" => "SELECT * FROM prestation", 
    "tarif" => "SELECT * FROM tarif", 
    "users" => "SELECT * FROM users",
    "droit" => "SELECT * FROM droits"
];

// Donnée mise dans tableau pour affichage
$data = [];
foreach ($tables as $name => $query) {
    $data[$name] = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Vue des Tables</title>
    <link rel="stylesheet" href="../../public/styles/style.css">
</head>
<body>

<h1>Vue d'Administration des Tables</h1>

<div class="container">
    <?php foreach ($data as $tableName => $rows): ?>
        <h3>Table <?= ucfirst($tableName) ?></h3>
        <?php if (count($rows) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <?php foreach (array_keys($rows[0]) as $column): ?>
                            <th><?= ucfirst($column) ?></th>
                        <?php endforeach; ?>
                        <th>Supprimer</th>
                        <th>Modifier</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <?php foreach ($row as $key => $cell): ?>
                                <td><?= htmlspecialchars($cell) ?></td>
                            <?php endforeach; ?>
                            <td>
                                <a href="crud/delete<?=ucfirst($tableName)?>.php?Id=<?=reset($row)?>" class="supprButton">Supprimer</a>
                            </td>
                            <td>
                                <a href="crud/modify<?=ucfirst($tableName)?>.php?Id=<?=reset($row)?>" class="modifButton">Modifier</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucune donnée disponible pour cette table.</p>
        <?php endif; ?>
    <?php endforeach; ?>
</div>


</body>
</html>
