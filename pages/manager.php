<?php
$nom = isset($_GET['nom']) ? $_GET['nom'] : '';
$prenom = isset($_GET['prenom']) ? $_GET['prenom'] : '';
$dep = getDepartments();
$info = getInfo_employee($nom, $prenom);
$departmentName = getDepartmentName($info['dept_no']);
$manager = getManager($info['dept_no']);
?>
<main class="container py-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-4">
                <h1 class="display-6 text-primary">Manager Actuel :<?= $manager['first_name']; ?> <?= $manager['last_name']; ?></h1>
                <p class="lead text-muted">Prêt à prendre la relève ? Soumettez votre date de disponibilité.</p>
            </div>
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg border-0"> <div class="card-header card-header-custom">
                        <h4 class="mb-0">Candidature au Poste de Manager</h4>
                    </div>
                    <div class="card-body p-4"> 
                        <form action="traitement_manager.php" method="post">
                            <div class="mb-4"> <label for="dateDisponibilite" class="form-label">Date de Debut</label>
                                <input type="date" class="form-control form-control-lg" id="dateDisponibilite" required> <div class="form-text text-muted">
                                    Veuillez indiquer la date à partir de laquelle vous seriez disponible pour le poste.
                                </div>
                            </div>
                            <div class="d-grid gap-3 mt-4"> 
                                <button type="submit" class="btn btn-primary">Soumettre la Candidature</button> 
                                <a href="modal.php?p=fiche.php&nom=<?= $nom; ?>&prenom=<?= $prenom; ?>" class="btn btn-outline-secondary" role="button">Réinitialiser</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
