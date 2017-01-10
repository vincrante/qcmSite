<?php
$bd = 'mysqli_select_db=qcm;host:localhost';
$user ="root";
$password = "";
try
{
    $monPDO = new PDO($bd,$user,$password);
    $_SESSION['PDO'] = $monPDO;
} catch (PDOException $e) {
echo ('Connexion échouée : '.$e->getMessage());
}
?>