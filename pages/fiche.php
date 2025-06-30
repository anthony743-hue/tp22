<?php
include("../inc/fonction.php");
$nom = $_GET['nom'];
$prenom = $_GET['prenom'];
$info = getInfo_employee($nom, $prenom);
$id_employee = $info['emp_no'];
$titles = getTitle_employee($id_employee);
$salaries = getHistoriq_salaries($id_employee);
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
        Fiche d'information de l'employee : <?= $nom; ?> <?= $prenom; ?> 
    </header>
    <main class="container">
        <article class="row">
        <section class="col-lg-4 col-md-12 p-3 border border-light-subtle mt-4">
            <div class="row">
                <div class="col-6">Nom</div>
                <div class="col-6"><?= $nom; ?></div>
            </div>
            <hr>
            <div class="row">
                <div class="col-6">Prenom</div>
                <div class="col-6"><?= $prenom; ?></div>
            </div>
            <hr>
            <div class="row">
                <div class="col-6">Date de naissance</div>
                <div class="col-6"><?= $info['birth_date']; ?></div>
            </div>
            <hr>
            <div class="row">
                <div class="col-6">Sexe</div>
                <div class="col-6"><?= $info['gender'] == 'M' ? 'Masculin' : 'Feminin';?></div>
            </div>
            <hr>
            <div class="row">
                <div class="col-6">Date d'engagement</div>
                <div class="col-6"><?= $info['hire_date']; ?></div>
            </div>
</section>
        <article class="row">
        <section class="col-lg-8 col-md-12 mt-5">
        <caption>Historique des emplois</caption>
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <td>Emploi</td>
                            <td>Date de debut</td>
                            <td>Date de fin</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($titles as $row) { ?>
                            <tr>
                                <td><?= $row['title']; ?></td>
                                <td><?= $row['from_date']; ?></td>
                                <td><?= $row['to_date']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                        </section>
                        <section class="col-lg-8 col-md-12 mt-3">
        <caption>Historique des salaires</caption>
            <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <td>Salaire</td>
                            <td>Date de debut</td>
                            <td>Date de fin</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($salaries as $row) { ?>
                            <tr>
                                <td><?= $row['salary']; ?></td>
                                <td><?= $row['from_date']; ?></td>
                                <td><?= $row['to_date']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                        </section>
        </article>
        </article>
    </main>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>