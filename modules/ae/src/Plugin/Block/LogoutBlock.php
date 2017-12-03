<?php

namespace Drupal\ae\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Logout' Block.
 *
 * @Block(
 *   id = "logout_block",
 *   admin_label = @Translation("Logout block"),
 *   category = @Translation("Logout"),
 * )
 */
class LogoutBlock extends BlockBase {

    /**
     * {@inheritdoc}
     */
//    public function build() {
//        return array(
//            '#markup' => $this->t('Logout'),
//        );
//    }

    public function build() {

        return [
            '#theme' => 'logout',

            '#attached' => [
                'library' => [
                    'ae/script',
                ],
            ],
        ];

    }

}