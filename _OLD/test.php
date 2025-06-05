<?php
$mot_de_passe = '123456789';
$hash = '$argon2id$v=19$m=65536,t=4,p=1$SHFwaERoc0NJajY2VUxtZA$IugCfB1MF1zICVTkeCWPjV/vZY5J1Wn8oOg6cUGO5bI';

if (password_verify($mot_de_passe, $hash)) {
    echo "Mot de passe OK";
} else {
    echo "Mot de passe INCORRECT";
}
