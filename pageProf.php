<?php
if($_SESSION['role'] == "prof"){
?>
<ul id="menu">
    <li>
        <a href="#">Création</a>
        <ul id="sub_menu">
            <li><a href="#">Créer QCM</a></li>
            <li><a href="#">Créer Question</a></li>
        </ul>
    </li>
    <li>
        <a href="#">Modification</a>
        <ul id="sub_menu">
            <li><a href="#">Modifier QCM</a></li>
            <li><a href="#">Modifier Question</a></li>
        </ul>
    </li>
</ul>
<?php
}
?>

