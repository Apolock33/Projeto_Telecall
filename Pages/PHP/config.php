<?php
  $server = 'localhost';
  $user = 'root';
  $password = 'Bio6971@@';
  $db = 'unisuam';

  $mysqli = new mysqli($server, $user, $password, $db);

  if($mysqli->connect_errno) {
    die("ERRO: Não foi possível conectar com o Banco de Dados!");
  }
?>