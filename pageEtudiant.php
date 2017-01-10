<?php
    $req = $monPDO->prepare('SELECT * '
                          . 'FROM QCM as Q '
                          . 'WHERE Q.visible ="1"');
    $req->execute();
    $tabRes = $req->fetchAll();
?>
<table>
   <?php
   foreach($tabRes as $res)
   {
   ?>
    <tr>
        <td>
            <?php echo($res['nom']); ?>
        </td>
        <td>
            <?php echo('Date de fin : '.$res['dateFin']); ?>
        </td>
        <td>
            <form method="POST" action='PageQCM.php'>
                <button type="submit" name="begin" value="<?php echo($res['nom']); ?>">Participer</button>
                <button type="submit" name="result" value="<?php echo($res['nom']); ?>">Resultat</button>
            </form>
        </td>
    </tr>
   <?php
   }
   ?>    
</table>

