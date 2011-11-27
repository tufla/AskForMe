<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$types = array_combine(Set::extract('/code',$voicestypes), Set::extract('/name',$voicestypes));

?>
<h2>Send a message!</h2>
<div style="padding: 20px; width: 550px;">
	<?php
	echo $this->Form->create('Message', array('controller' => 'messages', 'action' => 'send', 'default' => false,'id' => 'messageForm'));
	echo $this->Form->input('from', array('label' => 'From'));
	echo $this->Form->input('to', array('label' => 'To'));
	echo $this->Form->input('phone', array('label' => 'Phone'));
	echo $this->Form->select('voicetype',$types , array('label' => 'Voice Type'));
	echo $this->Form->textarea('message', array('label' => 'Message','rows' => '5', 'cols' => '5'));
	echo $this->Form->textarea('instructions', array('label' => 'Instructions'));
	echo $this->Form->end(array('id' => 'submitBtn','label' => 'Send'));
	?>
</div>