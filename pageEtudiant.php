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
            <form>
                <input type="button" name="participer" value="begin">
                <input type="button" name="resultat" value="result">
            </form>
        </td>
    </tr>
   <?php
   }
   ?>    
</table>

