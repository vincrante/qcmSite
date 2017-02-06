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
 <link rel="stylesheet" type="text/css" href="Style.css"/>
</head>
<body>
    <div class="header">
        <ul>
            <li><a href="membre.php">Accueil</a></li>
            <li><a href="deconnexion.php">Déconnexion</a></li>
        </ul>        
    </div>
    <div class="presentation">
        <div class="description">
            Bienvenue <?php echo htmlentities(trim($_SESSION['login'])); ?> !
            <?php echo('Vous êtes un '.$_SESSION['role']);?><br/>
        </div>
    </div>
    <div class="content">
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
            elseif($_SESSION['role'] == "etudiant")
            {
                if(isset($_GET['nav'])){
                    switch ($_GET['nav']){
                        default :
                            include('pageEtudiant.php');


                    }
                }else{
                    include('pageEtudiant.php');
                }

            }
        ?>
    </div>
</body>
</html>