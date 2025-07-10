<?php
$dep = $_SESSION['departement'];
$name = $_SESSION['nom'];
$min = $_SESSION['min'];
$max = $_SESSION['max'];
$_SESSION['size'] = ($dep == "Tous" ) ? count_resultat($name, $min, $max) : count_result($dep, $name, $min, $max);
$size = $_SESSION['size'];
if( !isset($_SESSION['compteur']) ){
    $_SESSION['compteur'] = 0;
}
$cmp = $_SESSION['compteur'];
$emp = ($dep == "Tous" ) ? getRelate_Employees($name, $min, $max, $cmp) : getRelative_Employees($dep, $name, $min, $max, $cmp);
$resultsToDisplay = $emp;
?>
<main class="container py-4">
    <h1 class="mb-4 text-center">Résultats de Recherche d'Employés</h1>
    
    <div style="overflow-y: scroll; height: 380px;">
        <?php if (!empty($resultsToDisplay)) { ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom Complet</th>
                            <th scope="col">Informations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 0; foreach ($resultsToDisplay as $employee) { $count++; ?>
                            <tr>
                                <td><?= $count; ?></td>
                                <td>
                                    <?= htmlspecialchars($employee['first_name']); ?> <?= htmlspecialchars($employee['last_name']); ?>
                                </td>
                                <td>
                                    <a href="modal.php?p=fiche.php&nom=<?= urlencode($employee['first_name']); ?>&prenom=<?= urlencode($employee['last_name']); ?>" class="btn btn-outline-primary btn-sm">
                                        Voir plus
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div class="alert alert-warning text-center" role="alert">
                Aucun employé trouvé correspondant a vos critères de recherche.
            </div>
        <?php } ?>
    </div>
    
    <div class="d-flex justify-content-evenly mt-4">
        <?php if( $cmp > 0 ){ ?>                    
            <a href="traitement_next.php?id=-1" class="btn btn-secondary btn-lg">Precedent</a>
        <?php } ?>
        <?php if( $cmp + 20 < $size ){ ?> 
            <a href="traitement_next.php?id=1" class="btn btn-secondary btn-lg">Suivant</a>
        <?php } ?>
        <a href="modal.php?p=home.php" class="btn btn-secondary btn-lg">Retour à la recherche</a>
    </div>
</main>