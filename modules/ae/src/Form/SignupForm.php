<?php

namespace Drupal\ae\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class SignupForm extends FormBase {
    /**
    * Determines the ID of the form.
    */
    public function getFormId() {
        return 'signup_block_form';
    }

    /**
    * Gets the configuration names that will be editable.
    */
    public function getEditableConfigNames() {
        return array();
    }

    /**
    * Form submission handler.
    */
    public function submitForm(array &$form, FormStateInterface $form_state) {
    }

    /**
    * Form constructor.
    */
    public function buildForm(array $form, FormStateInterface $form_state) {

        $settings = $this->ae_get_settings();
        $api_key = $settings['api_key'];

        $form['email'] = [
            '#type' => 'email',
            '#title' => $api_key//$this->t('Email')
        ];

        $form['password'] = [
            '#type' => 'password',
            '#title' => $this->t('Password')
        ];

        $form['signup'] = [
            '#type' => 'button',
            '#value' => 'Sign Up'
        ];

        return $form;

    }

    private function ae_get_settings() {
        
          // Container.
          $settings = array();
        
          // Read settings.
          $results = db_query("SELECT api_key FROM {ae_config}");
          foreach ($results as $result) {
            $settings['api_key'] = $result->api_key;
          }
          return $settings;
        }


}