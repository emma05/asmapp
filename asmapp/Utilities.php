<?php

class Utilities {
	public static function curlConnection($url, $request, $data = null) {
		if(!$url) {
			return false;
		}
		$ch = curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);
		$token = self::getParams('api_token');
		$headers = array(
			'Authorization: Value=Token token=<' . $token . '>',
		);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		if($request === "POST") {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		}
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);  
		$result = curl_exec($ch);
		if(curl_error($ch)) {
			self::log(curl_error($ch));
			return false;
		}
		//self::log(curl_getinfo($ch));
		curl_close($ch);
		self::log($result);

		return json_decode($result, true);
	}

	public static function getParams($name, $section = false) { 
		if(!$name) {
			return false;
		}
		$parameters = parse_ini_file('config/parameters.ini');
		if($section) {
			$parameters = parse_ini_file('config/parameters.ini', true);
		}
		return $parameters[$name];
	}

	public static function log($error) {
		$filename = self::getParams('root_dir') . "/logs/error.log";
		$datetime = new DateTime();
		$datetime_format = $datetime->format('Y-m-d H:i:s');
		file_put_contents($filename, "[" . $datetime_format . "] " . json_encode($error) . "\r\n", 8);
	}

}