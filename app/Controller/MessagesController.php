<?php

/**
 * Messages Controller
 *
 * @property User $User
 */
class MessagesController extends AppController {

	public $uses = array('Twilio','Voicebunny');
	
    public function send() {
		$this->viewClass = 'Json';
		$this->RequestHandler->respondAs('json');
		if(!empty($this->data)){
			list($status, $result) = $this->Voicebunny->createProject($this->data);
		}
        $this->set('json',$result);
    }	

	
	public function reads($projectId){
		$this->viewClass = 'Json';
		$this->RequestHandler->respondAs('json');
		$project = $this->Voicebunny->getReadsByProject($projectId);
		if(isset($project['reads'][0]['mp3']) && !empty($project['reads'][0]['mp3'])){
			//4092993229
			$this->Twilio->call('4092993229','http://askforme.dev.voicebunny.com/taudio?f='.$reads['reads'][0]['mp3']);
		}
        $this->set('json',$reads);		
	}
	
	public function taudio(){
		$this->autoRender = false;
		$this->RequestHandler->respondAs('xml');
		echo $this->Twilio->message($_GET['f']);
		return;
	}
	
}
