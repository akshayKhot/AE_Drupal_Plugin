<?php 

namespace Drupal\ae\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Component\Serialization\Json;
use Drupal\user\Entity\User;

class LoginController extends ControllerBase {

    public function createuser($id) {
      // fetch the AE user
      // Store that user in the database
      // Create a nwe Drupal user
      // Map 1:1 AE user to drupal user

          $state = \Drupal::state();

          $api_key = $state->get('api_key');
          $url = "https://akshay.dev.appreciationengine.com/v1.1/member/" . $id . "?apiKey=" . $api_key;

          $client = \Drupal::httpClient();
          $request = $client->get($url);
          $response = (string) $request->getBody();

          $ae_user = Json::decode($response);

          $user = User::create();
          $user->setPassword('password');
          $user->enforceIsNew();
          $user->setEmail($ae_user->Email);
          $user->setUsername($ae_user->Username);
          $result = $user->save();

          db_insert('ae_user')->fields([
            'aeid' => 1,
            'firstname' => "Akshay",
            'surname' => "Khot",
            'username' => "akki03"
          ])->execute();

          echo $user->uuid();

          exit(0);
    }

    function createNewUser() {
        
    }
}


?>