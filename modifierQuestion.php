<?php
include('PDO.php');

if(isset($_POST['modifQuestionValider']) && $_POST['modifQuestionValider']=='valider' ){

    for($i =1; $i<=$_POST['index'];$i++){

        $check = 0;
        if(isset($_POST["check".$i])){
            $check = 1;
        }

        $data = $monPDO->prepare('UPDATE reponse
                                  SET juste ="'.$check.'",feedback ="'.$_POST["feedback".$i].'", reponse="'.$_POST["reponse".$i].'"
                                  WHERE idReponse ="'.$_POST["idR".$i].'"');
        $data->execute();
    }
    $data = $monPDO->prepare('UPDATE question
                                      SET question ="'.$_POST["question"].'",theme ="'.$_POST["theme"].'"
                                      WHERE idReponse ="'.$_POST["idQ"].'"');
    $data->execute();
    header('Location: membre.php?nav=modifquest&modifQuestion='.$_POST["idQ"]);
    exit();

}else{
$data = $monPDO->prepare('SELECT *
                              FROM question q, reponse r
                              WHERE r.idQuestion = q.idQuestion
                              AND q.idQuestion = "'. $_GET['modifQuestion'] .'"');
$data->execute();
$row = $data->fetch();

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<html>
    <head>
        <title>Question</title>
    </head>

    <body>
        <fieldset>
            <legend>Modifier question</legend>
            <div id="retourListe"><a href="membre.php?nav=listquest"><input type="button" value="Liste des Questions"/></a><br/><br/></div>
            <form action=""membre.php?nav=modifquest&modifQuestion=<?php echo $_GET['modifQuestion']?>" method="post">
                question : <input type="text" name="question" value="<?php echo $row[1] ?>"><br/>
                Theme : <input type="text" name="theme" value="<?php echo $row[2] ?>"><br/><br/>
                <table id="reponse">
                    <tr>Réponse</tr>
                    <?php
                    $index = 1;
                    $idQuest = $row[0];
                    do {
                        $quest ="<tr><td>Réponse" . $index . "  : <input type='text' name = 'reponse" . $index . "' value='" . $row[5] . "'></td><td>Vrai ? : <input type='checkbox' name='check" . $index . "'";
                        if ($row[6] == 1) {
                            $quest = $quest." checked ";
                        }
                        $quest = $quest."></td><td>FeedBack : <input type='text' name='feedback" . $index . "' value='" . $row[7] . "'></td><input name ='idR".$index."' type='hidden' value='". $row[3]."'/></tr>";
                        echo $quest;
                        $index++;
                    } while ($row = $data->fetch());

                    ?>
                </table>
                <br/>
            <input name ="index" id="index" type="hidden" value="<?php echo $index-1 ?>"/>
            <input name ="idQ" id="idQ" type="hidden" value="<?php echo $idQuest ?>"/>
            <input type="submit"  name="modifQuestionValider" value="valider">
        </form>
        </fieldset>
        
    </body>
</html>
<?php
}



?>