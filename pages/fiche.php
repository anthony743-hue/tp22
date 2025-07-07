<?php
session_start();
include("../inc/fonction.php");
$nom = $_GET['nom'];
$prenom = $_GET['prenom'];
$departmentName = $_SESSION['departement_nom'];
$info = getInfo_employee($nom, $prenom);

if (!$info) {
    $id_employee = null;
    $titles = [];
    $salaries = [];
    $error_message = "Aucune information trouvée pour l'employé " . htmlspecialchars($nom) . " " . htmlspecialchars($prenom) . ".";
} else {
    $id_employee = $info['emp_no'];
    $titles = getTitle_employee($id_employee);
    $salaries = getHistoriq_salaries($id_employee);
    $emploi = getEmploi_name($id_employee);
    $current_salary =  getCurrent_salary($id_employee);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche de l'Employé: <?= htmlspecialchars($nom); ?> <?= htmlspecialchars($prenom); ?></title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-custom {
            border-radius: .5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        .info-item {
            padding-top: .5rem;
            padding-bottom: .5rem;
        }
    </style>
</head>
<body>
    <header class="py-3 mb-4">
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
            <div class="bg-primary text-white container">
            <h1 class="h3 text-center">
                Fiche d'information de l'employé :
                <span class="text-warning"><?= htmlspecialchars($nom); ?> <?= htmlspecialchars($prenom); ?></span>
            </h1>
        </div>
        <?php if (isset($error_message)) { ?>
            <div class="alert alert-danger text-center" role="alert">
                <?= $error_message; ?>
                <br><a href="javascript:history.back()" class="btn btn-danger mt-2">Retour</a>
            </div>
        <?php } else { ?>
            <div class="row g-4">
                <section class="col-lg-4 col-md-12">
                    <div class="card h-100 card-custom">
                        <div class="card-header bg-light">
                            <h4 class="card-title mb-0">Informations Personnelles</h4>
                        </div>
                        <div class="card-body">
                            <div class="row info-item">
                                <div class="col-6 fw-bold">Nom :</div>
                                <div class="col-6"><?= htmlspecialchars($nom); ?></div>
                            </div>
                            <hr class="my-2">
                            <div class="row info-item">
                                <div class="col-6 fw-bold">Prénom :</div>
                                <div class="col-6"><?= htmlspecialchars($prenom); ?></div>
                            </div>
                            <hr class="my-2">
                            <div class="row info-item">
                                <div class="col-6 fw-bold">Date de naissance :</div>
                                <div class="col-6"><?= htmlspecialchars($info['birth_date']); ?></div>
                            </div>
                            <hr class="my-2">
                            <div class="row info-item">
                                <div class="col-6 fw-bold">Sexe :</div>
                                <div class="col-6"><?= $info['gender'] == 'M' ? 'Masculin' : 'Féminin';?></div>
                            </div>
                            <hr class="my-2">
                            <div class="row info-item">
                                <div class="col-6 fw-bold">Date d'engagement :</div>
                                <div class="col-6"><?= htmlspecialchars($info['hire_date']); ?></div>
                            </div>

                            <hr class="my-2">
                            <div class="row info-item">
                                <div class="col-6 fw-bold">Departement</div>
                                <div class="col-6"><?= $_SESSION['departement_nom']; ?></div>
                            </div>
                            <hr class="my-2">
                            <div class="row info-item">
                                <div class="col-6 fw-bold">Emploi actuel</div>
                                <div class="col-6"><?= htmlspecialchars($emploi['title']); ?></div>
                            </div>
                            <hr class="my-2">
                            <div class="row info-item">
                                <div class="col-6 fw-bold">Salaire actuel</div>
                                <div class="col-6"><?= htmlspecialchars($current_salary['salary']); ?> $</div>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="col-lg-8 col-md-12">
                    <div class="row g-4">
                        <section class="col-12">
                            <div class="card card-custom">
                                <div class="card-header bg-light">
                                    <h4 class="card-title mb-0">Historique des Postes</h4>
                                </div>
                                <div class="card-body">
                                    <?php if (!empty($titles)) { ?>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover align-middle">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th scope="col">Poste</th>
                                                        <th scope="col">Date de Début</th>
                                                        <th scope="col">Date de Fin</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($titles as $row) { ?>
                                                        <tr>
                                                            <td><?= htmlspecialchars($row['title']); ?></td>
                                                            <td><?= htmlspecialchars($row['from_date']); ?></td>
                                                            <td><?= htmlspecialchars($row['to_date']); ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } else { ?>
                                        <div class="alert alert-info text-center" role="alert">
                                            Aucun historique de poste trouvé pour cet employé.
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </section>

                        <section class="col-12">
                            <div class="card card-custom">
                                <div class="card-header bg-light">
                                    <h4 class="card-title mb-0">Historique des Salaires</h4>
                                </div>
                                <div class="card-body">
                                    <?php if (!empty($salaries)) { ?>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover align-middle">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th scope="col">Salaire</th>
                                                        <th scope="col">Date de Début</th>
                                                        <th scope="col">Date de Fin</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($salaries as $row) { ?>
                                                        <tr>
                                                            <td><?= htmlspecialchars(number_format($row['salary'], 2, ',', ' ')); ?></td>
                                                            <td><?= htmlspecialchars($row['from_date']); ?></td>
                                                            <td><?= htmlspecialchars($row['to_date']); ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } else { ?>
                                        <div class="alert alert-info text-center" role="alert">
                                            Aucun historique de salaire trouvé pour cet employé.
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-5">
                <a href="javascript:history.back()" class="btn btn-secondary btn-lg">Retour</a>
            </div>
        <?php } ?>
    </main>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>