<?php
include('PDO.php');
session_start();
if (!isset($_SESSION['login'])) {
	header ('Location: index.php');
	exit();
}
?>

<html>
<head>
<title>Espace membre</title>
</head>

<body>
Bienvenue <?php echo htmlentities(trim($_SESSION['login'])); ?> !<br />
<?php echo('Vous êtes un '.$_SESSION['role']);?><br/>
<?php 
    if($_SESSION['role'] == "prof"){
        include('pageProf.php');
    }
    else
    {
        include('pageEtudiant.php');
    }
?>
<br/>
<a href="deconnexion.php">Déconnexion</a>
</body>
</html>