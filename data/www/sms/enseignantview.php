<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <!-- FontAwesome 6.1.1 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- (Optional) Use CSS or JS implementation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>

    <?php include 'HeaderView.php'; ?>
    <?php

    ?>
    <?php
    //Appel du fichier de connexion a la base de donnees
    require_once('database/conn_db.php');

    //Définition de la requête d'insertion
    $sql_ajout = "insert into enseignant values(null,:nom,
        :prenom,:adresse,:telephone,:classe)";
    //Préparation de la requête
    $rp = $pdo->prepare($sql_ajout);

    if (isset($_POST['valider'])) {

        //Verfication des champs
        if (
            isset($_POST['nom']) &&
            isset($_POST['prenom']) &&
            isset($_POST['adresse']) &&
            isset($_POST['telephone']) &&
            isset($_POST['classe'])

        ) {
            //Association marqueur-valeur
            $rp->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
            $rp->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
            $rp->bindParam(':adresse', $_POST['adresse'], PDO::PARAM_STR);
            $rp->bindParam(':telephone', $_POST['telephone'], PDO::PARAM_STR);
            $rp->bindParam(':classe', $_POST['classe'], PDO::PARAM_STR);

            //Exécution de la requête
            if ($rp->execute()) {
                // Definition du message et de la couleur a afficher en fonction de la réussite ou non de l'insertion
                $message = "Enseignant ajouté";
                $color = "alert-success";
            } else {
                $message = "Enseignant non ajouté";
                $color = "alert-danger";
            }
        } else {
            $message = "Veuillez remplir tous les champs";
            $color = "alert-danger";
        }
    }
    ?>
    <!-- Affichage du message de réussite ou d'échec de l'insertion -->
    <div class="container" style="margin-top: 10px; width: 300px; height: 30px;">
        <div>
            <?php
            if (isset($message) && isset($color)) {
                echo "<div class='alert " . $color . "'  alert-dismissible fade show' role='alert'>";
                echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Fermer'></button>" . $message . "
                    </div>";
            }
            ?>
        </div>
    </div>
    <div class="container" style="margin-top: 10px;">
        <!-- Bouton permettant d'ouvrir la boite de dialogue -->
        <button style="margin: 10;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modelId">
            <span><i class="fa-solid fa-circle-plus"></i></span>
            Creer
        </button>

        <!-- Boite de dialogue de creation-->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="POST" action="">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Creation d'un enseignant</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nom">Nom</label>
                                            <input type="text" class="form-control" id="nom" name="nom" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="prenom">Prenom</label>
                                            <input type="text" class="form-control" id="prenom" name="prenom" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="adresse">Adresse</label>
                                            <input type="text" class="form-control" id="adresse" name="adresse" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="telephone">Telephone</label>
                                            <input type="text" class="form-control" id="telephone" name="telephone" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label for="classe" class="form-label">Classe</label>
                                                <select class="form-control" name="classe" id="classe" required>
                                                    <option value="">Sélectionner une classe</option>
                                                    <option>M-ISI</option>
                                                    <option>M-SSI</option>
                                                    <option>INGC</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                <button name="valider" type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>

                </form>
            </div>
        </div>

    </div>
    </div>
    </div>
    <div class="container" style="margin-top: 10;">
        <table class="table table-striped table-hover table-responsive caption-top">
            <caption>Liste des enseignants</caption>
            <thead class="table-light">
                <tr>
                    <th scope="row">#</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Adresse</th>
                    <th>Telephone</th>
                    <th>Classe</th>
                    <th class="ml-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //inclure la page de connexion a la base de donnees
                include_once "database/conn_db.php";
                //Définition de la requête de sélection
                $sql_part = "select * from enseignant";
                //Exécution
                $query_part = $pdo->query($sql_part);
                $count = $query_part->rowCount();
                if ($count == 0) {
                    echo "<tr><td colspan='7' class='text-center bg-danger' style='color: #fff;'>Aucun enseignant</td></tr>";
                } else {
                     //Tant qu'on extrait des lignes sous forme de tableau associatif
                    while ($part = $query_part->fetch(PDO::FETCH_ASSOC)) {
                        extract($part); {
                ?>
                            <tr>
                                <td id="id_element"><?= $id ?></td>
                                <td><?= $nom ?></td>
                                <td><?= $prenom ?></td>
                                <td><?= $adresse ?></td>
                                <td><?= $telephone ?></td>
                                <td><?= $classe ?></td>
                                <td scope="col">
                                    <a role="button" class="btn btn-primary btn-sm" href="modifier.php?type=enseignant&id=<?= $id ?>">
                                        <span><i class="fa-solid fa-edit"></i></span>
                                        Modifier
                                    </a>
                                    <a id="supprimer" class="btn btn-danger btn-sm" onclick="return confirm('Voulez vous supprimer <?= $nom ?> ?\nOui ou Non?')" href="supprimer.php?type=enseignant&id=<?= $id ?>" role="button">
                                        <span><i class="fa-solid fa-trash"></i></span>
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                <?php
                        }
                    }
                }
                ?>
            </tbody>
        </table>

    </div>

    </div>
    </div>
    <?php include 'FooterView.php'; ?>

</body>

</html>