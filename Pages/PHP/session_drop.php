<?php
session_start();

session_destroy();
header("Location: index.php");
//esse arquivo inteiro é configurado para que, ao ser acessado, destrua a sessão e leve o usuario para a pagina de login
