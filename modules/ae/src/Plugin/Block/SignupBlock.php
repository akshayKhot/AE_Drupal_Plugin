<?php

namespace Drupal\ae\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Signup' Block.
 *
 * @Block(
 *   id = "signup_block",
 *   admin_label = @Translation("AE Connect"),
 *   category = @Translation("Forms"),
 * )
 */
class SignupBlock extends BlockBase {

    public function __construct()
    {
        $this->state = \Drupal::state();
    }

    public function build() {

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
?>