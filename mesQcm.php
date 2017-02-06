<?php
if(isset($_GET['idqcm']) && $_GET['idqcm'] != null && isset($_GET['act']) ) {
    if ($_GET['act'] == 'vis'){
        $resQues = $monPDO->prepare('UPDATE qcm
                                  SET visible = 1
                                  WHERE idQcm ="'.$_GET['idqcm'].'"');
        $resQues->execute();
        header('location: membre.php?nav=mesqcm');
    }else{
        $resQues = $monPDO->prepare(' SELECT * 
                              FROM qcm q 
                              WHERE q.idCrea = "' . $_SESSION['id'] . '"
                              AND q.idQcm = "'.$_GET['idqcm'].'"');
        $resQues->execute();
        $data = $resQues->fetch();
        echo "<h1>".$data[5]."</h1>";


    }
}else{
    $resQues = $monPDO->prepare(' SELECT * 
                              FROM qcm
                              WHERE idCrea = "' . $_SESSION['id'] . '"');
    $resQues->execute();
    $index = 0;
    ?>
        <h2>Mes QCM</h2>
        <table>


    <?php

    while ($data = $resQues->fetch()) {
        echo '<tr><td><a href="membre.php?nav=mesqcm&idqcm='.$data[0].'&act=aff">'.$data[5].'</a></td>
              <td>Date de creation : '.$data[3].'</td>
              <td>Date de fin : '.$data[2].'</td>';
        if ($data[4] == 1 ){
            echo "<td> Est Visible </td>";
        }else{
            echo "<td> Est Caché </td><td><a href='membre.php?nav=mesqcm&idqcm=".$data[0]."&act=vis'> Rendre Visible</a> </td>";
        }
        echo "</tr>";
    }
    echo "</table>";


}
