<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * debug
 *
 * Exibe o conteúdo detalhado e identado de uma variável no PHP
 * 
 * @param  Array $arry
 * @return void
 */
if (!function_exists('debug')) {
	function debug($arry) {
		echo '<pre>' . var_export($arry, TRUE) . '</pre>';
	}
}

/**
 * str_slug
 *
 * Normaliza uma string removendo todos os caracteres especiais, espaços e acentos.
 * 
 * @param  String $str
 * @return String
 */
if (!function_exists('str_slug')) {
	function str_slug($str)
	{
		return url_title(convert_accented_characters($str), "-", true);
	}
}

/**
 * format_money
 *
 * Recebe um valor float/ e converte para a exibição padrão do Real com 2 casas decimais, separando os decimais com virgula e a casa de milhares com ponto.
 * 
 * @param  Mixed $money
 * @return void
 */
if (!function_exists('format_money')) {
	function format_money($money)
	{
		$money = floatval($money);
		echo number_format($money, 2, ',', '.');
	}
}


// Funções para validar um cartão de crédito
if (!function_exists('validate_card') AND !function_exists('LuhnCheck')) {

	/**
	 * validate_card
	 *
	 * Recebe um número de cartão de crédito e retorna o número do cartão, a bandeira dele e se é valido ou não.
	 * 
	 * @param  String $number
	 * @return array $return
	 */
	function validate_card($number)
	{

		// Remove spaces
		$number = str_replace(" ", "", $number);

		$cardtype = array(
			'visa'              =>    "/^4\d{3}-?\d{4}-?\d{4}-?\d{4}$/",
			'mastercard'        =>    "/^5[1-5]\d{2}-?\d{4}-?\d{4}-?\d{4}$/",
			'discover'          =>    "/^6011-?\d{4}-?\d{4}-?\d{4}$/",
			'amex'              =>    "/^3[4,7]\d{13}$/",
			'diners'            =>    "/^3[0,6,8]\d{12}$/",
			'bankcard'          =>    "/^5610-?\d{4}-?\d{4}-?\d{4}$/",
			'jcb'               =>    "/^[3088|3096|3112|3158|3337|3528]\d{12}$/",
			'enroute'           =>    "/^[2014|2149]\d{11}$/",
			'switch'            =>    "/^[4903|4911|4936|5641|6333|6759|6334|6767]\d{12}$/"
		);

		$type = false;

		if (preg_match($cardtype['visa'], $number)) {
			$type = "visa";
		} else if (preg_match($cardtype['mastercard'], $number)) {
			$type = "mastercard";
		} else if (preg_match($cardtype['amex'], $number)) {
			$type = "amex";
		} else if (preg_match($cardtype['diners'], $number)) {
			$type = 'diners';
		} else if (preg_match($cardtype['bankcard'], $number)) {
			$type = 'bankcard';
		} else if (preg_match($cardtype['jcb'], $number)) {
			$type = 'jcb';
		} else if (preg_match($cardtype['enroute'], $number)) {
			$type = 'enroute';
		} else if (preg_match($cardtype['switch'], $number)) {
			$type = 'switch';
		} else {
			$type =  false;
		}

		$return['valid']    =    LuhnCheck($number);
		$return['ccnum']    =    $number;
		$return['type']     =    $type;

		return $return;
	}

	/**
	 * LuhnCheck
	 *
	 * Recebe um número de cartão de crédito e realiza o checksum para valida-lo.
	 * 
	 * @param  Integer $number
	 * @return boolean
	 */
	function LuhnCheck($ccnum)
	{
		$checksum = 0;
		for ($i = (2 - (strlen($ccnum) % 2)); $i <= strlen($ccnum); $i += 2) {
			$checksum += (int) ($ccnum{
				$i - 1});
		}

		// Analyze odd digits in even length strings or even digits in odd length strings.
		for ($i = (strlen($ccnum) % 2) + 1; $i < strlen($ccnum); $i += 2) {
			$digit = (int) ($ccnum{
				$i - 1}) * 2;
			if ($digit < 10) {
				$checksum += $digit;
			} else {
				$checksum += ($digit - 9);
			}
		}
		if (($checksum % 10) == 0) {
			return true;
		} else {
			return false;
		}
	}
}

/**
 * time_ago
 *
 * Recebe um Timestamp e retorna o tempo que passou desta data até o momento atual.
 * 
 * @param  Integer $time
 * @return boolean
 */
if (!function_exists('time_ago')) {
	function time_ago($time)
	{
		$time_difference = time() - $time;
		if ($time_difference < 1) {
			return 'less than 1 second ago';
		}
		$condition = array(
			12 * 30 * 24 * 60 * 60 =>  'year',
			30 * 24 * 60 * 60       =>  'month',
			24 * 60 * 60            =>  'day',
			60 * 60                 =>  'hour',
			60                      =>  'minute',
			1                       =>  'second'
		);
		foreach ($condition as $secs => $str) {
			$d = $time_difference / $secs;
			if ($d >= 1) {
				$t = round($d);
				return 'about ' . $t . ' ' . $str . ($t > 1 ? 's' : '') . ' ago';
			}
		}
	}
}

/**
 * hextorgba
 *
 * Recebe uma string referente a um valor hexadecimal, um valor de transparencia entre 0-1 e converte para RGBA.
 * 
 * @param  String $hex
 * @param  Float $transp
 * @return boolean
 */
if (!function_exists('hextorgba')) {
	function hextorgba($hex, $transp = 1)
	{
		list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
		echo 'rgba(' . $r . ',' . $g . ',' . $b . ', ' . $transp . ')';
	}
}


if (!function_exists('log_error')) {
	/**
	 * Generate log file
	 *
	 * @param String $name
	 * @param String $error_message
	 * @return void
	 */
    function log_error($name, $error_message)
    {
        $now = now('America/Sao_Paulo');
        $date = date('Y-m-d H:i:s', $now);
        $year = date('Y', $now);
        $month = date('m', $now);
        $day = date('d', $now);
        $hour = date('H', $now);
        
        // Caminho do log
        $log_path = APPPATH . 'logs/' . $name . '/' . $year . '/' . $month . '/' . $day . '/' . $hour . '/';

        // Verifica se o diretorio existe
        if (!is_dir($log_path)) {
            // Criar o diretorio recursivamente
            mkdir($log_path, 0755, true);
        }

        // Adiciona o datetime antes da mensagem de erro
        $error_message = '[' . $date . '] ' . 'ERROR: ' . $error_message;

		// Gera o log de erro
        error_log($error_message . "\n", 3, $log_path . 'error_log.log');
    }
}
