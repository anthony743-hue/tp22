<?php
session_start();
include("../inc/fonction.php");
$dep = $_SESSION['departement'];
$name = $_SESSION['nom'];
$min = $_SESSION['min'];
$max = $_SESSION['max'];
$_SESSION['size'] = ($dep == "Tous" ) ? count_resultat($name, $min, $max) : count_result($dep, $name, $min, $max);
$size = $_SESSION['size'];
if( !isset($_SESSION['compteur']) ){
    $_SESSION['compteur'] = 0;
}
echo $size;
$cmp = $_SESSION['compteur'];
$emp = ($dep == "Tous" ) ? getRelate_Employees($name, $min, $max, $cmp) : getRelative_Employees($dep, $name, $min, $max, $cmp);
$resultsToDisplay = $emp;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de Recherche Employés</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-container {
            background-color: #ffffff;
            border-radius: .5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            padding: 1.5rem;
        }
    </style>
</head>
<body>
    <header class="bg-primary text-white py-3 mb-4">
        <div class="container">
            <h1 class="h3 text-center">Résultats de Recherche d'Employés</h1>
            <p class="text-center mb-0">
                Département: <span class="fw-bold"><?= htmlspecialchars($dep); ?></span> |
                Nom: <span class="fw-bold"><?= htmlspecialchars($name); ?></span> |
                Âge: <span class="fw-bold"><?= htmlspecialchars($min); ?> - <?= htmlspecialchars($max); ?></span> ans
            </p>
        </div>
    </header>

    <main class="container py-4">
        <div class="d-flex justify-content-evenly mt-4">
                <?php if( $cmp > 0 ){ ?>                    
                    <a href="traitement_next.php?id=-1" class="btn btn-secondary btn-lg">Precedent</a>
                <?php } ?>
                <?php if( $cmp + 20 < $size ){ ?> 
                    <a href="traitement_next.php?id=1" class="btn btn-secondary btn-lg">Suivant</a>
                    <?php } ?>
                <a href="deconnect.php" class="btn btn-secondary btn-lg">Retour à la recherche</a>
        </div>
        <div class="table-container">
            <?php if (!empty($resultsToDisplay)) { ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom Complet</th>
                                <th scope="col">Date de Naissance</th>
                                <th scope="col">Genre</th>
                                <th scope="col">Date d'embauche</th>
                                </tr>
                        </thead>
                        <tbody>
                            <?php $count = 0; foreach ($resultsToDisplay as $employee) { $count++; ?>
                                <tr>
                                    <td><?= $count; ?></td>
                                    <td>
                                    <?= htmlspecialchars($employee['first_name']); ?> <?= htmlspecialchars($employee['last_name']); ?>
                                    </td>
                                    <td><?= htmlspecialchars($employee['birth_date'] ?? 'N/A'); ?></td>
                                    <td><?= htmlspecialchars($employee['gender'] == 'M' ? 'Masculin' : 'Féminin' ?? 'N/A'); ?></td>
                                    <td><?= htmlspecialchars($employee['hire_date'] ?? 'N/A'); ?></td>
                                    </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
                <div class="alert alert-warning text-center" role="alert">
                    Aucun employé trouvé correspondant a vos critères de recherche.
                </div>
            <?php } ?>
        </div>
    </main>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>