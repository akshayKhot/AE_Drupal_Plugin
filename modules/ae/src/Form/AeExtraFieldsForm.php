<?php
/**
 * Created by PhpStorm.
 * User: aksha
 * Date: 2017-09-28
 * Time: 1:26 PM
 */

namespace Drupal\ae\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
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

    function __construct()
    {
        $this->fields = [
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

    public function buildForm(array $form, FormStateInterface $form_state) {

        foreach ($this->fields as $field_key=>$field_name) {

            $form['extra_field_' . $field_key] = [
                '#type' => 'fieldset',
                '#title' => $this->t($field_name)
            ];

            $form['extra_field_' . $field_key]['enable_' . $field_key] = [
                '#type' => 'checkbox',
                '#title' => $this->t('Enable')
            ];

            $form['extra_field_' . $field_key]['require_' . $field_key] = [
                '#type' => 'checkbox',
                '#title' => $this->t('Required')
            ];

        }

        return parent::buildForm($form, $form_state);
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        parent::submitForm($form, $form_state);

        $fields = $this->getFieldsData($form_state);
        ksm($fields);
        $state = \Drupal::state();
        $state->set('fields', $fields);
    }


    private function getFieldsData(FormStateInterface $form_state) {

        $fieldsData = [];
        foreach ($this->fields as $field_key=>$field_name) {
            $data = [
                'field' => $field_key,
                'enabled' => $form_state->getValue('enable_' . $field_key),
                'required' => $form_state->getValue('require_' . $field_key)
            ];
            $fieldsData[] = $data;
        }
        return $fieldsData;
    }


}

