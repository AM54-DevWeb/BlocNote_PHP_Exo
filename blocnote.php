                        <!--FORMULAIRE-->
<form action="" method="post" class="blocnoteForm">
    <div class="blocnoteNote">
        <label class="blocnoteLabel">Note :</label>
        <textarea class="inputBlocnote" type="textarea" name="note" placeholder="Votre note" ></textarea>
    </div>

    <input class="inputFormSubmit" type="submit" class="inscriptionSubmit">
</form>
                        <!--FORMULAIRE-->



<?php 

    $login = $_SESSION["login"];

        //pseudo = "" de base + 'login' pour la bdd; donc pseudo = '"login"'
    $sql = " SELECT id FROM utilisateur WHERE pseudo = '" .$login. "' ";

    //connexion a la BDD
    $resultat = $connexion->query($sql);
    $id_utilisateur = $resultat-> fetch();

    if(isset($id_utilisateur)){
        $note = "";
        $id_utilisateur = $id_utilisateur["0"];

        if (isset($_POST['note'])) {
            $note = $_POST['note'];
        }

        $erreur = "";

        //si l'utilisateur a soumis le formulaire sans remplit les champs
        if($note==""){
            $erreur = "Le champ doit être rempli";
            echo $erreur;
        }else{
            $note = $_POST['note'];

            if ($erreur == ""){

            //on insere les données du formulaire dans la table 
            $connexion->query(" INSERT INTO `notes` (`contenu`,`id_utilisateur`) VALUES('$note','$id_utilisateur')");       
            }
        }
    }
?>

<div>
    <?php 
        $requete = $connexion->prepare("SELECT * FROM notes WHERE id_utilisateur =".$id_utilisateur);
        $requete->execute();

        $tabNotes = $requete->fetchAll();

        foreach($tabNotes as $notes){
            echo $notes["id"];
            echo $notes["contenu"];
            ?>
            <a href = "index.php?page=suppr_note&id=<?php echo $notes['id']; ?>">Supprimer la note</a>
            <?php
        };
    ?>
</div>