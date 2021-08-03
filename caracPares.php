<?php

//DESAFIO DE LEVE

/*Este desafio retorna a string ($str) em pares de dois caracteres. 
Se a string contiver um número ímpar de caracteres, ela deverá 
substituir o segundo caractere ausente do par final por um sublinhado '_' */ 


function pairChar($str = 'abcdefghij') {

	$size = strlen($str);//Guarda o tamanho da string em numero inteiro.
	$rest = $size % 2;


	if ($rest === 0) {

		$end = $size - 2;

		for ($i=0; $i < $size ; $i+=2) { 
			
			echo substr($str, $i,2); 

			echo $i<>$end ? ", " : "";
		}
		
	}

	else {

		$end = $size - 1;
		
		for ($i=0; $i < $size ; $i+=2) { 
									
			echo substr($str, $i,2);

			echo $i <> $end ? ", " : "_";

		}

	}
}


pairChar();