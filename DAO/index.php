<?php

require_once ("Config.php");

/* Praticando conexão com banco de dados! */



/* ESTE COMANDO RECUPERA UM USUÁRIO APENAS */
//$usu1 = new Usuario();
//$usu1->loadById(4);

//echo $usu1;



/* ESTE COMANDO RECUPERA UMA LISTA DE USUARIOS */

//$lista = Usuario::getList();

//echo json_encode($lista);



/* ESTE COMANDO RECUPERA OS USUARIOS BUSCANDO POR PEQUENAS PALAVRAS CONTIDAS NO DESLOGIN USANDO COMANDO LIKE DO SQL */

//$search = Usuario::search("an");

//echo json_encode($search);


/* CARREGA UM USUARIO DESDE QUE LOGIN E SENAH ESTEJAM CORRETOS */

$usuario = new Usuario();

$usuario->dados("Fox", "@#@#$");

echo ($usuario);