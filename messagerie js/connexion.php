<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre;charset=utf8', 'root', 'root');

if(isset($_POST['formconnexion'])) {
 $mailconnect = htmlspecialchars($_POST['mailconnect']);
 $mdpconnect = sha1($_POST['mdpconnect']);
 if(!empty($mailconnect) AND !empty($mdpconnect)) {
    $requser = $bdd->prepare("SELECT * FROM membres WHERE mail = ? AND motdepasse = ?");
    $requser->execute(array($mailconnect, $mdpconnect));
    $userexist = $requser->rowCount();
    if($userexist == 1) {
       $userinfo = $requser->fetch();
       $_SESSION['id'] = $userinfo['id'];
       $_SESSION['pseudo'] = $userinfo['pseudo'];
       $_SESSION['mail'] = $userinfo['mail'];
       $_SESSION['rang'] = $userinfo['rang'];
       header("Location: accueil.php?id=".$_SESSION['id']);
    } else {
       $erreur = "Mauvais mail ou mot de passe !";
    }
 } else {
    $erreur = "Tous les champs doivent être complétés !";
 }
}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <meta charset="utf-8">
    <title>UNKNOWN | Connexion</title>
    <link rel="icon" href="images/logoUK.png" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="js/heure.js">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 </head>
 <body>
      <div class="container">
        <h2>Connexion</h2>
        <br><br>
        <form method="POST">
          <div class="form-row">
            <div class="form-group col-md-10">
              <label for="inputEmail4">Email</label>
              <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="mailconnect" value="<?php if(isset($mail)) { echo $mail; } ?>">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-7">
              <label for="inputmdp">Mot de passe</label>
              <input type="password" class="form-control" id="inputmdp" placeholder="Mot de passe" name="mdpconnect" value="<?php if(isset($mdp)) { echo $mdp; } ?>">
            </div>
          </div>
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="gridCheck">
              <label class="form-check-label" for="gridCheck">
                Check me out
              </label>
            </div>
          </div>
          <button type="submit" name="formconnexion" class="btn btn-primary">Sign in</button>
          </form>
          <br>
          <p>Pas encore inscrit? <a href="inscription.php">inscrivez-vous</a></p>
      </div>
      <?php
      if(isset($erreur)) {
         echo '<font color="red">'.$erreur."</font>";
      }
      ?>
 </body>
</html>
