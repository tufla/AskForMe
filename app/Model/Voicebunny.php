<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VoicebunnyModel
 *
 * @author tufla
 */
class Voicebunny extends AppModel {
	public $name = 'Voicebunny';
	public $useDbConfig = 'voicebunny';
	
	public function createProject($data){
		$url = 'projects';
		$method = 'post';
		$data = $data['Message'];
		$data = array(
			'title' => sprintf('AskForMe project from %s to %s',$data['from'],$data['to']),
			'voicetype' => $data['voicetype'],
			'script' =>  sprintf('TEST!! %s, %s has sent you the following message. %s.',$data['to'],$data['from'],$data['message']),
			'rewardamount' => '30',
			'specialinstructions' => $data['instructions']
		);
//		debug($data); exit;
		list($status, $result) = $this->query(compact('url','method','data'));
		if($status == 200){
			$result = Set::reverse(json_decode($result));
			return $result;
		}
		return false;
	}
	
	public function getVoicesTypes(){
		$url = 'voicetypes';
		$method = 'get';	
		list($status, $result) = $this->query(compact('url','method'));
		if($status == 200){
			$result = Set::reverse(json_decode($result));
			return $result['voicetypes'];
		}
	}
	
	public function getReadsByProject($projectId){
		$url = "reads/index/{$projectId}";
		$method = 'get';
		list($status, $result) = $this->query(compact('url','method'));
		if($status == 200){
			$result = Set::reverse(json_decode($result));
			return $result;
		}
	}
}

?>
