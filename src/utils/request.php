<?php


namespace loco\utils;


class request {

	private static function base(string $url) {
		$ch = curl_init($url);
		curl_setopt_array($ch, [
				CURLOPT_AUTOREFERER    => true,
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_SSL_VERIFYHOST => 2,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_FRESH_CONNECT  => 1,
		]);
		return $ch;
	}

	private static function result($ch, &$status, &$resHeaders, &$body): void {
		$raw = curl_exec($ch);
		$error = curl_error($ch);
		if ($error !== "") {
			throw new \Exception($error);
		}
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$rawHeaders = substr($raw, 0, $headerSize);
		$body = substr($raw, $headerSize);
		$resHeaders = [];
		foreach (explode("\r\n\r\n", $rawHeaders) as $rawHeaderGroup) {
			$headerGroup = [];
			foreach (explode("\r\n", $rawHeaderGroup) as $line) {
				$nameValue = explode(":", $line, 2);
				if (isset($nameValue[1])) {
					$headerGroup[trim(strtolower($nameValue[0]))] = trim($nameValue[1]);
				}
			}
			$resHeaders[] = $headerGroup;
		}
	}

	private static function convert($param) {
		if (is_bool($param)) return $param ? "true" : "false";
		return urlencode($param);
	}

	public static function queryToString(array $query): string {
		$str = [];
		foreach ($query as $k => $v) $str[] = self::convert($k) . "=" . self::convert($v);
		return implode("&", $str);
	}

	public static function getURL(string $url, array $headers = [], int &$status = null, array &$resHeaders = null) {
		$ch = self::base($url);
		try {
			curl_setopt_array($ch, [
					CURLOPT_HEADER     => true,
					CURLOPT_HTTPHEADER => $headers
			]);
			self::result($ch, $status, $resHeaders, $body);
			return $body;
		} finally {
			curl_close($ch);
		}
	}

	public static function postURL(string $url, $post_field, array $headers = [], int &$status = null, array &$resHeaders = null): string {
		$ch = self::base($url);
		try {
			curl_setopt_array($ch, [
					CURLOPT_POSTFIELDS => $post_field,
					CURLOPT_POST       => true,
					CURLOPT_HEADER     => true,
					CURLOPT_HTTPHEADER => $headers
			]);
			self::result($ch, $status, $resHeaders, $body);
			return $body;
		} finally {
			curl_close($ch);
		}
	}

}