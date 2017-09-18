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

        
        return parent::buildForm($form, $form_state);
    }

    public function submitForm(array&$form, FormStateInterface $form_state) {
        parent::submitForm($form, $form_state);

        $api_key = $form_state->getValue('api_key');
        $config_str = $this->getConfig($api_key);
        
        $state = \Drupal::state();
        $state->set('api_key', $api_key);
        $state->set('config', $config_str);

    }

    private function getConfig($api_key) {

        $url = 'https://akshay.dev.appreciationengine.com/v1.1/app/info?apiKey=' . $api_key . '&turnoffdebug=1';
        
        $client = \Drupal::httpClient();
        $request = $client->get($url);   
        $response = (string) $request->getBody();

        return $response;
    }
}


?>