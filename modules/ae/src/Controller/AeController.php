<?php 

namespace Drupal\ae\Controller;

use Drupal\Core\Controller\ControllerBase;

class AeController extends ControllerBase {

    public function welcome() {
        return [
            '#markup' => $this->t('Hello World')
        ];
    }
}

?>