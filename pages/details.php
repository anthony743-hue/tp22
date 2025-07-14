<?php
$work_g = getDetailledEmploi();
?>
<main class="container py-4">
    <div class="text-center mb-4">
        <a href="modal.php?p=home.php" class="btn btn-secondary">Retour à l'accueil</a>
    </div>
    
    <div class="p-4 border">
        <h3 class="mb-4 text-center">Gestion des Emplois</h3>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Emploi</th>
                        <th>Hommes</th>
                        <th>Femmes</th>
                        <th>Salaire moyen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($work_g)) { ?>
                        <?php foreach($work_g as $ligne) { ?>
                            <tr>
                                <td><?= htmlspecialchars($ligne['emploi']); ?></td>
                                <td><?= htmlspecialchars($ligne['male_count']); ?></td>
                                <td><?= htmlspecialchars($ligne['female_count']); ?></td>
                                <td><?= htmlspecialchars($ligne['medium_salary']); ?></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="4" class="text-center">Aucun emploi trouvé.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>