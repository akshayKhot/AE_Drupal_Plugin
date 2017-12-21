<?php
namespace Drupal\ae\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * This file displays the AE Connect login/register form,
 * It's displayed on the Drupal home page as well as when the route is /ae-connect
 */
class AeConnectController extends ControllerBase {


    public function __construct()
    {
        $this->state = \Drupal::state();
    }

    public function connect() {

        return [
            '#theme' => 'signup',

            '#socials' => $this->getSelectedSocials(),
            '#fields' => $this->state->get('fields'),
        ];

    }

    public function getSelectedSocials() {
        $socials = [];

        $social_networks = $this->state->get('socials')['socials'];
        foreach($social_networks as $social=>$text) {
            if($text != 0 || $text != "0")
                $socials[] = $text;
        }

        return $socials;
    }

}