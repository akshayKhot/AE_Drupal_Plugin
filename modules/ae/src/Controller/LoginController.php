<?php 

namespace Drupal\ae\Controller;

use Drupal\Core\Controller\ControllerBase;

class LoginController extends ControllerBase {

    public function createuser($id) {
        
        $state = \Drupal::state();

        $api_key = $state->get('api_key');
        $url = 'https://akshay.dev.appreciationengine.com/v1.1/auth?apiKey=' . $api_key . '&accesstoken='. $id;

        // $u = "https://akshay.dev.appreciationengine.com/v1.1/auth?apiKey=9ee609a0370231ac93149413e00a2ca0&accesstoken=d732a4174b10f5b255c7cb2f953c559c_1506459361";
        
        $client = \Drupal::httpClient();
        $request = $client->get($url);   
        $response = (string) $request->getBody();

        echo $response;


        exit(0);
    }
}


?>