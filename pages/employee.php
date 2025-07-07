<?php
session_start();
include("../inc/fonction.php");
$department_id = $_GET['nom'];
$departmentName = getDepartmentName($department_id);
$_SESSION['departement_nom'] = $departmentName['dept_name'];
$employees = getEmployees_departments($department_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employés du Département: <?= htmlspecialchars($departmentName['dept_name']); ?></title>
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
<header>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
<div class="container-fluid">
<a class="navbar-brand" href="#">Entreprise 22</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
  <ul class="navbar-nav" style="margin-left: 200px;">
    <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="index.php">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="details.php">Gestion des emplois</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Rechercher</a>
    </li>
  </ul>
</div>
</div>
</nav>
</header>
    <main class="container py-4">
        <h1 class="mb-4 text-center">Employés du Département: <span class="text-primary"><?= htmlspecialchars($departmentName['dept_name']); ?></span></h1>
        <div class="d-flex justify-content-center mt-4">
            <a href="deconnect.php" class="btn btn-secondary">Retour</a>
        </div>
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
                                        <a href="fiche.php?nom=<?= urlencode($employee['first_name']); ?>&prenom=<?= urlencode($employee['last_name']); ?>" class="text-primary text-decoration-none">
                                            <?= htmlspecialchars($employee['first_name']); ?> <?= htmlspecialchars($employee['last_name']); ?>
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
        </div>
    </main>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>