<?php
$bd = 'mysql:dbname=qcmsite;host:localhost';
$user ="siteQcm";
$password = "\$iutinfo";

try
{
    $monPDO = new PDO($bd,$user,$password);
    $_SESSION['PDO'] = $monPDO;
} catch (PDOException $e) {
echo ('Connexion échouée : '.$e->getMessage());
}
?>