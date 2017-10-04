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
          //$url = "https://akshay.dev.appreciationengine.com/v1.1/member/" . $id . "?apiKey=" . $api_key;

          $url = "https://akshay.dev.appreciationengine.com/v1.1/member/4290847?apiKey=9ee609a0370231ac93149413e00a2ca0";
          $client = \Drupal::httpClient();
          $request = $client->get($url);
          $ae_user = $request->getBody();
          $user_json = json_decode($ae_user);

          $user = User::create();
          $user->setPassword('password');
          $user->enforceIsNew();
          $user->setEmail($user_json->data->Email);
          $user->setUsername($user_json->data->Username);
          $result = $user->save();

          db_insert('ae_users')->fields([
            'aeid' => $user_json->data->ID,
            'firstname' => $user_json->data->FirstName,
            'surname' => $user_json->data->Surname,
            'username' => $user_json->data->Username
          ])->execute();

          echo $user_json->data->FirstName;

          exit(0);
    }

    function createNewUser() {
        // Get a new user from the api
        // create a new user
        // add in the database
    }
}


?>