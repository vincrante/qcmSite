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
<a href="membre.php"><h2>Acceuil</h2></a><br/>
<a href="deconnexion.php">Déconnexion</a><br/>
Bienvenue <?php echo htmlentities(trim($_SESSION['login'])); ?> !<br />
<?php echo('Vous êtes un '.$_SESSION['role']);?><br/>
<?php 
    if($_SESSION['role'] == "prof"){
        if(isset($_GET['nav'])){
            switch ($_GET['nav']){
                case 'creerqcm':
                    include ('creerQcm.php');
                    break;
                case 'creerquest':
                    include ('question.php');
                    break;
                case 'modifquest':
                    include ('modifierQuestion.php');
                    break;
                case 'listquest':
                    include ('listQuestion.php');
                    break;
                case 'mesqcm':
                    include ('mesQcm.php');
                    break;
                default:
                    include('pageProf.php');
            }
        }else{
            include('pageProf.php');
        }

    }
    elseif($_SESSION['role'] == "Etudiant")
    {
        if(isset($_GET['nav'])){
            switch ($_GET['nav']){
                case 'qcm':
                    include ('pageQcm.php');
                    break;
                case 'creerquest':
                    include ('question.php');
                    break;
                case 'modifquest':
                    include ('modifierQuestion.php');
                    break;

            }
        }else{
            include('pageEtudiant.php');
        }

    }
?>

</body>
</html>