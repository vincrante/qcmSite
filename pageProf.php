<?php
if($_SESSION['role'] == "prof"){
?>
<ul id="menu">
    <li>
        <a>Création</a>
        <ul id="sub_menu">
            <li><a href="creerQcm.php">Créer QCM</a></li>
            <li><a href="question.php">Créer Question</a></li>
            <li><a href="modifierQuestion.php">Modifier Question</a></li>
        </ul>
    </li>
</ul>
<?php
}
?>

