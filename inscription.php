<?php 

$login = "";
$password = ""; 
$confirm_password = "";
$mailto = "";


if (isset($_POST['login'])) {
    $login = $_POST['login'];
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
}
if (isset($_POST['confirm_password'])) {
    $confirm_password = $_POST['confirm_password'];
}

if (isset($_POST['mailto'])) {
    $mailto = $_POST['mailto'];
}


$erreur = "";

//si l'utilisateur a soumis le formulaire sans remplir les champs
if(isset($_POST['login']) && $login =="" && $password =="" && $confirm_password =="" && $mailto == ""){
    $erreur = "Les champs doivent être remplis";
}else{
    //si l'utilisateur a remplis au moins un des champs
    if ($login != "" || $password != "" || $confirm_password != ""){

        if($login==""){
            $erreur = "le champs 'login' est obligatoire";
        }else if($password == ""){
            $erreur = "le champs 'mot de passe' est obligatoire";
        }else if($confirm_password==""){
            $erreur = "le champs 'confirmer le mot de passe' est obligatoire";
        }
        //sinon si la taille du login est inférieur a 4 caractéres
        else if(strlen($login) < 4){
            $erreur = "Le login doit avoir au moins 4 caractéres";
        }else if(strlen($password) < 8){
            $erreur = "Le mot de passe doit avoir au moins 8 caractéres";
        }else if(strtolower($password) == $password){
            $erreur = "Le mot de passe doit contenir au moins une majuscule";
        }else if(strtoupper($password) == $password){
            $erreur = "Le mot de passe doit contenir au moins une minuscule";
        }else if($password != $confirm_password){
            $erreur = "Les 2 mots de passes ne sont pas identiques";
        }

        if ($erreur == ""){

            //on prépare la requete sql
            $sql=" INSERT INTO `utilisateur` (`pseudo`, `mot_de_passe`,`mailto`)
            VALUES('$login','$password','$mailto')";

            //on insere les données du formulaire dans la table 
            $connexion->query($sql);       
            }      
    }   
}

echo $erreur;

?>

<form action="" method="post" class="inscriptionForm">
    <div class="inscriptionLogin">
        <label class="inscriptionLabel">Login :</label>
        <input class="inputForm" type="text" name="login" placeholder="Votre login" >
    </div>

    <div class="inscriptionMDP">
        <label class="inscriptionLabel">Mot de passe :</label>
        <input class="inputForm" type="password" name="password" placeholder="Votre mot de passe">
    </div>

    <div>
        <label class="inscriptionLabel">Confirmer le mot de passe :</label>
        <input class="inputForm" type="password" name="confirm_password" placeholder="Confirmez votre mot de passe">
    </div>

    <div>
        <label class="inscriptionLabel">E-Mail :</label>
        <input class="inputForm" type="email" name="mailto" placeholder="mail@votremail.fr">
    </div>

    <input class="inputFormSubmit" type="submit" class="inscriptionSubmit">
</form>