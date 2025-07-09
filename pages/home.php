<?php
$dep = getDepartments();
$dep_m = getDepartments_manager();
$min = getMinEmployee_age()['age'];
$avg = (int) getAverageEmployee_age()['age'];
$max = getMaxEmployee_age()['age'];
?>
    <main class="container py-5">
        <div class="main-content-section">
            <div class="form-section">
                <h3 class="mb-4 text-center">Rechercher des Employés</h3>
                <form action="traitement_recherche.php" method="post">
                    <div class="form-row-custom">
                        <div class="form-group-custom">
                            <label for="departementSelect" class="form-label">Département :</label>
                            <select name="departement" id="departementSelect" class="form-select">
                                <option value="Tous">Tous</option>
                                <?php foreach($dep as $row) { ?>
                                    <option value="<?= $row['dept_name']; ?>"><?= $row['dept_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group-custom">
                            <label for="nomEmployeInput" class="form-label">Nom de l'employé :</label>
                            <input type="text" class="form-control" name="nom" id="nomEmployeInput" placeholder="Ex: Dupont" aria-label="Nom de l'employé">
                        </div>
                        <div class="form-group-custom form-group-age">
                            <label for="minAge" class="form-label">Âge Min :</label>
                            <input type="number" class="form-control" id="minAge" name="min" value="<?= 0 ?>" min="0" max="<?= $avg; ?>" required>
                        </div>
                        <div class="form-group-custom form-group-age">
                            <label for="maxAge" class="form-label">Âge Max :</label>
                            <input type="number" class="form-control" id="maxAge" name="max" value="<?= $max ?>" min="<?= $avg; ?>" max="<?= $max; ?>" required>
                        </div>
                        <div class="h-25">
                            <button type="submit" class="btn btn-primary">Rechercher</i></button>
                        </div>
                    </div>
                </form>
            </div>

            <hr class="my-5">

            <div class="table-section">
                <h3 class="mb-4 text-center">Managers par Département</h3>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Département</th>
                                <th scope="col">Nom du Manager</th>
                                <th scope="col">Prénom du Manager</th>
                                <th scope="col">Nombre d'Employés</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($dep_m)) { ?>
                                <?php foreach( $dep_m as $ligne ){ ?>
                                    <tr>
                                        <td> <a href="modal.php?p=employee.php&nom=<?= urlencode($ligne['dept_no']);?>" class="text-primary text-decoration-none">
                                                <?= $ligne['dept_name']; ?>
                                            </a></td>
                                        <td><?= $ligne['first_name']; ?></td>
                                        <td><?= $ligne['last_name']; ?></td>
                                        <td><?= $ligne['compte'];?></td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="4" class="text-center">Aucun manager trouvé.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
    </main>