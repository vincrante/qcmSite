<?php
include('PDO.php');
if (isset($_POST['insertQuestion']) && $_POST['insertQuestion'] == 'valider')
{


    $data = $monPDO->prepare('INSERT INTO question (`question`,`theme`) 
                              VALUES ("'.$_POST['question'].'","'.$_POST['theme'].'")');
    $data->execute();
    $lastQuest = $monPDO->lastInsertId();
    $index = $_POST['index'];
    $reponse = 'INSERT INTO reponse (idQuestion,reponse,juste,feedBack) VALUES ';
    for ($i = 1; $i < $index ; $i++){
        $bool = "0";
        if(isset($_POST['check'.$i])){
            $bool =  "1";
        }

        $reponse = $reponse.'("'.$lastQuest.'","'.$_POST['reponse'.$i].'","'.$bool.'","'.$_POST['feedback'.$i].'"),';
    }
    $bool = "0";
    if(isset($_POST['check'.$index])){
        $bool = "1";
    }

    $reponse = $reponse.'("'.$lastQuest.'","'.$_POST['reponse'.$index].'","'.$bool.'","'.$_POST['feedback'.$index].'")';
    $dataReponse = $monPDO->prepare($reponse);
    $dataReponse->execute();


    echo "<br/>Question enregistré<br/>";
}
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 10/01/17
 * Time: 10:41
 */


?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>



<h1> Creation de Question</h1>
<form action="membre.php?nav=creerquest" method="post">
    question : <input type="text" name="question" value="<?php if (isset($_POST['question'])) echo htmlentities(trim($_POST['question'])); ?>"><br />
    Theme : <input type="text" name="theme" value="<?php if (isset($_POST['theme'])) echo htmlentities(trim($_POST['theme'])); ?>"><br />

    <table id="reponse">
       <tr>Réponse</tr>
        <tr>
            <td>Réponse 1 : <input type="text" name = "reponse1"></td>
            <td>Vrai ? : <input type="checkbox" name="check1"></td>
            <td>FeedBack : <input type="text" name="feedback1" value="<?php if (isset($_POST['feedBack'])) echo htmlentities(trim($_POST['feedBack'])); ?>"></td>
        </tr>
        <tr>
            <td>Réponse 2 : <input type="text" name = "reponse2"></td>
            <td>Vrai ? : <input type="checkbox" name="check2"></td>
            <td>FeedBack : <input type="text" name="feedback2" value="<?php if (isset($_POST['feedBack'])) echo htmlentities(trim($_POST['feedBack'])); ?>"></td>
        </tr>

    </table>
        <input name ="index" id="index" type="hidden" value="2"/>
    <div id="more">Ajouter une reponse</div>
    <div id="less">Supprimer une reponse</div>
    <input type="submit"  name="insertQuestion" value="valider">
</form>
<script src="ScriptQuestion.js"></script>