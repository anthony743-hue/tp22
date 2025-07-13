<?php
$dep = $_SESSION['departement'];
$name = $_SESSION['nom'];
$min = $_SESSION['min'];
$max = $_SESSION['max'];
$_SESSION['size'] = count_Employees_Filtered($dep, $name, $min, $max);
$size = $_SESSION['size'];
if (!isset($_SESSION['compteur'])) {
    $_SESSION['compteur'] = 0;
}
$cmp = $_SESSION['compteur'];
$emp = getEmployees_filtered($dep, $name, $min, $max, $cmp);
?>

<main class="container-fluid py-4 px-5">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="employee-title">
                    <span class="employee-count"><?= $size ?></span> Employee
                </h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="employee-container">
                <?php if (!empty($emp)) { ?>
                    <div class="row g-4">
                        <?php foreach ($emp as $employee) { ?>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="employee-card">
                                    <div class="card-body">
                                        <h5 class="employee-name">
                                            <?= htmlspecialchars($employee['first_name']); ?> <?= htmlspecialchars($employee['last_name']); ?>
                                        </h5>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>Aucun employees trouves</h3>
                        <p>Aucun employees remplient vos criteres</p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="pagination-container">
                <div class="pagination-controls">
                    <?= display_next_previous_button($cmp, $size); ?>
                </div>
                <div class="back-button">
                    <a href="modal.php?p=home.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Search
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>