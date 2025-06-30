<?php
include("../inc/fonction.php");

$departmentName = $_GET['nom'];
$employees = getEmployees_departments($departmentName);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employés du Département: <?= htmlspecialchars($departmentName); ?></title>
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
    <main class="container py-4">
        <h1 class="mb-4 text-center">Employés du Département: <span class="text-primary"><?= htmlspecialchars($departmentName); ?></span></h1>

        <div class="table-container">
            <?php if (!empty($employees)) { ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom Complet</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 0; foreach ($employees as $employee) { $count++; ?>
                                <tr>
                                    <td><?= $count; ?></td>
                                    <td>
                                        <a href="fiche.php?nom=<?= urlencode($employee['nom']); ?>&prenom=<?= urlencode($employee['prenom']); ?>" class="text-primary text-decoration-none">
                                            <?= htmlspecialchars($employee['nom']); ?> <?= htmlspecialchars($employee['prenom']); ?>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
                <div class="alert alert-info text-center" role="alert">
                    Aucun employé trouvé pour le département "<?= htmlspecialchars($departmentName); ?>".
                </div>
            <?php } ?>
            <div class="d-flex justify-content-center mt-4">
                <a href="javascript:history.back()" class="btn btn-secondary">Retour</a>
            </div>
        </div>
    </main>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>