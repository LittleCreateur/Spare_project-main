<?php
$PWD = password_hash('123456789', PASSWORD_ARGON2I, ['memory_cost' => 65536, 'time_cost' => 4, 'threads' => 1]);
echo "Mot de passe haché pour '123456789' : $PWD\n";
?>