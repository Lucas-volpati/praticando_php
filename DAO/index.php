<?php

require_once ("Config.php");

echo "<h1>Praticando conexão com banco de dados!</h1>";



$usu1 = new Usuario();

$usu1->loadById(4);

echo $usu1;