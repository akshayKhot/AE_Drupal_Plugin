<?php

namespace Drupal\ae\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "hello_block",
 *   admin_label = @Translation("Hello block"),
 *   category = @Translation("Hello World"),
 * )
 */
class HelloBlock extends BlockBase {


  public function build() {
    return \Drupal::formBuilder()->getForm('Drupal\ae\Form\SignupForm');
  }

}
?>