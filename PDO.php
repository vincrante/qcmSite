<?php
$bd = 'mysql:dbname=qcmsite;host:localhost';
$user ="siteQcm";
$password = "\$iutinfo";

if(!isset($monPDO))
{
    try
    {
        $monPDO = new PDO($bd,$user,$password);
        $_SESSION['PDO'] = $monPDO;
    } catch (PDOException $e) {
    echo ('Connexion échouée : '.$e->getMessage());
    }
}
?>