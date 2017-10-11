<?php

namespace Drupal\ae\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "hello_block",
 *   admin_label = @Translation("Sign Up"),
 *   category = @Translation("Hello World"),
 * )
 */
class HelloBlock extends BlockBase {

    public function __construct()
    {
        $this->state = \Drupal::state();
    }

    public function build() {

        $general_settings = $this->state->get('general_settings');

        $user_fields = $this->state->get('user_fields');
        $email_options = $this->state->get('email_options');
        $basic_options = $this->state->get('basic_options');
        $text_options = $this->state->get('text_options');
        $performance_options = $this->state->get('performance_options');

        return [
            '#theme' => 'signup',
            '#socials' => $this->getSelectedSocials(),
//            '#fields' => $this->state->get('fields'),
//            '#want_email' => $this->state->get('email_signup'),
//            '#auth_window' => $this->state->get('auth_window'),
//            '#sso' => $this->state->get('sso'),
//            '#new_user' => $this->state->get('new_user'),
//            '#flow_css' => $this->state->get('flow_css'),
//            '#close_button' => $this->state->get('close_button'),
//            '#date_format' => $this->state->get('date_format'),
//            '#extra_info' => $this->state->get('extra_info'),
//            '#display_error_message' => $this->state->get('display_error_message'),
            '#attached' => [
                'library' => [
                    'ae/script',
                ],
            ],
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