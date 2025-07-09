<?php
$department_id = isset($_GET['nom']) ? htmlspecialchars($_GET['nom']) : '';
$departmentName = getDepartmentName($department_id);
$_SESSION['departement_nom'] = $departmentName['dept_name'] ?? 'Inconnu';
$employees = getEmployees_departments($department_id);
?>
<main class="container py-4">
        <div class="main-content-section">
            <h1 class="mb-4 text-center">Employés du Département: <span class="text-primary"><?= htmlspecialchars($departmentName['dept_name'] ?? 'Inconnu'); ?></span></h1>

            <div class="table-container">
                <?php if (!empty($employees)) { ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nom Complet</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 0; foreach ($employees as $employee) { $count++; ?>
                                    <tr>
                                        <td><?= $count; ?></td>
                                        <td>
                                            <a href="modal.php?p=fiche.php&nom=<?= urlencode($employee['first_name']); ?>&prenom=<?= urlencode($employee['last_name']); ?>" class="table-employee-link">
                                                <?= htmlspecialchars($employee['first_name']); ?> <?= htmlspecialchars($employee['last_name']); ?>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-info text-center" role="alert">
                        Aucun employé trouvé pour le département "<strong><?= htmlspecialchars($departmentName['dept_name'] ?? 'Inconnu'); ?></strong>".
                    </div>
                <?php } ?>
            </div>

            <div class="text-center mt-4">
                <button type="button" class="btn btn-secondary-custom" onclick="history.back();">Retour</button>
            </div>
        </div>
    </main>