<?php
App::import('Vendor', 'Twilio');

class Twilio extends AppModel {
    public $name = 'Twilio';
    public $useDbConfig = false;
    private $sid    = 'AC6aa8ebd884464c10ab1a2a7016c38051';
    private $token  = '5cddb81e8961a7741d981c67f65cc546';
    private $from   = '+14155992671'; //From number
    
    public function call($to, $url){
        $client = new Services_Twilio($this->sid, $this->token);
        
        if($url){
            $call = $client->account->calls->create(
                $this->from,
                $to,
                $url
            );
        }
    }
    
    public function message($mp3 = "http://demo.twilio.com/welcome/voice"){ 
        $response = new Services_Twilio_Twiml();
        $response->say('Hi');
        $response->play($mp3);
        return $response;    
    }
    
}
?>