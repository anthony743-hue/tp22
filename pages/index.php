<?php
include("../inc/fonction.php");
$dep = getDepartments();
$dep_m = getDepartments_manager();
$name = getName_employees();
$min = getMinEmployee_age()['age'];
$avg = (int) getAverageEmployee_age()['age'];
$max = getMaxEmployee_age()['age'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Employés</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles for better aesthetics (optional) */
        .form-section {
            background-color: #f8f9fa; /* Light background for the form */
            border-radius: .5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        .table-section {
            background-color: #ffffff;
            border-radius: .5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
    </style>
</head>
<body>
    <main class="container py-4">
        <h1 class="mb-4 text-center">Tableau de Bord des Employés</h1>
        <div class="row g-4">
            <aside class="col-md-4">
                <div class="p-4 border form-section">
                    <h3 class="mb-4 text-center">Rechercher des Employés</h3>
                    <form action="traitement_recherche.php" method="post">
                        <div class="mb-3">
                            <label for="departementSelect" class="form-label">Sélectionner un département :</label>
                            <select name="departement" id="departementSelect" class="form-select">
                                <?php foreach($dep as $row) { ?>
                                    <option value="<?= $row['dept_name']; ?>"><?= $row['dept_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nomEmployeSelect" class="form-label">Sélectionner un nom d'employé :</label>
                            <select name="nom" id="nomEmployeSelect" class="form-select">
                                <?php foreach($name as $row) { ?>
                                    <option value="<?= $row['first_name']; ?>"><?= $row['first_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="minAge" class="form-label">Âge Minimum :</label>
                                <input type="number" class="form-control" id="minAge" name="min" value="<?= $min ?>" min="<?= $min?>" max="<?= $avg; ?>" required>
                                <small class="form-text text-muted">Min: <?= $min ?>, Avg: <?= $avg ?></small>
                            </div>
                            <div class="col">
                                <label for="maxAge" class="form-label">Âge Maximum :</label>
                                <input type="number" class="form-control" id="maxAge" name="max" value="<?= $max ?>" min="<?= $avg; ?>" max="<?= $max; ?>" required>
                                <small class="form-text text-muted">Avg: <?= $avg ?>, Max: <?= $max ?></small>
                            </div>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">Rechercher</button>
                        </div>
                    </form>
                </div>
            </aside>
            <section class="col-md-8">
                <div class="p-4 border table-section">
                    <h3 class="mb-4 text-center">Managers par Département</h3>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Département</th>
                                    <th scope="col">Nom du Manager</th>
                                    <th scope="col">Prénom du Manager</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($dep_m)) { ?>
                                    <?php foreach( $dep_m as $ligne ){ ?>
                                        <tr>
                                            <td><a href="employee.php?nom=<?= urlencode($ligne['departement']); ?>" class="text-primary text-decoration-none"><?= $ligne['departement']; ?></a></td>
                                            <td><?= $ligne['nom']; ?></td>
                                            <td><?= $ligne['prenom']; ?></td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="3" class="text-center">Aucun manager trouvé.</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>