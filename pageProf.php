<?php
if($_SESSION['role'] == "prof"){
?>
<ul id="menu">
    <li>
        <a>Création</a>
        <ul id="sub_menu">
            <li><a href="membre.php?nav=creerqcm">Créer QCM</a></li>
            <li><a href="membre.php?nav=creerquest">Créer Question</a></li>
            <li><a href="membre.php?nav=listquest">liste des Question</a></li>
        </ul>
    </li>
</ul>
<?php
}
?>

