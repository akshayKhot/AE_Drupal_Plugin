<?php

namespace Drupal\ae\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Signup' Block.
 *
 * @Block(
 *   id = "signup_block",
 *   admin_label = @Translation("Sign Up"),
 *   category = @Translation("authentication"),
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
            '#attached' => [
                'library' => [
                    'ae/script',
                ],
            ],
        ];

    }

}
?>