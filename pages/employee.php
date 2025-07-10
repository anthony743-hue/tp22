<?php
$department_id = isset($_GET['nom']) ? htmlspecialchars($_GET['nom']) : '';
$departmentName = getDepartmentName($department_id);
$_SESSION['departement_nom'] = $departmentName['dept_name'] ?? 'Inconnu';
$employees = getEmployees_departments($department_id);
?>
<main class="container py-4">
    <div class="main-content-section">
        <div class="text-center mt-4">
            <a href="javascript:history.back()" class="btn btn-outline-secondary" role="button">Retour a l'Accueil</a>
        </div>
        <h1 class="mb-4 ps-4">Employés du Département: <span class="text-primary"><?= htmlspecialchars($departmentName['dept_name'] ?? 'Inconnu'); ?></span></h1>

        <div>
            <?php if (!empty($employees)) { ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Nom Complet</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($employees as $employee) {  ?>
                                <tr>
                                    <td>
                                        <a href="modal.php?p=fiche.php&nom=<?= urlencode($employee['first_name']); ?>&prenom=<?= urlencode($employee['last_name']); ?>" class="text-decoration-none">
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
    </div>
</main>