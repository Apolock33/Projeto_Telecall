<?php
$server = 'localhost:3307';
$user = 'root';
$password = 'Bio6971@@';
$db = 'unisuam';

$mysqli = new mysqli($server, $user, $password, $db);

if ($mysqli->connect_errno) {
  die("ERRO: Não foi possível conectar com o Banco de Dados!");
}

function formatar_data($data)
{
  return implode('/', array_reverse(explode("-", $data)));
}

function formatar_telefone($telefone)
{
  if (!empty(($telefone))) {
    $ddd = substr($telefone, 0, 2);
    $parte1 = substr($telefone, 2, 5);
    $parte2 = substr($telefone, 7);
    return "($ddd) $parte1-$parte2";
  }
}
function formatar_fixo($telefone)
{
  if (!empty(($telefone))) {
    $ddd = substr($telefone, 0, 2);
    $parte1 = substr($telefone, 2, 4);
    $parte2 = substr($telefone, 6);
    return "($ddd) $parte1-$parte2";
  }
}
