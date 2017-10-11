<?php
/**
 * Created by PhpStorm.
 * User: aksha
 * Date: 2017-09-28
 * Time: 1:26 PM
 */

namespace Drupal\ae\Form\General;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class EmailForm extends ConfigFormBase {

    protected function getEditableConfigNames() {
        return [
            'ae.email'
        ];
    }

    public function getFormId() {
        return 'ae_email_form';
    }

    function __construct()
    {
        $this->state = \Drupal::state();
    }

    public function buildForm(array $form, FormStateInterface $form_state) {

        // Options
        $options = array(
          'verify_email' => t('Send Email Verification During Registration'),
          'req_email_verify' => t('Site Requires Verified Email Before Login')
        );

        # the drupal checkboxes form field definition
        $form['options'] = array(
          '#title' => t('Options'),
          '#type' => 'checkboxes',
          '#options' => $options,
        );

//////////////////////// Format ////////////////////////////
        ///
        $form['format'] = array(
            '#type' => 'fieldset',
            '#title' => t('Format')
        );

        $form['format']['background_color'] = array(
            '#id' => 'bg_color',
            '#type' => 'textfield',
            '#title' => t('Background Color'),
            '#size' => 60,
            '#maxlength' => 60,
        );

        $form['format']['font_size'] = array(
            '#id' => 'font_size',
            '#type' => 'textfield',
            '#title' => t('Font Size'),
            '#size' => 60,
            '#maxlength' => 60,
        );

        $form['format']['font_family'] = array(
            '#id' => 'font_family',
            '#type' => 'textfield',
            '#title' => t('Font Family'),
            '#size' => 60,
            '#maxlength' => 60,
        );

        $form['format']['font_color'] = array(
            '#id' => 'font_color',
            '#type' => 'textfield',
            '#title' => t('Font Color'),
            '#size' => 60,
            '#maxlength' => 60,
        );

        //////////////////////// Header ////////////////////////////
        $form['header'] = array(
            '#type' => 'fieldset',
            '#title' => t('Header')
        );

        $form['header']['show_header'] = array(
            '#type' => 'textfield',
            '#title' => t('Show Header'),
            '#size' => 60,
            '#maxlength' => 60,
        );

        $form['header']['header_bg_color'] = array(
            '#type' => 'textfield',
            '#title' => t('Header Background Color'),
            '#size' => 60,
            '#maxlength' => 60,
        );

        $form['header']['header_font_color'] = array(
            '#type' => 'textfield',
            '#title' => t('Header Font Color'),
            '#size' => 60,
            '#maxlength' => 60,
        );

        $form['header']['header_img_url'] = array(
            '#type' => 'textfield',
            '#title' => t('Header Image URL'),
            '#size' => 60,
            '#maxlength' => 60,
        );

        //////////////////////// Footer ////////////////////////////
        $form['footer'] = array(
            '#type' => 'fieldset',
            '#title' => t('Footer')
        );

        $form['footer']['show_footer'] = array(
            '#type' => 'textfield',
            '#title' => t('Show Footer'),
            '#size' => 60,
            '#maxlength' => 60,
        );

        $form['footer']['footer_bg_color'] = array(
            '#type' => 'textfield',
            '#title' => t('Footer Background Color'),
            '#size' => 60,
            '#maxlength' => 60,
        );

        $form['footer']['footer_font_color'] = array(
            '#type' => 'textfield',
            '#title' => t('Footer Font Color'),
            '#size' => 60,
            '#maxlength' => 60,
        );

        $form['footer']['footer_logo_dest_link'] = array(
            '#type' => 'textfield',
            '#title' => t('Footer Logo Destination Link'),
            '#size' => 60,
            '#maxlength' => 60,
        );

        $form['footer']['footer_logo_img_url'] = array(
            '#type' => 'textfield',
            '#title' => t('Footer Logo Image URL'),
            '#size' => 60,
            '#maxlength' => 60,
        );

        $form['footer']['copyright_text'] = array(
            '#type' => 'textfield',
            '#title' => t('Copyright Text'),
            '#size' => 60,
            '#maxlength' => 60,
        );

        //////////////////////// Verify Email Settings ////////////////////////////
        $form['verify_email'] = array(
            '#type' => 'fieldset',
            '#title' => t('Verify Email Settings')
        );

        $form['verify_email']['email_subject'] = array(
            '#type' => 'textfield',
            '#title' => t('Verify Email Subject'),
            '#size' => 60,
            '#maxlength' => 60,
        );

        $form['verify_email']['email_text'] = array(
            '#type' => 'textfield',
            '#title' => t('Verify Email Text'),
            '#size' => 60,
            '#maxlength' => 60,
        );

        $form['verify_email']['email_link_text'] = array(
            '#type' => 'textfield',
            '#title' => t('Verify Email Link Text'),
            '#size' => 60,
            '#maxlength' => 60,
        );

        //////////////////////// Reset Password Settings ////////////////////////////
        $form['reset_password'] = array(
            '#type' => 'fieldset',
            '#title' => t('Reset Password Settings')
        );

        $form['reset_password']['subject'] = array(
            '#type' => 'textfield',
            '#title' => t('Reset Password Subject'),
            '#size' => 60,
            '#maxlength' => 60,
        );

        $form['reset_password']['text'] = array(
            '#type' => 'textfield',
            '#title' => t('Reset Password Text'),
            '#size' => 60,
            '#maxlength' => 60,
        );

        $form['reset_password']['link_text'] = array(
            '#type' => 'textfield',
            '#title' => t('Reset Email Link Text'),
            '#size' => 60,
            '#maxlength' => 60,
        );


        return parent::buildForm($form, $form_state);

    }

    public function submitForm(array &$form, FormStateInterface $form_state) {

        parent::submitForm($form, $form_state);

        $form_state->cleanValues();

        $this->state->set('email_options', $form_state->getValues());
    }

}

