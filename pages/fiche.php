<?php
$nom = isset($_GET['nom']) ? $_GET['nom'] : '';
$prenom = isset($_GET['prenom']) ? $_GET['prenom'] : '';

$info = getInfo_employee($nom, $prenom);

$error_message = null;

if (!$info) {
    $error_message = "Aucune information trouvée pour l'employé " . htmlspecialchars($nom) . " " . htmlspecialchars($prenom) . ".";
    $id_employee = null;
    $titles = [];
    $salaries = [];
    $departmentName = ['dept_name' => 'N/A'];
    $emploi = ['title' => 'N/A'];
    $current_salary = ['salary' => 0];
} else {
    $id_employee = $info['emp_no'];
    $departmentName = getDepartmentName($info['dept_no']);
    $titles = getTitle_employee($id_employee);
    $salaries = getHistoriq_salaries($id_employee);
    $emploi = getEmploi_name($id_employee);
    $current_salary = getCurrent_salary($id_employee);
}
?>
<main class="container py-5">
    <?php if (isset($error_message)) { ?>
        <div class="alert alert-danger text-center" role="alert">
            <?= $error_message; ?>
            <div class="mt-3">
                 <a href="modal.php?p=home.php" class="btn btn-primary">Revenir à l'accueil</a>
            </div>
        </div>
    <?php } else { ?>
        <div class="d-flex justify-content-end mb-3">
            <a href="modal.php?p=employee.php&nom=<?= $info['dept_no']; ?>" class="btn btn-primary">Retour</a>
        </div>
        <div class="row g-4">
            <section class="col-lg-6 col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-light p-2">
                        Informations Personnelles
                    </div>
                    <div class="card-body">
                        <div class="info-item">
                            <div>Nom Complet :</div>
                            <div><?= htmlspecialchars($nom); ?> <?= htmlspecialchars($prenom); ?></div>
                        </div>
                        <div class="info-item">
                            <div>Date de naissance :</div>
                            <div><?= htmlspecialchars($info['birth_date'] ?? 'N/A'); ?></div>
                        </div>
                        <div class="info-item">
                            <div>Sexe :</div>
                            <div><?= isset($info['gender']) ? ($info['gender'] == 'M' ? 'Masculin' : 'Féminin') : 'N/A';?></div>
                        </div>
                        <div class="info-item">
                            <div>Date d'engagement :</div>
                            <div><?= htmlspecialchars($info['hire_date'] ?? 'N/A'); ?></div>
                        </div>
                        <div class="info-item">
                            <div>Département actuel :</div>
                            <div><?= htmlspecialchars($departmentName['dept_name']); ?></div>
                        </div>
                        <div class="info-item">
                            <div>Emploi actuel :</div>
                            <div><?= htmlspecialchars($emploi['title']); ?></div>
                        </div>
                        <div class="info-item">
                            <div>Salaire actuel :</div>
                            <div><?= htmlspecialchars(number_format($current_salary['salary'], 0, ',', ' ')); ?> $</div>
                        </div>
                        <div class="d-flex justify-content-evenly mt-4">
                            <a href="modal.php?p=change.php" class="btn btn-outline-secondary">Changer de département</a>
                            <a href="modal.php?p=manager.php&nom=<?= $nom;?>&prenom=<?= $prenom; ?>" class="btn btn-outline-success">Devenir Manager</a>
                        </div>
                    </div>
                </div>
            </section>

            <section class="col-lg-6 col-md-12">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-light p-2">
                        Historique Professionnel
                    </div>
                    <div class="card-body">
                        <h5 class="section-title">Postes occupés</h5>
                        <?php if (!empty($titles)) { ?>
                            <ul class="timeline scrollable-list">
                                <?php foreach($titles as $row) { ?>
                                    <li class="timeline-item">
                                        <?= htmlspecialchars($row['title']); ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } else { ?>
                            <div class="alert alert-info text-center">
                                Aucun poste précédent trouvé.
                            </div>
                        <?php } ?>

                        <h5 class="section-title mt-4">Historique des Salaires</h5>
                        <?php if (!empty($salaries)) { ?>
                            <ul class="timeline scrollable-list">
                                <?php foreach($salaries as $row) { ?>
                                    <li class="timeline-item">
                                        <?= htmlspecialchars(number_format($row['salary'], 0, ',', ' ')); ?> $
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } else { ?>
                            <div class="alert alert-info text-center">
                                Aucun historique de salaire trouvé.
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
        </div>
    <?php } ?>
</main>