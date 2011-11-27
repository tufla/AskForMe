<?php

class PagesController extends AppController {

//	function beforeFilter() {
//		parent::beforeFilter();
//		$this->Auth->allow(array('cities','login', 'logout', 'signup', 'tags'));
//	}
	public $uses = array('Voicebunny');
	
	function beforeRender(){
//		$this->viewClass = 'Json';
//		debug($this);
//		exit;
	}

    public function display() {
		$this->set('voicestypes',$this->Voicebunny->getVoicesTypes());
		$this->render('home');
	}


	
}
