<?php
    session_start();
    unset($_SESSION['nom_utilisateur']);
    unset($_SESSION['values']);
    unset($_SESSION['erreurs']);
    header('Location: index.php');
?>