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
                    <tr>
                        <td>Nom</td>
                        <td>prenom</td>
                    </tr>
                <?php foreach( $employee as $ligne ){ ?>
                    <tr>
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