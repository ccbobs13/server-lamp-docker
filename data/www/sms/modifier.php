<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier</title>
    <link rel="stylesheet" href="style.css">
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
    <?php

    //connexion à la base de donnée
    require_once "database/conn_db.php";
    
    //on récupère le id et le type dans le lien
    $id = $_GET['id'];
    $type = $_GET['type'];

    //requête pour afficher les infos d'un utilisateur

    $sql_part = "select * from $type where id=$id";

    //Exécution
    $query_part = $pdo->query($sql_part);
    $part = $query_part->fetch(PDO::FETCH_UNIQUE);
    extract($part);

    //vérifier que le bouton ajouter a bien été cliqué
    if (isset($_POST['valider'])) {

        //extraction des informations envoyées dans des variables par la methode POST
        extract($_POST);

        //verifier que tous les champs ont été remplis
        if ($nom && $prenom && $adresse && $telephone && $classe) {

            //requête de modification
            $req = "UPDATE $type SET nom = '$nom' , prenom = '$prenom' , adresse = '$adresse', telephone = '$telephone', classe = '$classe' WHERE id = $id";
            $query = $pdo->query($req);

            if ($query->execute()) { 
                //si la requête a été effectuée avec succès , on fait une redirection
                ob_start();
                header("location: {$type}view.php");
                ob_end_flush();
            } else { 
                //si non
                $message = "Utilisateur non modifié";
            }
        } else {
            //si non
            $message = "Veuillez remplir tous les champs !";
        }
    }

    ?>

    <div class="form" style="width: 50%;margin: 0 auto;">
        <h2>Modifier l'utilisateur : <?= $nom ?> </h2>
        <p class="erreur_message">
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
        </p>
        <form method="POST" action="">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" required value="<?= $nom ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="prenom">Prenom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" required value="<?= $prenom ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="adresse">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" required value="<?= $adresse ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="telephone">Telephone</label>
                            <input type="text" class="form-control" id="telephone" name="telephone" required value="<?= $telephone ?>">
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
                                    <option <?php if ($classe == "M-ISI") echo 'selected="selected"'; ?>>M-ISI</option>
                                    <option <?php if ($classe == "M-SSI") echo 'selected="selected"'; ?>>M-SSI</option>
                                    <option <?php if ($classe == "INGC") echo 'selected="selected"'; ?>>INGC</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <a type="button" class="btn btn-danger" href="<?= $type ?>view.php">Annuler</a>
                        <button name="valider" type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</body>

</html>