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
        $socials = explode("|", $settings['socials']);
        $socials = array_diff($socials, [0]);

        foreach ($socials as $social) {
            $form['socials'][$social] = [
                '#type' => 'button',
                '#value' => $social
              ];
        }
       
        $form['email'] = [
            '#type' => 'email',
            '#title' => $this->t('Email')
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
          $results = db_query("SELECT api_key, social_logins FROM {ae_config}");
          foreach ($results as $result) {
            $settings['api_key'] = $result->api_key;
            $settings['socials'] = $result->social_logins;
          }
          return $settings;
        }


}