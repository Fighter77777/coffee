<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Json {
	// Json â windows
	public function php2js($a = false) {
		if (is_null($a))
			return 'null';
		if ($a === false)
			return 'false';
		if ($a === true)
			return 'true';
		if (is_scalar($a)) {
			if (is_float($a)) {
				$a = str_replace(",", ".", strval($a));
			}
			static $jsonReplaces = array( array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
			return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
		}
		$isList = true;
		for ($i = 0, reset($a); $i < count($a); $i++, next($a)) {
			if (key($a) !== $i) {
				$isList = false;
				break;
			}
		}
		$result = array();
		if ($isList) {
			foreach ($a as $v)
				$result[] = $this -> php2js($v);
			return '[ ' . join(', ', $result) . ' ]';
		} else {
			foreach ($a as $k => $v)
				$result[] = $this -> php2js($k) . ': ' . $this -> php2js($v);
			return '{ ' . join(', ', $result) . ' }';
		}
	}

	public function json_fix_cyr($var) {
		if (is_array($var)) {
			$new = array();
			foreach ($var as $k => $v) {
				$new[$this ->json_fix_cyr($k)] = $this ->json_fix_cyr($v);
			}
			$var = $new;
		} elseif (is_object($var)) {
			$vars = get_object_vars($var);
			foreach ($vars as $m => $v) {
				$var -> $m = $this -> json_fix_cyr($v);
			}
		} elseif (is_string($var)) {
			$var = iconv('cp1251', 'utf-8', $var);
		}
		return $var;
	}

}
?>