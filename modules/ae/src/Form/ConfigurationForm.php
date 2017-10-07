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

    function __construct()
    {
        $this->client = \Drupal::httpClient();
        $this->state = \Drupal::state();
    }

    public function buildForm(array $form, FormStateInterface $form_state) {

        $form['base_url'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Base URL')
        ];

        $form['api_key'] = [
            '#type' => 'textfield',
            '#title' => $this->t('API Key')
        ];

        return parent::buildForm($form, $form_state);
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        parent::submitForm($form, $form_state);

        $api_key = $form_state->getValue('api_key');
        $base_url = $form_state->getValue('base_url');

        $config = $this->getConfig($base_url, $api_key);
        $this->state->set('api_key', $api_key);
        $this->state->set('config', $config);
    }

    private function getConfig($base_url, $api_key) {

        $url = $base_url . '/v1.1/app/info?apiKey=' . $api_key . '&turnoffdebug=1';

        $request = $this->client->get($url);
        $response = $request->getBody();

        $config = json_decode($response);
        return $config;
    }
}


?>