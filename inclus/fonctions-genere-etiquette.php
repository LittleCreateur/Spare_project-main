<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require dirname(__DIR__) . '/vendor/autoload.php';
require_once '../config/config.php';

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;

// Fonction : génère une étiquette HEX (8 caractères = 4 octets)
function generateHexTag(): string {
    return strtoupper(bin2hex(random_bytes(4))); // Exemple : A1B2C3D4
}

// Types matériels liés
$materielData = [
    ['nom' => 'Cisco Catalyst 2960', 'type' => 1],
    ['nom' => 'Ubiquiti EdgeSwitch 24', 'type' => 1],
    ['nom' => 'Netgear ProSAFE GS108', 'type' => 1],
    ['nom' => 'HP EliteBook 840 G7', 'type' => 2],
    ['nom' => 'Dell Latitude 7420', 'type' => 2],
    ['nom' => 'MacBook Pro 14 M1', 'type' => 2],
    ['nom' => 'Asus ExpertBook B5', 'type' => 2],
    ['nom' => 'Lenovo ThinkPad X1 Carbon', 'type' => 2],
    ['nom' => 'Microsoft Surface Laptop 4', 'type' => 2],
    ['nom' => 'Dell Precision 3551', 'type' => 2],
    ['nom' => 'Acer Aspire 5', 'type' => 2],
    ['nom' => 'Asus ROG Zephyrus G14', 'type' => 2],
    ['nom' => 'HP ZBook Firefly 15', 'type' => 2],
    ['nom' => 'HP ProDesk 600 G5', 'type' => 3],
    ['nom' => 'Dell OptiPlex 7090', 'type' => 3],
    ['nom' => 'Lenovo ThinkCentre M920', 'type' => 3],
    ['nom' => 'Intel NUC 11 Performance', 'type' => 3],
    ['nom' => 'Zotac ZBOX CI662', 'type' => 3],
    ['nom' => 'HP Thin Client t640', 'type' => 3],
    ['nom' => 'Apple Mac Mini M2', 'type' => 3],
    ['nom' => 'Samsung Smart Monitor M8', 'type' => 4],
    ['nom' => 'BenQ PD2700U', 'type' => 4],
    ['nom' => 'Dell UltraSharp U2723QE', 'type' => 4],
    ['nom' => 'Logitech Rally Bar', 'type' => 5],
    ['nom' => 'Poly Studio X30', 'type' => 5],
    ['nom' => 'APC Back-UPS Pro 1200', 'type' => 5],
    ['nom' => 'Synology NAS DS220+', 'type' => 7],
    ['nom' => 'Supermicro SYS-5019C-MR', 'type' => 6],
    ['nom' => 'Dell PowerEdge R640', 'type' => 6],
    ['nom' => 'HP ProLiant DL360 Gen10', 'type' => 6]
];

// Clients
$clients = [
    "INFO'MAINTENANCE",
    "TechNova Solutions",
    "Globax Industries",
    "CyberForge",
    "MayaSolar",
    "InnovaSys",
    "NextWare",
    "DataWorks",
    "CloudAxis",
    "ZenithCorp"
];

// QR path
$qrPath = __DIR__ . '/../qrcodes/';
if (!file_exists($qrPath)) {
    mkdir($qrPath, 0775, true);
}

// Génération
foreach ($materielData as $data) {
    $nom = $data['nom'];
    $id_type_materiel = $data['type'];
    $sn = strtoupper(bin2hex(random_bytes(4)));
    $valoriser = rand(0, 1);
    $valeur = $valoriser ? rand(100, 1500) : null;

    // Provenance logique
    $rand = rand(1, 100);
    $client = $clients[array_rand($clients)];
    if ($rand <= 40) {
        $provenance = "Stock INFO'MAINTENANCE";
    } elseif ($rand <= 70) {
        $provenance = $client;
    } else {
        $provenance = "Migration $client";
    }

    $id_etat_materiel = rand(1, 14);
    $date_creation = date('Y-m-d H:i:s');
    $etiquette = generateHexTag(); // HEX directement

    $stmt = $pdo->prepare("INSERT INTO MATERIEL (
        nom, sn, valoriser, valeur, provenance, date_creation, etiquette, perdu, id_type_materiel, id_etat_materiel
    ) VALUES (?, ?, ?, ?, ?, ?, ?, 0, ?, ?)");
    
    $stmt->execute([
        $nom,
        $sn,
        $valoriser,
        $valeur,
        $provenance,
        $date_creation,
        $etiquette,
        $id_type_materiel,
        $id_etat_materiel
    ]);

    // Génération du QR code avec l’étiquette hex
    $qrCode = new QrCode($etiquette);
    $qrCode->setEncoding(new Encoding('UTF-8'));
    $qrCode->setSize(250);
    $qrCode->setMargin(10);

    $writer = new PngWriter();
    $result = $writer->write($qrCode);
    $result->saveToFile($qrPath . $etiquette . '.png');

    echo "\n✅ $nom | Type: $id_type_materiel | Etat: $id_etat_materiel | $provenance | QR: $etiquette";
}

echo "\n\n🎉 Matériels insérés avec QR codes générés dans /qrcodes\n";
?>