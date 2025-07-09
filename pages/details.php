<?php
$work_g = getDetailledEmploi();
?>
    <main class="container py-4">
    <div class="d-flex justify-content-evenly mt-4">
                <a href="modal.php?p=home.php" class="btn btn-secondary btn-lg start-">Retour à la page d'accueil</a>
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