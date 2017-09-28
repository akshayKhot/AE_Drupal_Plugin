<?php
/**
 * Created by PhpStorm.
 * User: aksha
 * Date: 2017-09-28
 * Time: 1:26 PM
 */

namespace Drupal\ae\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class AeSettingsForm extends ConfigFormBase {

    protected function getEditableConfigNames() {
        return [
            'ae.settings'
        ];
    }

    public function getFormId() {
        return 'ae_settings_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state) {
        $form['flow_css'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Enter the URL for the css')
        ];

        $form['auth_window'] = array(
            '#type' => 'radios',
            '#title' => $this->t('Open modal pop-up?'),
            '#default_value' => 0,
            '#options' => array(0 => $this->t('Yes'), 1 => $this->t('No')),
        );

        $form['email_signup'] = array(
            '#type' => 'radios',
            '#title' => $this->t('Do you want email registration?'),
            '#default_value' => 1,
            '#options' => array(0 => $this->t('Yes'), 1 => $this->t('No')),
        );

        $form['sso'] = array(
            '#type' => 'radios',
            '#title' => $this->t('Do you want to enable single sign on?'),
            '#default_value' => 1,
            '#options' => array(0 => $this->t('Yes'), 1 => $this->t('No')),
        );

        $form['new_user'] = array(
            '#type' => 'radios',
            '#title' => $this->t('Create a new Drupal user?'),
            '#default_value' => 1,
            '#options' => array(0 => $this->t('Yes'), 1 => $this->t('No')),
        );


        return parent::buildForm($form, $form_state);
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        parent::submitForm($form, $form_state);

        $auth_window = $form_state->getValue('auth_window');
        $want_email = $form_state->getValue('email_signup');
        $sso = $form_state->getValue('sso');
        $flow_css = $form_state->getValue('flow_css');
        $new_user = $form_state->getValue('new_user');


        $state = \Drupal::state();
        $state->set('email_signup', $want_email);
        $state->set('auth_window', $auth_window);
        $state->set('sso', $sso);
        $state->set('flow_css', $flow_css);
        $state->set('new_user', $new_user);

        drupal_set_message($flow_css);
    }


}

