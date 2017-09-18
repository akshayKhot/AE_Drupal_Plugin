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

        $state = \Drupal::state();

        $config = json_decode($state->get('config'));
        $urls = $config->Urls;

        // $socials = $state->get('socials');
        // $socials = explode("|", $socials);
        // $socials = array_diff($socials, [0]);

        foreach ($urls as $url) {
            $form['socials'][$url->Name] = [
                '#type' => 'button',
                '#value' => $url->Name
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