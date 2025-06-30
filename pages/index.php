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
    <title>Document</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
    <main class="container">
        <div class="row p-3">
        <article class="col-4">

     <div class="row  p-3 border border-light-subtle mt-4">

        <h3>Formulaire de recherche</h3>
        <form action="traitement_recherche.php" method="post">
            <h4>Veuillez choisir un departement</h4>
        <select name="departement" class="form-select mt-3" aria-label="Default select example">
            <?php foreach($dep as $row) { ?>
                <option value="<?= $row['dept_no']; ?>"><?= $row['dept_name']; ?></option>
            <?php } ?>
        </select>
        <h4>Veuillez choisir un nom employe</h4>
        <select name="nom" class="form-select mt-3" aria-label="Default select example">
            <?php foreach($name as $row) { ?>
                <option value="<?= $row['first_name']; ?>"><?= $row['first_name']; ?></option>
            <?php } ?>
        </select>
        <div class="input-group mb-3 mt-3">
        <input class="" type="number" value="" name="min" min="<?= $min?>" max="<?= $avg; ?>" required>
        </div>
        <div class="input-group mb-3 mt-3">
        <input class="" type="number" value="" name="max" min="<?= $avg; ?>" max="<?= $max; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>

     </div>

        </article>
            <article class="col-8">
            <div class="text_center primary_text">
                <h4>Managers par departement</h4>
            </div>
            <table class="table table-striped table-hover">
                    <thead  class="table-dark">
                    <tr>
                        <td>Departements</td>
                        <td>Nom du manager</td>
                        <td>Prenom du manager</td>
                    </tr>
                    </thead>
                <tbody>
                <?php foreach( $dep_m as $ligne ){ ?>
                    <tr>
                        <td style="transform: rotate(0);"><a class="text-primary stretched-link" href="employee.php?nom=<?= $ligne['departement']; ?>"><?= $ligne['departement']; ?></a></td>
                        <td><?= $ligne['nom']; ?></td>
                        <td><?= $ligne['prenom']; ?></td>
                    </tr>
                <?php } ?>   
                </tbody>
            </table>
            </article>
        </div>
    </main>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>