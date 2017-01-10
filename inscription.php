<?php
// on teste si le visiteur a soumis le formulaire
if (isset($_POST['inscription']) && $_POST['inscription'] == 'Inscription') {
	// on teste l'existence de nos variables. On teste également si elles ne sont pas vides
	if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['pass']) && !empty($_POST['pass'])) && (isset($_POST['pass_confirm']) && !empty($_POST['pass_confirm']))) {
		// on teste les deux mots de passe
		if ($_POST['pass'] != $_POST['pass_confirm']) {
			$erreur = 'Les 2 mots de passe sont différents.';
		}
		else {
			$base = mysql_connect ('localhost:3307', 'siteQcm', '$iutinfo');
			mysql_select_db ('siteQcm', $base);

			// on recherche si ce login est déjà utilisé par un autre membre
			$sql = 'SELECT count(*) FROM compte WHERE login="'.mysql_escape_string($_POST['login']).'"';
			$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
			$data = mysql_fetch_array($req);

			if ($data[0] == 0) {
				$sql = 'INSERT INTO compte (`id`, `login`, `mdp`, `nom`, `prenom`, `role`) 
						VALUES(NULL, "'.mysql_escape_string($_POST['login'])
							 .'", "'.mysql_escape_string(md5($_POST['pass']))
							 .'", "'.mysql_escape_string($_POST['nom'])
							 .'", "'.mysql_escape_string($_POST['prenom'])
							 .'","'.mysql_escape_string($_POST['role']).'")';

				mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

				session_start();
				$_SESSION['login'] = $_POST['login'];
				header('Location: membre.php');
				exit();
			}
			else {
				$erreur = 'Un membre possède déjà ce login.';
			
			}
		}
	}else
	{
		$erreur = 'Au moins un des champs est vide.';
	}
}
?>
<html>
<head>
<title>Inscription</title>
</head>

<body>
Inscription à l'espace membre :<br />
<form action="inscription.php" method="post">
Login : <input type="text" name="login" value="<?php if (isset($_POST['login'])) echo htmlentities(trim($_POST['login'])); ?>"><br />
Mot de passe : <input type="password" name="pass" value="<?php if (isset($_POST['pass'])) echo htmlentities(trim($_POST['pass'])); ?>"><br />
Confirmation du mot de passe : <input type="password" name="pass_confirm" value="<?php if (isset($_POST['pass_confirm'])) echo htmlentities(trim($_POST['pass_confirm'])); ?>"><br />
Nom : <input type="text" name="nom" value="<?php if (isset($_POST['nom'])) echo htmlentities(trim($_POST['nom'])); ?>"><br />
prenom : <input type="text" name="prenom" value="<?php if (isset($_POST['prenom'])) echo htmlentities(trim($_POST['prenom'])); ?>"><br />
role : <input type="text" name="role" value="<?php if (isset($_POST['role'])) echo htmlentities(trim($_POST['role'])); ?>"><br />

<input type="submit" name="inscription" value="Inscription">
</form>
<?php
if (isset($erreur)) echo '<br />',$erreur;
?>
</body>
</html>