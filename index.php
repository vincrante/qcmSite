<?php
    include('PDO.php');
// on teste si le visiteur a soumis le formulaire de connexion
if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion') 
{
	if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['pass']) && !empty($_POST['pass']))) 
        {
	// on teste si une entrée de la base contient ce couple login / password
        
        $data = $monPDO->prepare('SELECT count(*) FROM compte WHERE login="'.mysqli_escape_string($base,$_POST['login']).'" AND mdp="'.mysqli_escape_string($base,md5($_POST['pass'])).'"');
        $data->execute();       
        $res = $data->fetch();
        var_dump($res);
	// si on obtient une réponse, alors l'utilisateur est un membre
	if ($res[0] == 1) {
		session_start();
		$_SESSION['login'] = $_POST['login'];
                //$_SESSION['role'] = 
		header('Location: membre.php');
		exit();
	}
	// si on ne trouve aucune réponse, le visiteur s'est trompé soit dans son login, soit dans son mot de passe
	elseif ($res[0] == 0) {
		$erreur = 'Compte non reconnu.';
	}
	// sinon, alors la, il y a un gros problème :)
	else {
		$erreur = 'Probème dans la base de données : plusieurs membres ont les mêmes identifiants de connexion.';
	}
	}
	else {
	$erreur = 'Au moins un des champs est vide.';
	}
}
?>
<html>
<head>
<title>Accueil</title>
</head>

<body>
Connexion à l'espace membre :<br />
<form action="index.php" method="post">
Login : <input type="text" name="login" value="<?php if (isset($_POST['login'])) echo htmlentities(trim($_POST['login'])); ?>"><br />
Mot de passe : <input type="password" name="pass" value="<?php if (isset($_POST['pass'])) echo htmlentities(trim($_POST['pass'])); ?>"><br />
<input type="submit" name="connexion" value="Connexion">
</form>
<a href="inscription.php">Vous inscrire</a>
<?php
if (isset($erreur)) echo '<br /><br />',$erreur;
?>
</body>
</html>