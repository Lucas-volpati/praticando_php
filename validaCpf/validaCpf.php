<?php

//RECEBIMENTO DOS DADOS VIA FORMULÁRIO

$cpf = $_POST['cpf'];


//DESCARTANDO CPF's INVÁLIDOS

if($cpf == 00000000000
		|| $cpf == 11111111111
		|| $cpf == 22222222222
		|| $cpf == 33333333333
		|| $cpf == 44444444444
		|| $cpf == 55555555555
		|| $cpf == 66666666666
		|| $cpf == 77777777777
		|| $cpf == 88888888888
		|| $cpf == 99999999999) {

	echo "<p class='msgError'>Favor inserir CPF válido!</p>";

}elseif(strlen($cpf) < 11) {

	echo "<p class='msgError'>Insira todos os dígitos !</p>";

}else {

	//INICIO

	$cpfNumber = intval(substr($cpf, 0, 9));

	$lastDigits = intval(substr($cpf, 9, 2));



	//CÁLCULO DO PRIMEIRO DÍGITO VERIFICADOR

	$somDigits = 0;
	$cont = 0;

	for ($i=10; $i >= 2 ; $i--) { 
		
		$somDigits += intval(substr($cpfNumber, $cont, 1)) * ($i);
		$cont++;
	}

	$firstDigit = 11 - ($somDigits % 11);


	//VERIFICAÇÃO DO PRIMEIRO DIGITO


	if($firstDigit >= 0 && $firstDigit <= 9) {

	    $firstVerified = $firstDigit;

	}elseif ($firstDigit > 9) {

		$firstVerified = 0;
		
	}else {
		echo "<p class='msgError'>CPF inválido !</p>";
	}

	
	//CALCULANDO SEGUNDO DÍGITO


	$somDigits2 = 0;
	$cont2 = 0;
	$cpfNumberAndDigit = intval($cpfNumber . $firstVerified);
	
	for ($i=11; $i >= 2 ; $i--) {
		
		$somDigits2 += intval(substr($cpfNumberAndDigit, $cont2, 1)) * ($i);
		$cont2++;
		
	}

	$secondDigit = 11 - ($somDigits2 % 11);

	
	//VERIFICAÇÃO DO SEGUNDO DÍGITO


	if($secondDigit >= 0 && $secondDigit <= 9) {

		$secondVerified = $secondDigit;

	}elseif ($secondDigit > 9) {
	
		$secondVerified = 0;
	
	}else {
		echo "<p class='msgError'>CPF inválido !</p>";
	}
	

	//CONCATENAÇÃO DOS 2 ULTIMOS DIGITOS E COMPARAÇÃO COM ULTIMOS 2 DIGITOS INFORMADOS


	$verifyDigits = intval($firstVerified . $secondVerified);

	if ($lastDigits == $verifyDigits) {
		
		echo "<p class='okMsg'>O CPF é válido</p>";
		
	}else {
		echo "<p class='msgError'>CPF inválido, verifique e tente novamente!</p>";
	}
	
}
