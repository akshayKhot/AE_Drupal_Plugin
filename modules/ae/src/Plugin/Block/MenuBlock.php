<?php

namespace Drupal\ae\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Header Menu' Block.
 *
 * @Block(
 *   id = "ae_menu",
 *   admin_label = @Translation("AE Menu"),
 *   category = @Translation("Menu"),
 * )
 */
class MenuBlock extends BlockBase {

    public function __construct()
    {
        $this->state = \Drupal::state();
    }

    public function build() {

        return [
            '#theme' => 'aemenu',

            '#socials' => $this->getSelectedSocials(),
            '#framework_url' => $this->state->get('framework_url'),
            '#fields' => $this->state->get('fields'),
            '#general_settings' => $this->state->get('general_settings'),
            '#basic_options' => $this->state->get('basic_options'),
            '#email_options' => $this->state->get('email_options'),
            '#text_options' => $this->state->get('text_options'),
            '#performance_options' => $this->state->get('performance_options'),

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