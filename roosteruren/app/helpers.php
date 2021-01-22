<?php

function each_date($from, $to) {
	$date = strtotime($from);
	$dates = [];
	for ($i = 0; $i < 1000; $i++) {
		$date_str = intval(date('Ymd', $date));
		if ($date_str > $to) break;
		$dates[] = $date_str;
		$date = strtotime('+1 day', $date);
	}
	return $dates;
}

function to_json_blob($data) {
	return gzdeflate(json_encode($data));
}

function from_json_blob($data) {
	return json_decode(gzinflate($data), true);
}

function getval(&$array, $key, $default = '') {
	if (!is_array($array)) return $default;
	if (is_array($key)) {
		$temp = $array;
		foreach ($key as $part) {
			if (is_array($temp) && isset($temp[$part])) {
				$temp = $temp[$part];
			}
			else {
				return $default;
			}
		}
		return $temp;
	}
	if (isset($array[$key])) return $array[$key];
	else if (strpos($key, '/')) return getval($array, explode('/', $key), $default);
	else return $default;
}

function date_lang($format, $timestamp) {
	static $days = ['Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag', 'Zondag'];
	static $days_short = ['Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za', 'Zo'];
	static $months = ['Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December'];
	static $months_short = ['jan', 'feb', 'mrt', 'apr', 'mei', 'jun', 'jul', 'aug', 'sep', 'okt', 'nov', 'dec'];

	$output = '';
	for ($i = 0; $i < strlen($format); $i++) {
		$char = $format[$i];
		if ($char == '\\') continue;
		else if ($char == ' ') $output .= ' ';
		else if ($i && $format[$i - 1] == '\\') $output .= $char;
		else if ($char == 'l') $output .= $days[date('N', $timestamp) - 1];
		else if ($char == 'D') $output .= $days_short[date('N', $timestamp) - 1];
		else if ($char == 'F') $output .= $months[date('n', $timestamp) - 1];
		else if ($char == 'M') $output .= $months_short[date('n', $timestamp) - 1];
		else $output .= date($char, $timestamp);
	}

	return $output;
}

function validate_uren_range($input) {
	if ($input == '') return '';
	if (strpos($input, ',')) {
		$temp = [];
		foreach (explode(',', $input) as $range) {
			if ($range = validate_uren_range($range)) {
				$temp[] = $range;
			}
		}
		return implode(', ', $temp);
	}
	
	if (count($input = explode('-', $input, 2)) == 2) {
		if (($start = time_to_int($input[0])) !== false && ($end = time_to_int($input[1])) !== false) {
			if ($start > $end) return int_to_time($end) . ' - ' . int_to_time($start);
			else return int_to_time($start) . ' - ' . int_to_time($end);
		}
	}
	return false;
}
function validate_time($str, $def = false) {
	if (($int = time_to_int($str)) !== false) {
		return int_to_time($int);
	}
	return false;
}

function uren_range_to_time($str) {
	if ($str = validate_uren_range($str)) {
		$time = 0;
		foreach (explode(',', $str) as $part) {
			if (count($split = explode('-', $part, 2)) == 2) {
				$time += time_to_int($split[1]) - time_to_int($split[0]);
			}
		}
		return $time;
	}
	return false;
}

function time_to_int($str) {
	$str = trim($str);
	if (ctype_digit($str)) {
		if ($str < 100) return $str * 3600;
		else return floor($str / 100) * 3600 + min($str % 100, 59) * 60;
	}
	if (preg_match('/^([0-9]+)[:\.]([0-9]{2})$/', $str, $match)) return $match[1] * 3600 + min($match[2], 59) * 60;
	if (preg_match('/^([0-9]+),([0-9]+)$/', $str, $match)) return str_replace(',', '.', $str) * 3600;
	return false;
}

function int_to_time($int, $parts = 2) {
	if (!$int) return '';
	$neg = $int < -60 ? '-' : '';
	$int = round(abs($int));
	$uren = floor($int / 3600);
	$min = floor(($int - $uren * 3600) / 60);
	$sec = floor($int - $uren * 3600 - $min * 60);
	if ($parts == 3) return $neg . $uren . ':' . ($min < 10 ? '0' : '') . $min . ':' . ($sec < 10 ? '0' : '') . $sec;
	else return $neg . $uren . ':' . ($min < 10 ? '0' : '') . $min;
}


?>