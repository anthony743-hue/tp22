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
            <div class="alert alert-danger text-center shadow-sm" role="alert">
                <?= $error_message; ?>
                <div class="mt-3">
                    <a href="javascript:history.back()" class="btn btn-secondary-custom">Retour à la recherche</a>
                </div>
            </div>
        <?php } else { ?>
            <div class="row g-4">
                <section class="col-lg-6 col-md-12">
                    <div class="card card-customy">
                        <div class="card-header">
                            <span>Informations Personnelles</span>
                        </div>
                        <div class="card-body">
                            <div class="info-item">
                                <div class="col-6">Nom Complet :</div>
                                <div class="col-6 text-end"><?= htmlspecialchars($nom); ?> <?= htmlspecialchars($prenom); ?></div>
                            </div>
                            <div class="info-item">
                                <div class="col-6">Date de naissance :</div>
                                <div class="col-6 text-end"><?= htmlspecialchars($info['birth_date'] ?? 'N/A'); ?></div>
                            </div>
                            <div class="info-item">
                                <div class="col-6">Sexe :</div>
                                <div class="col-6 text-end"><?= isset($info['gender']) ? ($info['gender'] == 'M' ? 'Masculin' : 'Féminin') : 'N/A';?></div>
                            </div>
                            <div class="info-item">
                                <div class="col-6">Date d'engagement :</div>
                                <div class="col-6 text-end"><?= htmlspecialchars($info['hire_date'] ?? 'N/A'); ?></div>
                            </div>
                            <div class="info-item">
                                <div class="col-6">Département actuel :</div>
                                <div class="col-6 text-end"><?= htmlspecialchars($departmentName['dept_name']); ?></div>
                            </div>
                            <div class="info-item">
                                <div class="col-6">Emploi actuel :</div>
                                <div class="col-6 text-end"><?= htmlspecialchars($emploi['title']); ?></div>
                            </div>
                            <div class="info-item">
                                <div class="col-6">Salaire actuel :</div>
                                <div class="col-6 text-end"><?= htmlspecialchars(number_format($current_salary['salary'], 0, ',', ' ')); ?> $</div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="javascript:history.back()" class="btn btn-primary" role="button">Retour à la recherche</a>
                        <a href="modal.php?p=change.php" class="btn btn-outline-secondary" role="button">Changer de departement</a>
                    </div>
                </section>

                <section class="col-lg-6 col-md-12">
                    <div class="card card-custom h-100">
                        <div class="card-header">
                            <span>Historique Professionnel</span>
                        </div>
                        <div class="card-body">
                            <h5 class="section-title">Postes occupés</h5>
                            <?php if (!empty($titles)) { ?>
                                <ul class="timeline scrollable-list">
                                    <?php foreach($titles as $row) { ?>
                                        <li class="timeline-item">
                                            <h5><?= htmlspecialchars($row['title']); ?></h5>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } else { ?>
                                <div class="alert alert-info text-center" role="alert">
                                    Aucun historique de poste trouvé.
                                </div>
                            <?php } ?>

                            <h5 class="section-title mt-4">Historique des Salaires</h5>
                            <?php if (!empty($salaries)) { ?>
                                <ul class="timeline scrollable-list">
                                    <?php foreach($salaries as $row) { ?>
                                        <li class="timeline-item">
                                            <h5><?= htmlspecialchars(number_format($row['salary'], 0, ',', ' ')); ?> $</h5>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } else { ?>
                                <div class="alert alert-info text-center" role="alert">
                                    Aucun historique de salaire trouvé.
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </section>
            </div>
        <?php } ?>
    </main>