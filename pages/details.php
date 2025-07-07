<?php
ini_set("display_errors",1);
session_start();
include("../inc/fonction.php");
$work_g = getDetailledEmploi();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
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
    <div class="d-flex justify-content-evenly mt-4">
                <a href="deconnect.php" class="btn btn-secondary btn-lg start-">Retour à la page d'accueil</a>
        </div>
    <div class="p-4 border">
    <h3 class="mb-4 text-center">Gestion des Emplois</h3>
        <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead  class="table-dark">
                <tr>
                    <th scope = "col">Emploi</th>
                    <th scope = "col">Hommes</th>
                    <th scope = "col">Femmes</th>
                    <th scope = "col">Salaire moyen</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($work_g)) { ?>
                    <?php foreach( $work_g as $ligne ){ ?>
                        <tr>
                        <td><?= $ligne['emploi']; ?></td>
                        <td><?= $ligne['male_count']; ?></td>
                        <td><?= $ligne['female_count']; ?></td>
                        <td><?= $ligne['medium_salary'];?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="3" class="text-center">Aucun emploi trouvé.</td>
                    </tr>
                <?php } ?>
                <tr>
                    
                </tr>
                
            </tbody>
        </table>
        </div>
    </div>
    </main>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>