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

?>