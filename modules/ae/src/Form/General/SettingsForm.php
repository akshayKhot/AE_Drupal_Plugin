<?php
/**
 * Created by PhpStorm.
 * User: aksha
 * Date: 2017-10-06
 * Time: 3:59 PM
 */

namespace Drupal\ae\Form\General;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class SettingsForm extends ConfigFormBase {

    protected function getEditableConfigNames() {
        return [
            'ae.generalSettings'
        ];
    }

    public function getFormId() {
        return 'ae_general_settings_form';
    }

    function __construct()
    {
        $this->state = \Drupal::state();
    }

    public function buildForm(array $form, FormStateInterface $form_state) {
        $options = array(
            'auth_window' => t('Show Authentication as Popup'),
            'error_message' => t('Display Default Error Message'),
            'auto_detect' => t('Device Auto-Detect'),
            'multi_site_login' => t('Enable Multi-Site Login'),
            'social_login' => t('Social Login Only'),
        );

        # the drupal checkboxes form field definition
        $form['options'] = array(
            '#title' => t('Options'),
            '#type' => 'checkboxes',
            '#options' => $options,
            '#default_value' => array("auth_window", "error_message", "auto_detect", "multi_site_login")
        );

        return parent::buildForm($form, $form_state);
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {

        parent::submitForm($form, $form_state);

        $form_state->cleanValues();

        $this->state->set('general_settings', $form_state->getValues());

    }


}

