<?php include 'HeaderView.php';
    
    //Ajout du fichier de connexion a la base de donnees
    require_once 'database/conn_db.php';

    //Requete de selectionn des etudiants et des enseignants
    $sql_ens = "select * from enseignant";
    $sql_etu = "select * from etudiant";

    $query_ens = $pdo->query($sql_ens);
    $query_etu = $pdo->query($sql_etu);

    //Recuperation du nombre des etudiants et des enseignants
    $count_ens = $query_ens->rowCount();
    $count_etu = $query_etu->rowCount();

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h1 class="display-4">Bienvenue sur School Management System</h1>
                <p class="lead">Ce système de gestion de scolarité permet de gérer les données de votre établissement.</p>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <div class="card">
                <div class="card-header">
                    <h3>
                        <span style="color: #ccc;"><i class="fa-solid fa-person-chalkboard"></i></span>
                        Enseignants
                    </h3>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Vos enseignants</h5>
                    <p class="card-text"><?= $count_ens ?></p>
                    <a href="enseignantview.php" class="btn btn-primary">Enseignants</a>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="card">
                <div class="card-header">
                    <h3>
                        <span style="color: #ccc;"><i class="fa-solid fa-users"></i></span>
                        Etudiants
                    </h3>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Vos etudiants</h5>
                    <p class="card-text"><?= $count_etu ?></p>
                    <a href='etudiantview.php' class="btn btn-primary">Etudiants</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <hr class="my-4">
        <p>Vous pouvez ajouter, modifier, supprimer des données de votre établissement.</p>
        <p class="lead">
            <a class="btn btn-primary btn-sm" href="#" role="button">En savoir plus</a>
        </p>
    </div>
</div>

<?php include 'FooterView.php'; ?>