<?php
if($_SESSION['role'] == "etudiant"){
    $req = $monPDO->prepare('SELECT * '
                          . 'FROM QCM as Q '
                          . 'WHERE Q.visible ="1"');
    $req->execute();
    $tabRes = $req->fetchAll();
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
                         <a href="membre.php?nav=frqcm&idQcm=<?php echo($res['idQcm']); ?>"><input type="button" id="button_pageEtudiant" value="Participer" /></a>
                         <a href="membre.php?nav=vrqcm&idQcm=<?php echo($res['idQcm']); ?>"><input type="button" id="button_pageEtudiant" value="Resultat" /></a>
                     </div>
                 </td>
             </tr>
         <?php
        }
     }
     ?>
    </table>
</fieldset>


