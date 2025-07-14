<?php
$nom = isset($_GET['nom']) ? $_GET['nom'] : '';
$prenom = isset($_GET['prenom']) ? $_GET['prenom'] : '';
$info = getInfo_employee($nom, $prenom);
$departmentName = getDepartmentName($info['dept_no']);
$manager = getManager($info['dept_no']);
?>
<main class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-12 text-center mb-4">
            <h1 class="text-primary">Manager Actuel : <?= htmlspecialchars($manager['first_name']); ?> <?= htmlspecialchars($manager['last_name']); ?></h1>
            <p class="text-muted">Prêt à prendre la relève ? Soumettez votre date de disponibilité.</p>
        </div>
        <div class="col-md-8 col-lg-6">
            <?php if(isset($_GET['error'])) { ?>
                <div class="alert alert-info text-center">
                    *Veuillez entrer une date valide*
                </div>
            <?php } ?>
            <div class="card shadow-lg"> 
                <div class="card-header p-2">
                    <h4 class="mb-0">Candidature au Poste de Manager</h4>
                </div>
                <div class="card-body p-4"> 
                    <form action="traitement_manager.php" method="post">
                        <input type="hidden" name="nom" value="<?= htmlspecialchars($nom); ?>">
                        <input type="hidden" name="prenom" value="<?= htmlspecialchars($prenom); ?>">
                        <div class="mb-4">
                            <label for="dateDisponibilite" class="form-label">Date de Debut</label>
                            <input type="date" name="date" class="form-control" id="dateDisponibilite" required>
                            <div class="form-text text-muted">
                                Veuillez indiquer la date à partir de laquelle vous seriez disponible.
                            </div>
                        </div>
                        <div class="d-grid gap-3 mt-4"> 
                            <button type="submit" class="btn btn-primary">Soumettre la Candidature</button> 
                            <a href="modal.php?p=fiche.php&nom=<?= htmlspecialchars($nom); ?>&prenom=<?= htmlspecialchars($prenom); ?>" class="btn btn-outline-secondary">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>