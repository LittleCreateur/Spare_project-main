<?php
function isLoggedIn() {
    return isset($_SESSION['utilisateur']);
}

function isAdmin() {
    return isLoggedIn() && $_SESSION['utilisateur']['role_id'] === 1;
}

function isTechnicien() {
    return isLoggedIn() && $_SESSION['utilisateur']['role_id'] === 2;
}

function isClient() {
    return isLoggedIn() && $_SESSION['utilisateur']['role_id'] === 3;
}
?>