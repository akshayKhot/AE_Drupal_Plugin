<?php

namespace Drupal\ae\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class ConfigurationForm extends ConfigFormBase {

    protected function getEditableConfigNames() {
        return [
            'ae.adminsettings'
        ];
    }

    public function getFormId() {
        return 'ae_config_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state) {
        $form['api_key'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Hello World')
        ];
        return parent::buildForm($form, $form_state);
    }

    public function submitForm(array&$form, FormStateInterface $form_state) {
        parent::submitForm($form, $form_state);

        drupal_set_message($form_state->getValue('api_key'));
    }

}


?>