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
}