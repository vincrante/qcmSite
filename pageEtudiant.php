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
                            <form method="POST" action='PageQCM.php'>
                                <button type="submit" name="begin" value="<?php echo($res['nom']); ?>">Participer</button>
                                <button type="submit" name="result" value="<?php echo($res['nom']); ?>">Resultat</button>
                            </form> 
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


