<?php
ini_set("display_errors",1);
session_start();
include("../inc/fonction.php");
init_view();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
 <header >
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="#">
                    Entreprise 22
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="modal.php?p=home.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="modal.php?p=details.php">Gestion des Emplois</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <?php
        include("./".$_GET['p']);
    ?>
     <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</html>