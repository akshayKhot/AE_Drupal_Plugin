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

        $form['close_button'] = array(
            '#type' => 'radios',
            '#title' => $this->t('Close Button?'),
            '#default_value' => 0,
            '#options' => array(0 => $this->t('Yes'), 1 => $this->t('No'))
        );

        $form['date_format'] = array(
            '#type' => 'radios',
            '#title' => $this->t('Date Format'),
            '#default_value' => 'DD-MM-YYYY',
            '#options' => array('MM-DD-YYYY' => $this->t('MM-DD-YYYY'), 'DD-MM-YYYY' => $this->t('DD-MM-YYYY'))
        );

        $form['email_signup'] = array(
            '#type' => 'radios',
            '#title' => $this->t('Do you want email registration?'),
            '#default_value' => 1,
            '#options' => array(0 => $this->t('Yes'), 1 => $this->t('No')),
        );

        $form['display_error_message'] = array(
            '#type' => 'radios',
            '#title' => $this->t('Display Error Message?'),
            '#default_value' => 0,
            '#options' => array(0 => $this->t('Yes'), 1 => $this->t('No')),
        );

        $form['sso'] = array(
            '#type' => 'radios',
            '#title' => $this->t('Single Sign On?'),
            '#default_value' => 'application',
            '#options' => array('application' => $this->t('application'), 'local' => $this->t('local')),
        );

        $form['new_user'] = array(
            '#type' => 'radios',
            '#title' => $this->t('Create a new Drupal user?'),
            '#default_value' => 1,
            '#options' => array(0 => $this->t('Yes'), 1 => $this->t('No')),
        );

        $form['extra_fields'] = array(
            '#type' => 'checkboxes',
            '#options' => $this->getFields(),
            '#title' => $this->t('Required Fields'),
            '#description' => $this->t('Define fields you require to be collected.')
        );


        return parent::buildForm($form, $form_state);
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        parent::submitForm($form, $form_state);

        $fields = $this->getSelectedFields($form_state);
        $auth_window = $form_state->getValue('auth_window');
        $want_email = $form_state->getValue('email_signup');
        $sso = $form_state->getValue('sso');
        $flow_css = $form_state->getValue('flow_css');
        $new_user = $form_state->getValue('new_user');
        $close_button = $form_state->getValue('close_button');
        $date_format = $form_state->getValue('date_format');
        $display_error_message = $form_state->getValue('display_error_message');

        drupal_set_message($want_email);

        $state = \Drupal::state();
        $state->set('email_signup', $want_email);
        $state->set('auth_window', $auth_window);
        $state->set('sso', $sso);
        $state->set('flow_css', $flow_css);
        $state->set('new_user', $new_user);
        $state->set('fields', $fields);
        $state->set('close_button', $close_button);
        $state->set('date_format', $date_format);
        $state->set('display_error_message', $display_error_message);

        drupal_set_message($flow_css);
    }

    private function getFields() {
        return [
            'email' => "Email",
            'password' => "Password",
            'birthdate' => "Date Of Birth",
            'address' => "Address",
            'addressline2' => "Address Line 2",
            'city' => "City",
            'state' => "State",
            'homephone' => "Home Phone",
            'mobilephone' => "Mobile Phone",
            'firstname' => "First Name",
            'username' => "Username",
            'website' => "Website",
            'bio' => "Bio",
            'gender' => "Gender",
            'surname' => "Last Name",
            'postcode' => "Zipcode",
            'country' => "Country"
        ];
    }

    private function getSelectedFields(FormStateInterface $form_state) {
        $fields = $form_state->getValue('extra_fields');
        $fields = array_diff($fields, [0]);
        return $fields;
    }


}

