<?php
/**
 * Created by PhpStorm.
 * User: aksha
 * Date: 2017-10-06
 * Time: 5:24 PM
 */

namespace Drupal\ae\Form\Widget;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class TextForm extends ConfigFormBase {

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
        $form['header'] = array(
            '#type' => 'textarea',
            '#title' => $this->t('Header(text or html)')
        );

        $form['footer'] = array(
            '#type' => 'textarea',
            '#title' => $this->t('Footer(text or html)'),
        );

        $form['labels'] = array(
            '#type' => 'fieldset',
            '#title' => t('Labels and Messages')
        );


        $form['labels']['error_screen'] = array(
            '#type' => 'textfield',
            '#title' => t('Error Screen title'),
            '#size' => 60,
            '#maxlength' => 60,
        );

        $form['labels']['logic_screen'] = array(
            '#type' => 'textfield',
            '#title' => t('Logic Screen Title'),
            '#size' => 60,
            '#maxlength' => 60,
        );

        $form['labels']['email_login'] = array(
            '#type' => 'textfield',
            '#title' => t('Email Login Button Text'),
            '#size' => 60,
            '#maxlength' => 60,
        );

        return parent::buildForm($form, $form_state);
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {

        parent::submitForm($form, $form_state);

        $form_state->cleanValues();

        $this->state->set('text_options', $form_state->getValues());

    }


}
