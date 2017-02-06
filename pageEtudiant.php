<?php
if($_SESSION['role'] == "etudiant"){
    $req = $monPDO->prepare('SELECT * '
                          . 'FROM QCM as Q '
                          . 'WHERE Q.visible ="1"');
    $req->execute();
    $tabRes = $req->fetchAll();
?>

<div class="pageEtudiant">
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
                     <td>
                        <?php echo($res['nom']); ?>
                     </td>
                     <td>
                        <?php echo($res['dateFin']); ?>
                     </td>
                     <td>
                         <div class="action">
                             <a href="membre.php?nav=frqcm&idQcm=<?php echo($res['idQcm']); ?>">Participer</a>
                             <a href="membre.php?nav=vrqcm&idQcm=<?php echo($res['idQcm']); ?>">Resultat</a>
                         </div>
                     </td>
                 </tr>
             <?php
            }
         }
         ?>
        </table>
    </fieldset>
</div>


