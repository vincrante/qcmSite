<?php
include('PDO.php');
if(isset($_POST['begin']))
{
    $reqQuest = $monPDO->prepare('SELECT * '
                          . 'FROM QUESTION as QU, ASSOQCMQUEST as A, QCM as QC '
                          . 'WHERE QU.idQuestion = A.idQuestion '
                          . 'AND A.idQcm = QC.idQcm '
                          . 'AND QC.nom ="'.$_POST["begin"].'"');
    $reqQuest->execute();
    $tabResQuest = $reqQuest->fetchAll();
    
    foreach($tabResQuest as $resQuest)
    {
?>
<table>
    <tr>
        <td>
            <?php echo($resQuest['question']); ?>
        </td>
        <td>
            <?php
                $reqRep = $monPDO->prepare('SELECT * '
                          . 'FROM QUESTION as Q, ASSOQUESTREPONSE as A, REPONSE as R '
                          . 'WHERE Q.idQuestion = A.idQuestion '
                          . 'AND A.idReponse = R.idReponse '
                          . 'AND Q.idQuestion ='.$resQuest['idQuestion']);
                $reqRep->execute();
                $tabResRep = $reqRep->fetchAll();
            ?>
            <form>
            <?php
            foreach($tabResRep as $resRep)
            {
                echo('<input type="checkbox" value="'.$resRep['reponse'].'"/>'.$resRep['reponse']);
                echo('<br/>');
            }
            ?>
            </form>
        </td>
    </tr>
</table>
<?php
    }
}
