<?php 

namespace Drupal\ae\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Component\Serialization\Json;
use Drupal\user\Entity\User;

class LoginController extends ControllerBase {

    public function createuser($aeid, $createlocal, $signinlocal) {

        $drupal_user = NULL;
        if($signinlocal=="true" && $this->drupal_user_exists($aeid)) {
            $drupal_user = $this->fetch_drupal_user($aeid);
        } else if($createlocal=="true") {
            $ae_user = $this->fetch_ae_user($aeid);
            $drupal_user = $this->create_new_drupal_user($ae_user);
            $this->create_local_ae_user($drupal_user, $ae_user);
        }

        if($signinlocal=="true") {
            $this->login_drupal_user($drupal_user);
        }
        echo 1;

        exit(0);
    }

    private function drupal_user_exists($aeid) {
        $uid = $this->fetch_uid_from_aeid($aeid);
        return is_numeric($uid);
    }

    private function fetch_uid_from_aeid($aeid) {
        $uid = db_query("SELECT uid FROM {ae_users} WHERE aeid = :aeid", [':aeid' => $aeid])->fetchField();
        return $uid;
    }

    private function fetch_drupal_user($aeid) {
        $uid = $this->fetch_uid_from_aeid($aeid);
        return \Drupal\user\Entity\User::load($uid);
    }

    private function fetch_ae_user($aeid) {
        $state = \Drupal::state();
        $client = \Drupal::httpClient();

        $api_key = $state->get('api_key');
        $url = "https://akshay.dev.appreciationengine.com/v1.1/member/" . $aeid . "?apiKey=" . $api_key;

        //$url = "https://akshay.dev.appreciationengine.com/v1.1/member/4290847?apiKey=9ee609a0370231ac93149413e00a2ca0";
        $request = $client->get($url);
        $ae_user = $request->getBody();
        $user_json = json_decode($ae_user);
        return $user_json;
    }

    private function create_new_drupal_user($ae_user) {
        $drupal_user = User::create();
        $drupal_user->setPassword('password');
        $drupal_user->enforceIsNew();
        $drupal_user->setEmail($ae_user->data->Email);
        $drupal_user->setUsername($ae_user->data->Username);
        $drupal_user->activate();// NOTE: login will fail silently if not activated!
        $drupal_user->save();

        return $drupal_user;
    }

    private function create_local_ae_user($drupal_user, $ae_user) {
        $uid = $drupal_user->id();

        db_insert('ae_users')->fields([
            'aeid' => $ae_user->data->ID,
            'uid' => $uid,
            'firstname' => $ae_user->data->FirstName,
            'surname' => $ae_user->data->Surname,
            'username' => $ae_user->data->Username
        ])->execute();
    }

    private function login_drupal_user($drupal_user) {
        user_login_finalize($drupal_user);
    }



}


?>