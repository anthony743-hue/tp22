<?php
$dep = getDepartments();
$nom = isset($_GET['nom']) ? $_GET['nom'] : '';
$prenom = isset($_GET['prenom']) ? $_GET['prenom'] : '';
$info = getInfo_employee($nom, $prenom);
?>
<main class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white p-2">
                        <h4 class="mb-0">Formulaire de changement de departement</h4>
                    </div>
                    <div class="card-body">
                        <form action="traitement_change.php" method="post">
                            <!-- Champ Select -->
                            <div class="mb-3">
                               <label for="departementSelect" class="form-label">Département :</label>
                            <select name="departement" id="departementSelect" class="form-select">
                                <option value="Tous">Tous</option>
                                <?php foreach($dep as $row) { ?>
                                    <option value="<?= $row['dept_no']; ?>"><?= $row['dept_name']; ?></option>
                                <?php } ?>
                            </select>
                            </div>

                            <!-- Champ Date -->
                            <div class="mb-3">
                                <label for="dateNaissance" class="form-label">Date de naissance</label>
                                <input type="date" class="form-control" id="dateNaissance" name="dateNaissance" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Êtes-vous sûr de votre choix ?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="confirmation" id="confirmationOui" value="oui" required>
                                    <label class="form-check-label" for="confirmationOui">
                                        Oui, je suis sûr(e)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="confirmation" id="confirmationNon" value="non" required>
                                    <label class="form-check-label" for="confirmationNon">
                                        Non, je souhaite vérifier
                                    </label>
                                </div>
                            </div>

                            <!-- Boutons -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                 <a href="modal.php?p=fiche.php&nom=<?= $nom; ?>&prenom=<?= $prenom; ?>" class="btn btn-outline-secondary" role="button">Annuler</a>
                                <button type="submit" class="btn btn-primary">Valider</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</main>
