<?php
    include('PDO.php');
// on teste si le visiteur a soumis le formulaire de connexion
if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion') 
{
	if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['pass']) && !empty($_POST['pass']))) 
        {
	// on teste si une entrée de la base contient ce couple login / password
        
        $data = $monPDO->prepare('SELECT count(*) '
                               . 'FROM compte '
                               . 'WHERE login="'.$_POST['login'].'" '
                               . 'AND mdp="'.md5($_POST['pass']).'"');
        $data->execute();       
        $res = $data->fetch();
	// si on obtient une réponse, alors l'utilisateur est un membre
	if ($res[0] == 1) {
                $sql = $monPDO->prepare('SELECT idCompte, role '
                                      . 'FROM compte '
                                      . 'WHERE login="'.$_POST['login'].'"');
                $sql->execute();
                $role = $sql->fetch();
		session_start();
                $_SESSION['id'] = $role[0];
                $_SESSION['role'] = $role[1];
		$_SESSION['login'] = $_POST['login'];
		header('Location: membre.php');
		exit();
	}
	// si on ne trouve aucune réponse, le visiteur s'est trompé soit dans son login, soit dans son mot de passe
	elseif ($res[0] == 0) {
		$erreur = 'Compte non reconnu.';
	}
	// sinon, alors la, il y a un gros problème :)
	else {
		$erreur = 'Problème dans la base de données : plusieurs membres ont les mêmes identifiants de connexion.';
	}
	}
	else {
	$erreur = 'Au moins un des champs est vide.';
	}
}elseif(isset($_SESSION['id'])){
    header('Location: membre.php');
    exit();
}
?>
<html>
<head>
<title>Accueil</title>
<link rel="stylesheet" type="text/css" href="Style.css"/>
</head>
<body>
    <div class="connection">
        <form action="index.php" method="post">
            <div class="input_login">
                <fieldset>
                    <legend>Connexion à l'espace membre :</legend>
                    <br/>
                    <label for='login'>Utilisateur :</label> <input type="text" id="login" name="login" value="<?php if (isset($_POST['login'])) echo htmlentities(trim($_POST['login'])); ?>"><br />
                    <br/>
                    <label for='password'>Mot de passe :</label> <input type="password" id="password" name="pass" value="<?php if (isset($_POST['pass'])) echo htmlentities(trim($_POST['pass'])); ?>"><br />
                    <input type="submit" id="connexion" name="connexion" value="Connexion" class="button">
                </fieldset>
            </div>
        </form>
    </div>
<?php
if (isset($erreur)) echo '<br /><br />',$erreur;
?>
</body>
</html>