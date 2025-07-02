<?php
ini_set("display_errors",1);
session_start();
include("../inc/fonction.php");
$dep_m = getDepartments_manager();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <table>
            <thead>
                <tr>
                    <th scope = "col">Hommes</th>
                    <th scope = "col">Femmes</th>
                    <th scope = "col">Emploi</th>
                    <th scope = "col">Salaire moyen</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($dep_m)) { ?>
                    <?php foreach( $dep_m as $ligne ){ ?>
                        <tr>
                            <!-- <td><a href="employee.php?nom=<?= urlencode($ligne['departement']);?>" class="text-primary text-decoration-none"><?= $ligne['departement']; ?></a></td>
                            <td><?= countEmployeFemmes($ligne['no'])['nbHomme']; ?></td>
                            <td><?= countEmployeHommes($ligne['no'])['nbFemme']; ?> </td>
                            <td><?= countEmploye($ligne['no'])['nb'];?></td> -->
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="3" class="text-center">Aucun manager trouvé.</td>
                    </tr>
                <?php } ?>
                <tr>
                    
                </tr>
                
            </tbody>
        </table>
    </main>
</body>
</html>