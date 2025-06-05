<?php
$host = '192.168.102.120';
$dbname = 'Spare_inventory_DB';
$user = 'admin';
$pass = 'MA4w&EZ1-DBA';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Met par défaut le fuseau horaire à UTC
date_default_timezone_set('Europe/Paris');
?>