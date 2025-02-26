<?php
require_once '../../model/Bdd.php';

// verif que la personne a bien un droit
$droits = isset($_SESSION['droits']) ? $_SESSION['droits'] : null;
if ($droits !== 1) {
    header("location: ../../view/front/home.php");
}
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

<section id="admin" class="container my-4 pt-5">
    <h1 class="text-center mb-4 pt-5">Vue d'Administration des Tables</h1>

    <div class="container w-100">
        <?php foreach ($data as $tableName => $rows): ?>
            <div class="text-center">
                <h3 class="pt-5"><?= ucfirst($tableName) ?></h3>
                
                <?php if (count($rows) > 0): ?>
                    <a class="btn btn-success my-4" href="crud/new<?=ucfirst($tableName)?>.php">Ajouter</a>
            </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover text-center align-middle">
                        <thead class="table-dark">
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
                                        <a class="btn btn-danger btn-sm" href="crud/delete<?=ucfirst($tableName)?>.php?Id=<?= urlencode(reset($row)) ?>">Supprimer</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-warning btn-sm" href="crud/modify<?=ucfirst($tableName)?>.php?Id=<?= urlencode(reset($row)) ?>">Modifier</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            <?php else: ?>
                <p class="text-danger">Aucune donnée disponible pour cette table.</p>
                <button class="btn btn-primary" onclick="window.location.href='crud/create<?=ucfirst($tableName)?>.php'">Ajouter</button>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</section>

