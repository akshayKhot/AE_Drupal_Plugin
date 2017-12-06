<?php
/**
 * Created by PhpStorm.
 * User: aksha
 * Date: 2017-11-10
 * Time: 1:32 PM
 */

namespace Drupal\ae\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'User Management' Block.
 *
 * @Block(
 *   id = "user_mgmt_block",
 *   admin_label = @Translation("AE User Mgmt."),
 *   category = @Translation("Forms"),
 * )
 */

class AeUserBlock extends BlockBase{

    public function __construct()
    {
        $this->state = \Drupal::state();
    }

    public function build() {

        return [
            '#theme' => 'aeusermgmt',
            '#heading' => 'Change Password'
        ];

    }

}