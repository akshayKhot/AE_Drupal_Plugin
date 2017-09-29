<?php

namespace Drupal\ae\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class ConfigurationForm extends ConfigFormBase {

    protected function getEditableConfigNames() {
        return [
            'ae.adminsettings'
        ];
    }

    public function getFormId() {
        return 'ae_config_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state) {
        $form['api_key'] = [
            '#type' => 'textfield',
            '#title' => $this->t('API Key')
        ];

        $form['base_url'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Base URL')
        ];

        return parent::buildForm($form, $form_state);
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        parent::submitForm($form, $form_state);

        $api_key = $form_state->getValue('api_key');
        $base_url = $form_state->getValue('base_url');

        $config_str = $this->getConfig($base_url, $api_key);

        $state = \Drupal::state();
        $state->set('api_key', $api_key);
        $state->set('config', $config_str);
        //drupal_set_message($config_str);
    }

    private function getConfig($base_url, $api_key) {

        $url = $base_url . '/v1.1/app/info?apiKey=' . $api_key . '&turnoffdebug=1';
        
        $client = \Drupal::httpClient();
        $request = $client->get($url);
        //ksm($request->getBody());
        $response = (string) $request->getBody();
        drupal_set_message($response);
        return $response;
    }
}


?>