<?php
include("../inc/fonction.php");
$n = $_GET['nom'];
$employee = getEmployees_departments($n);
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
    <main>
        <section>
            <article class="container">
            <table class="table table-striped table-hover">
                    <thead  class="table-dark">
                    <tr>
                        <td> # </td>
                        <td>Nom et prenom</td>
                    </tr>
                    </thead>
                <tbody>
                <?php $count = 0; foreach( $employee as $ligne ){ $count++; ?>
                    <tr>
                        <td><?= $count; ?></td>
                        <td><a href="fiche.php?nom=<?= $ligne['nom']; ?>&prenom=<?= $ligne['prenom']; ?>" class="text-primary"><?= $ligne['nom']; ?> <?= $ligne['prenom']; ?></a></td>
                    </tr>
                <?php } ?>   
                </tbody>
            </table>
            </article>
        </section>
    </main>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>