<?php
class AppController extends Controller {
	var $components = array('RequestHandler');
    var $helpers = array('Html', 'Form', 'Session','Js' => array('Jquery'));    
}
?>