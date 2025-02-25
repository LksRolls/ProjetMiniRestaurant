<?php
require_once '../../model/Bdd.php';

// Connexion à la base de données
$db = Database::getConnection();

// Requêtes pour récupérer les données
$tables = [
    "categorie" => "SELECT * FROM categorie", 
    "prestation" => "SELECT * FROM prestation", 
    "tarif" => "SELECT * FROM tarif", 
    "users" => "SELECT * FROM users",
    "droits" => "SELECT * FROM droits" // Correction du nom de la table
];

// Récupérer les données pour affichage
$data = [];
foreach ($tables as $name => $query) {
    $stmt = $db->query($query);
    $data[$name] = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>

<section id="admin">
    <h1>Vue d'Administration des Tables</h1>

    <div class="container w-95 mx-auto">
        <?php foreach ($data as $tableName => $rows): ?>
            <h3 class="pt-3">Table <?= ucfirst($tableName) ?></h3>
            <?php if (count($rows) > 0): ?>
                <table class="table table-responsive w-100">
                    <a class="btn btn-success m-3" onclick="window.location.href='crud/create<?=ucfirst($tableName)?>.php'">Ajouter</a>
                    <thead>
                        <tr>
                            <?php foreach (array_keys($rows[0]) as $column): ?>
                                <th class="col"><?= ucfirst($column) ?></th>
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
                                    <a class="btn btn-danger m-1" href="crud/delete<?=ucfirst($tableName)?>.php?Id=<?= urlencode(reset($row)) ?>">Supprimer</a>
                                </td>
                                <td>
                                    <a class="btn btn-warning m-1" href="crud/modify<?=ucfirst($tableName)?>.php?Id=<?= urlencode(reset($row)) ?>">Modifier</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucune donnée disponible pour cette table.</p>
                <button class="btn btn-primary" onclick="window.location.href='crud/create<?=ucfirst($tableName)?>.php'">Ajouter</button>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</section>
