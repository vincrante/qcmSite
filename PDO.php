<?php
$bd = 'mysqli_select_db=qcm;host:localhost';
$user ="root";
$password = "";
try
{
    $monPDO = new PDO($bd,$user,$password);
} catch (PDOException $e) {
echo ('Connexion échouée : '.$e->getMessage());
}
$_SESSION['PDO'] = $monPDO;
?>