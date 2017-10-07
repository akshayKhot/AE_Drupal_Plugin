<?php
/**
 * Created by PhpStorm.
 * User: aksha
 * Date: 2017-10-06
 * Time: 3:59 PM
 */

namespace Drupal\ae\Form\General;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class SocialsForm extends ConfigFormBase {

    protected function getEditableConfigNames() {
        return [
            'ae.generalSettings'
        ];
    }

    public function getFormId() {
        return 'ae_general_settings_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state) {
        $networks = array(
            'facebook' => t('Facebook'),
            'twitter' => t('Twitter'),
            'google' => t('Google'),
            'tumbler' => t('Tumblr'),
            'instagram' => t('Instagram'),
            'youtube' => t('YouTube'),
            'spotify' => t('Spotify'),

        );

        # the drupal checkboxes form field definition
        $form['options'] = array(
            '#title' => t('Social Networks'),
            '#type' => 'checkboxes',
            '#description' => t('Select the Social Networks for AE.'),
            '#options' => $networks,
        );

        return parent::buildForm($form, $form_state);
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        parent::submitForm($form, $form_state);
    }


}

