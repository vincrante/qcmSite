<?php
if($_SESSION['role'] == "prof"){
?>
<div class="pageProf">
    <fieldset>
        <legend>Création</legend>
        <div class="upper">
            <a href="membre.php?nav=creerqcm"><input id="button_pageProf" type="button" value="Créer QCM"/></a>
            <a href="membre.php?nav=creerquest"><input id="button_pageProf" type="button" value="Créer Question"/></a>
        </div>
        <div class="lower">
            <a href="membre.php?nav=listquest"><input id="button_pageProf" type="button" value="Liste des questions"/></a>
            <a href="membre.php?nav=mesqcm"><input id="button_pageProf" type="button" value="Mes QCM"/></a>   
        </div>        
    </fieldset>
</div>
<?php
}
?>

