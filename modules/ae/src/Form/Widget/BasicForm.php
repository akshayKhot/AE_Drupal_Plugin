<?php
/**
 * Created by PhpStorm.
 * User: aksha
 * Date: 2017-10-06
 * Time: 5:23 PM
 */

namespace Drupal\ae\Form\Widget;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class BasicForm extends ConfigFormBase {

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
            'show_ep_button' => t('Show Email/Password as Button')
        );

        # the drupal checkboxes form field definition
        $form['options'] = array(
            '#title' => t('Options'),
            '#type' => 'checkboxes',
            '#options' => $options,
        );

        // Font Size
        $form['style_url'] = array(
            '#type' => 'textfield',
            '#title' => t('Stylesheet URL'),
            '#size' => 60,
            '#maxlength' => 60,
        );

        // Font Family
        $form['form_validation_language'] = array(
            '#type' => 'select',
            '#title' => t('Form Validation Language'),
            '#options' => [
                '1' => $this->t('English'),
                '2' => $this->t('French'),
                '3' => $this->t('Spanish'),
            ]
        );


        return parent::buildForm($form, $form_state);
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {

        parent::submitForm($form, $form_state);

        $form_state->cleanValues();

        $this->state->set('basic_options', $form_state->getValues());

    }


}
