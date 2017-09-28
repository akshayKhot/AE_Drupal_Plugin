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

class ExtraInfoForm extends ConfigFormBase {

    protected function getEditableConfigNames() {
        return [
            'ae.extraInfo'
        ];
    }

    public function getFormId() {
        return 'ae_extrainfo_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state) {
        $form['extra_info'] = [
            '#type' => 'fieldset',
            '#title' => $this->t('Extra Information')
        ];
        $form['extra_info']['Global'] = [
            '#type' => 'item',
            '#title' => $this->t('Global')
        ];
        $form['extra_info']['global_top'] = [
            '#type' => 'fieldset',
            '#title' => $this->t('Top')
        ];
        $form['extra_info']['global_top']['text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Text')
        ];
        $form['extra_info']['global_top']['title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Title')
        ];
        $form['extra_info']['global_bottom'] = [
            '#type' => 'fieldset',
            '#title' => $this->t('Bottom')
        ];
        $form['extra_info']['global_bottom']['text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Text')
        ];
        $form['extra_info']['global_bottom']['title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Title')
        ];

        $form['extra_info']['Login'] = [
            '#type' => 'item',
            '#title' => $this->t('Login')
        ];
        $form['extra_info']['login_top'] = [
            '#type' => 'fieldset',
            '#title' => $this->t('Top')
        ];
        $form['extra_info']['login_top']['text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Text')
        ];
        $form['extra_info']['login_top']['title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Title')
        ];
        $form['extra_info']['login_bottom'] = [
            '#type' => 'fieldset',
            '#title' => $this->t('Bottom')
        ];
        $form['extra_info']['login_bottom']['text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Text')
        ];
        $form['extra_info']['login_bottom']['title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Title')
        ];


        return parent::buildForm($form, $form_state);
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        parent::submitForm($form, $form_state);

        $global_top_text = $form_state->getValue(['extra_info','global_top','text']);
        $global_top_title = $form_state->getValue(['extra_info','global_top','title']);
        $global_bottom_text = $form_state->getValue(['extra_info','global_bottom','text']);
        $global_bottom_title = $form_state->getValue(['extra_info','global_bottom','title']);

        $login_top_text = $form_state->getValue(['extra_info','login_top','text']);
        $login_top_title = $form_state->getValue(['extra_info','login_top','title']);
        $login_bottom_text = $form_state->getValue(['extra_info','login_bottom','text']);
        $login_bottom_title = $form_state->getValue(['extra_info','login_bottom','title']);

        $extra_info = [
            'global_top_text' => $global_top_text,
            'global_top_title' => $global_top_title,
            'global_bottom_text' => $global_bottom_text,
            'global_bottom_title' => $global_bottom_title
        ];

        $state = \Drupal::state();
        $state->set('extra_info', $extra_info);

    }


}

