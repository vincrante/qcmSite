<?php
include('PDO.php');


if (isset($_POST['creerQcm']) && $_POST['creerQcm'] == 'valider' && isset($_SESSION[id]))
{
    $id = $_SESSION[id];
    $check = 0;
    if(isset($_POST["visible"])){
        $check = 1;
    }

    echo 'INSERT INTO qcm (idcrea,dateFin,dateCrea,visible,nom) 
                              VALUES ("'.$id.'","'.$_POST['dateF'].'","'.date("Y-m-d").'","'.$check.'","'.$_POST['nom'].'")';
    echo "<br/>";
    $data = $monPDO->prepare('INSERT INTO qcm (idcrea,dateFin,dateCrea,visible,nom) 
                              VALUES ("'.$id.'","'.$_POST['dateF'].'","'.date("Y-m-d").'","'.$check.'","'.$_POST['nom'].'")');
    $data->execute();
    $lastQcm = $monPDO->lastInsertId();
    $index = $_POST['index'];
    $qcm = 'INSERT INTO assoqcmquest (idQcm,idQuestion)VALUES ';
    for ($i = 1; $i < $index ; $i++){

        $qcm = $qcm.'("'.$lastQcm.'","'.$_POST['idQuest'.$i].'"),';
    }
    $qcm = $qcm.'("'.$lastQcm.'","'.$_POST['idQuest'.$index].'")';
    echo $qcm;
    $dataQCM = $monPDO->prepare($qcm);
    $dataQCM->execute();
    header('location: membre.php?nav=mesqcm');
}
?>
<html>
    <head>
        <title>QCM</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    </head>
    <body>
        <fieldset>
            <legend> Creation de QCM</legend>
            <form action="membre.php?nav=creerqcm" method="post">
                <table>
                    <tr>
                        <td>Nom du QCM :</td><td> <input type="text" id="texte" name="nom"/></td>
                    </tr>
                    <tr>
                        <td>Date Limite</td><td> <input type="date" id="texte" name="dateF" min="<?php echo date("Y-m-d")?>"/></td>
                    </tr>
                    <tr>
                        <td>Visible</td><td> <input type="checkbox" name="visible"/></td>
                    </tr>
                    <tr>
                        <td>Ajouter Question :</td>
                    </tr>
                    <tr><td id="creationQCM">
                        <select id="choix">
                            <?php
                                $resQues = $monPDO->prepare('SELECT * FROM question');
                                $resQues->execute();
                                $index=0;
                                while($data = $resQues->fetch()) {
                                    echo "<option value='".$data[0]."'>".$data[1]."</option>\n";
                                }
                            ?>
                        </select></td>
                        <td id="ajouter"><input type="button" id="buttonAjoutQuestion" value="ajouter"/></td>
                    </tr>

                </table>
                <table id="question">

                </table>
                <input type="hidden" id="index" name="index" value="0">
                <input type="submit" id="button_ValiderFormulaire" name="creerQcm" value="valider">
            </form>
        </fieldset>
    </body>
    <script src="creerQcm.js"></script>
</html>
