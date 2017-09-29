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

class AeExtraFieldsForm extends ConfigFormBase {

    protected function getEditableConfigNames() {
        return [
            'ae.extrafields'
        ];
    }

    public function getFormId() {
        return 'ae_extra_fields_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state) {

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

        $state = \Drupal::state();
        $state->set('fields', $fields);
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

