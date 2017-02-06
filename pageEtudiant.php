<?php
if($_SESSION['role'] == "etudiant"){
    $req = $monPDO->prepare('SELECT * '
                          . 'FROM QCM as Q '
                          . 'WHERE Q.visible ="1"');
    $req->execute();
    $tabRes = $req->fetchAll();

    $resultat = $monPDO->prepare('SELECT DISTINCT idQcm '
        . 'FROM resultat '
        . 'WHERE idCompte='.$_SESSION['id']);
    $resultat->execute();

    $tableQcm = $resultat->fetchAll(PDO::FETCH_COLUMN, 0);
?>


<fieldset>
    <legend>Liste des QCM</legend>
    <table>
        <tr>
            <th>
                Nom
            </th>
            <th>
                Date de fin
            </th>
            <th>
                Action
            </th>
        </tr>
        <?php
            foreach($tabRes as $res)
            {
                    ?>

                     <tr>
                         <td id="pageEtudiant">
                            <?php echo($res['nom']); ?>
                         </td>
                         <td id="pageEtudiant">
                            <?php echo($res['dateFin']); ?>
                         </td>
                         <td id="pageEtudiant">
                             <div class="action">
                                 <?php
                                 if(date("Y-m-d") <= $res['dateFin']) {
                                    if( in_array($res['idQcm'],$tableQcm)) {
                                        echo "<a href='membre.php?nav=vrqcm&idQcm=" . $res['idQcm'] . "'>Resultat</a>";
                                    }
                                    else{
                                        echo "<a href='membre.php?nav=frqcm&idQcm=" . $res['idQcm'] . "'>Participer</a>";
                                    }
                                 }else{
                                      echo "QCM expirée";
                                 }

                                 ?>
                             </div>
                         </td>
                     </tr>
                 <?php
            }
     }
     ?>
    </table>
</fieldset>


