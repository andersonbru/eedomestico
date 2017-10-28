<?php
function site_url(){
	return 'http://'.$_SERVER['SERVER_NAME'].'/sistema';
}

function verMatriz($vetor){
	echo '<pre>';
		var_dump($vetor);
	echo '</pre>';
}

function numberformat($valor){
	return 'R$ '.number_format($valor,2,',','2');
}

function numberFormatBanco($valor){
	$valor = str_replace('.', '', $valor);
	$valor = str_replace(',', '.', $valor);
	return $valor;
}

function dt_banco($dt){
	if ($dt) {
		$dt = explode('/', $dt);
		$data = $dt[2].'-'.$dt[1].'-'.$dt[0]; 
	} else {
		$data = '';
	}
	return $data; 
}

function dt_br($dt){
	if ($dt) {
		$data = date('d/m/Y', strtotime($dt)); 
	} else {
		$data = '';
	}
	return $data; 
}

function dh_br($dt){
	if ($dt) {
		$dh = date('d/m/Y H:i:s', strtotime($dt)); 
	} else {
		$dh = ''; 
	}
	
	return $dh;
}

function mes_abreviado($mes){
	switch ($mes) {
    	case '01':
    		$mes = 'Jan';
    		break;
    	case '02':
    		$mes = 'Fev';
    		break;
    	case '03':
    		$mes = 'Mar';
    		break;
		case '04':
    		$mes = 'Abr';
    		break;
		case '05':
    		$mes = 'Mai';
    		break;
		case '06':
    		$mes = 'Jun';
    		break;
		case '07':
    		$mes = 'Jul';
    		break;
		case '08':
    		$mes = 'Ago';
    		break;
		case '09':
    		$mes = 'Set';
    		break;
		case '10':
    		$mes = 'Out';
    		break;
		case '11':
    		$mes = 'Nov';
    		break;
		case '12':
    		$mes = 'Dez';
    		break;
    	}	
    return $mes;
}

function mes_extenso($mes){
	switch ($mes) {
    	case '01':
    		$mes = 'Janeiro';
    		break;
    	case '02':
    		$mes = 'Fevereiro';
    		break;
    	case '03':
    		$mes = 'Março';
    		break;
		case '04':
    		$mes = 'Abril';
    		break;
		case '05':
    		$mes = 'Maio';
    		break;
		case '06':
    		$mes = 'Junho';
    		break;
		case '07':
    		$mes = 'Julho';
    		break;
		case '08':
    		$mes = 'Agosto';
    		break;
		case '09':
    		$mes = 'Setembro';
    		break;
		case '10':
    		$mes = 'Outubro';
    		break;
		case '11':
    		$mes = 'Novembro';
    		break;
		case '12':
    		$mes = 'Dezembro';
    		break;
    	}	
    return $mes;
}

function retorna_idade($dt){
	$data = dt_br($dt);   
    // Separa em dia, mês e ano
    list($dia, $mes, $ano) = explode('/', $data);   
    // Descobre que dia é hoje e retorna a unix timestamp
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    // Descobre a unix timestamp da data de nascimento do fulano
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);   
    // Depois apenas fazemos o cálculo já citado :)
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
    return $idade;
}

function mover_arquivo($arquivo, $dir, $nome){
	if (file_exists($dir)) {
		$mover = move_uploaded_file($arquivo, $dir.'/'.$nome);
		if($mover){
			return TRUE;
		}else{
			return $mover;
		}
			
	}else{
		return FALSE;
	}
}

function somar_data($qtd, $tipo, $dt='' ){
	
	if (empty($dt)) {
		$dt = date('Y-m-d');
	}
	
	switch ($tipo) {
    	case 'd':
    		$tipo = ' days';
    		break;
    	case 'm':
    		$tipo = ' month';
    		break;
    	case 'y':
    		$tipo = ' year';
    		break;
    	}	
	$data = date('Y-m-d', strtotime("+".$qtd.$tipo,strtotime($dt)));	
    return $data;
}

function valida_logado(){
	if(!isset($_SESSION['usuario'])){
		header('Location: '.site_url().'/logout');
		exit;
	}
}

function limpa_numero($str) {
    return preg_replace("/[^0-9]/", "", $str);
}

function preencheZero($nro, $qtde){
	return str_pad($nro, $qtde, '0', STR_PAD_LEFT);
}

function mascara($val='', $mask=''){
    $maskared = '';
    $k = 0;
    for($i = 0; $i<=strlen($mask)-1; $i++) {
        if($mask[$i] == '#') {
            if(isset($val[$k])) $maskared .= $val[$k++];
        }else {
            if(isset($mask[$i])) $maskared .= $mask[$i];
        }
    }
 return $maskared;
}

function formata_cpf($num){
	$cpf = preencheZero($num, 11);
	$cpf = mascara($cpf, '###.###.###-##');
	return $cpf;
}

function formato_moeda($valor){
	return number_format((isset($valor)?$valor:0.00),'2',',','.');
}

function extensoes_permitidos(){
	return array('pdf','jpg','jpeg','png','doc','docx','txt','xls','xlsx','csv','zip','rar');
}

function By2M($size){
    $filesizename = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
    return $size ? round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $filesizename[$i] : '0 Bytes';
}

function valida_cpf($cpf) {
	// verifica se e numerico
	
	if(!is_numeric($cpf)) {
		return false;
	}

	// verifica se esta usando a repeticao de um numero
	if(($cpf == '11111111111') || 
	   ($cpf == '22222222222') || 
	   ($cpf == '33333333333') || 
	   ($cpf == '44444444444') || 
	   ($cpf == '55555555555') || 
	   ($cpf == '66666666666') || 
	   ($cpf == '77777777777') || 
	   ($cpf == '88888888888') || 
	   ($cpf == '99999999999') || 
	   ($cpf == '00000000000')) {
			
		return false;
	}

	//PEGA O DIGITO VERIFIACADOR
	$dv_informado = substr($cpf, 9,2);

	for($i=0; $i<=8; $i++) {
		$digito[$i] = substr($cpf, $i,1);
	}

	//CALCULA O VALOR DO 10º DIGITO DE VERIFICAÇÂO
	$posicao = 10;
	$soma = 0;

	for($i=0; $i<=8; $i++) {
		$soma = $soma + $digito[$i] * $posicao;
		$posicao = $posicao - 1;
	}

	$digito[9] = $soma % 11;

	if($digito[9] < 2) {
		$digito[9] = 0;
	} else {
		$digito[9] = 11 - $digito[9];
	}

	//CALCULA O VALOR DO 11º DIGITO DE VERIFICAÇÃO
	$posicao = 11;
	$soma = 0;

	for ($i=0; $i<=9; $i++) {
		$soma = $soma + $digito[$i] * $posicao;
		$posicao = $posicao - 1;
	}

	$digito[10] = $soma % 11;

	if ($digito[10] < 2) {
		$digito[10] = 0;
	}else {
	$digito[10] = 11 - $digito[10];
	}

	//VERIFICA SE O DV CALCULADO É IGUAL AO INFORMADO
	$dv = $digito[9] * 10 + $digito[10];
	if ($dv != $dv_informado) {
		return false;
	}

	return true;
} // function valida_cpf($cpf)

?>