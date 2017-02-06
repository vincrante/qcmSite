<?php
include('PDO.php');
?>
<fieldset>
    <legend>Liste des questions</legend>
    <div id="list">
        <table id="choix">
            <td><select id="choix">
                                    <?php
                                        $resQues = $monPDO->prepare('SELECT * FROM question');
                                        $resQues->execute();
                                        $index=0;
                                        while($data = $resQues->fetch()) {
                                            echo "<option value='".$data[0]."'>".$data[1]."</option>\n";
                                        }
                                    ?>
            </select></td>
            <td><a id="link" ><input type="button" value="Modifier"/></a></td>
        </table>
    </div>
       
</fieldset>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#link").attr("href", "membre.php?nav=modifquest&modifQuestion=" + $("option:selected").val());
        $("#choix").change(function () {
            $("#link").attr("href", "membre.php?nav=modifquest&modifQuestion=" + $("option:selected").val());
        });
    });
</script>