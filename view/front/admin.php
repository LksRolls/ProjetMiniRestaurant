<?php
// Vérifier si utilisateur est connecté et admin
if (!isset($_SESSION['user_id']) || $_SESSION['droits'] != 1) {
    header("Location: ../../index.php?action=login");
    exit();
}

require_once '../../model/Bdd.php';

// Connexion à la base de données
$db = Database::getConnection();

// Récupération des données depuis la base
$tables = [
    "usager" => "SELECT * FROM usager",
    "users" => "SELECT us.*, dr.libelle_droits FROM users AS us INNER JOIN droits AS dr ON dr.id_droits=us.droits",
    "ticket" => "SELECT * FROM ticket",
    "tarif" => "SELECT * FROM tarif",
    "prestation" => "SELECT * FROM prestation",
    "depot" => "SELECT * FROM depot",
    "categorie" => "SELECT * FROM categorie",
    "achat" => "SELECT * FROM achat"
];

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
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <?php foreach ($row as $cell): ?>
                                <td><?= htmlspecialchars($cell) ?></td>
                            <?php endforeach; ?>
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
