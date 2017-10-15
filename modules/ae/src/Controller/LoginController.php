<?php 

namespace Drupal\ae\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Component\Serialization\Json;
use Drupal\user\Entity\User;

class LoginController extends ControllerBase {

    public function createuser($aeid) {

        $uid = $this->fetch_uid_from_aeid($aeid);

        $drupal_user_exists = is_numeric($uid);

        $drupal_user = NULL;
        if($drupal_user_exists) {
            $drupal_user = $this->fetch_drupal_user($uid);
            user_login_finalize($drupal_user);
            echo 1;
        } else {
//            $ae_user = fetch_ae_user();
//            $drupal_user = create_new_drupal_user($ae_user);
//            create_local_ae_user($drupal_user);
            echo 200;
        }

        //login_drupal_user($drupal_user);

        exit(0);
    }

    private function fetch_drupal_user($uid) {
        return \Drupal\user\Entity\User::load($uid);
    }

    private function fetch_ae_user($id) {

    }

    private function login_ae_user() {

    }

    private function fetch_uid_from_aeid($aeid) {
        $uid = db_query("SELECT uid FROM {ae_users} WHERE aeid = :aeid", [':aeid' => $aeid])->fetchField();
        return $uid;
    }

    //public function createuser($id) {

//        $ae_user = $this->fetchAeUser($id);
//
//        $drupal_user = User::create();
//        $drupal_user->setPassword('password');
//        $drupal_user->enforceIsNew();
//        $drupal_user->setEmail($ae_user->data->Email);
//        $drupal_user->setUsername($ae_user->data->Username);
//
//        // log in user
//        $drupal_user->activate();// NOTE: login will fail silently if not activated!
//        $drupal_user->save();
//        user_login_finalize($drupal_user);
//
//        $uid = $drupal_user->id();
//
//        db_insert('ae_users')->fields([
//            'aeid' => $ae_user->data->ID,
//            'uid' => $uid,
//            'firstname' => $ae_user->data->FirstName,
//            'surname' => $ae_user->data->Surname,
//            'username' => $ae_user->data->Username
//        ])->execute();
//
//        echo $uid;
//
//        exit(0);
    //}

    private function fetchAeUser($id) {
        $state = \Drupal::state();

        $api_key = $state->get('api_key');
        $url = "https://akshay.dev.appreciationengine.com/v1.1/member/" . $id . "?apiKey=" . $api_key;

        //$url = "https://akshay.dev.appreciationengine.com/v1.1/member/4290847?apiKey=9ee609a0370231ac93149413e00a2ca0";
        $client = \Drupal::httpClient();
        $request = $client->get($url);
        $ae_user = $request->getBody();
        $user_json = json_decode($ae_user);
        return $user_json;
    }
}


?>