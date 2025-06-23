<?php
include("../inc/fonction.php");
$dep = getDepartments();
$dep_m = getDepartments_manager();
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
            <div class="text_center primary_text">
                <h4>Departements</h4>
            </div>
            <table class="table table-striped table-hover">
                    <tr>
                        <td>departements</td>
                    </tr>
                <?php foreach( $dep as $ligne ){ ?>
                    <tr>
                        <td><?= $ligne['departement']; ?></td>
                    </tr>
                <?php } ?>   
            </table>
            </article>
           <article class="container">
            <div class="text_center primary_text">
                <h4>Managers par departement</h4>
            </div>
           <table class="table table-striped table-hover">
                    <tr>
                        <td>departements</td>
                        <td>Nom du manager</td>
                        <td>Prenom du manager</td>
                    </tr>
                <?php foreach( $dep_m as $ligne ){ ?>
                    <tr>
                        <td style="transform: rotate(0);"><a class="text-primary stretched-link" href="employee.php?nom=<?= $ligne['departement']; ?>"><?= $ligne['departement']; ?></a></td>
                        <td><?= $ligne['nom']; ?></td>
                        <td><?= $ligne['prenom']; ?></td>
                    </tr>
                <?php } ?>   
            </table>
           </article>
        </section>
    </main>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>