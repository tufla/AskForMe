<?php

App::uses('HttpSocket', 'Network/Http');

class VoicebunnySource extends DataSource {

	public function __construct($config) {
		parent::__construct($config);
	}

	public function listSources() {
		//return array('voicebunny');
	}

	public function query($query) {
		extract($query);
		if (!isset($url) || !isset($method)) {
			return trigger_error('Invalid method requested', E_USER_ERROR);
		}	
		if(!isset($data)) $data = array();
		return $this->request($url, $method, $data);
	}
	
	/*public function createProject($data){
		debug($data); exit;
		return $this->query(compact('url','method','data'));
		
	}*/

	private function signature($url) {
		return array('signature' => base64_encode(hash_hmac('sha1', $url . '&' . $this->config['app_id'] . '&' . time(), $this->config['app_key'], true)));
	}

	private function request($url, $method, $vars = array()) {
		$vars += array('timestamp' => time(), 'clientid' => $this->config['app_id']);
		$vars = http_build_query($vars + $this->signature($url, $vars));
		$url = $this->config['url'] . '/' . $url;

		$ch = curl_init();

		switch ($method) {
			case 'post':
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
				break;
			case 'put':
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: ' . strlen($vars)));
				curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
				break;
			case 'get':
				curl_setopt($ch, CURLOPT_URL, $url . '?' . $vars);
				break;
		}
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($ch);
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		return array((int) $status, $response);
	}

}

?>
