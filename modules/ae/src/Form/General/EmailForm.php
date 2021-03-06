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
        $this->selection = [];
    }

    public function buildForm(array $form, FormStateInterface $form_state) {

        // Options
        $options = array(
          'verify_email' => t('Send Email Verification During Registration'),
          'req_email_verify' => t('Site Requires Verified Email Before Login')
        );

        $selection = $this->state->get('email_options');
        $this->selection = $selection;
        ksm($this->selection);
        $opts = $selection["options"];
        if(isset($opts)) {
            $default_values = array_keys(array_filter($opts));
        }
        else {
            $default_values = [];
        }



        # the drupal checkboxes form field definition
        $form['options'] = array(
            '#title' => t('Options'),
            '#type' => 'checkboxes',
            '#options' => $options,
            '#default_value' => $default_values
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
            '#size' => 100,
            '#maxlength' => 100,
            '#default_value' => $this->returnDefault("background_color")
        );

        $form['format']['font_size'] = array(
            '#id' => 'font_size',
            '#type' => 'textfield',
            '#title' => t('Font Size'),
            '#size' => 100,
            '#maxlength' => 100,
            '#default_value' => $this->returnDefault("font_size")
        );

        $form['format']['font_family'] = array(
            '#id' => 'font_family',
            '#type' => 'textfield',
            '#title' => t('Font Family'),
            '#size' => 100,
            '#maxlength' => 100,
            '#default_value' => $this->returnDefault("font_family")
        );

        $form['format']['font_color'] = array(
            '#id' => 'font_color',
            '#type' => 'textfield',
            '#title' => t('Font Color'),
            '#size' => 100,
            '#maxlength' => 100,
            '#default_value' => $this->returnDefault("font_color")
        );

        //////////////////////// Header ////////////////////////////
        $form['header'] = array(
            '#type' => 'fieldset',
            '#title' => t('Header')
        );

        $form['header']['show_header'] = array(
            '#type' => 'textfield',
            '#title' => t('Show Header'),
            '#size' => 100,
            '#maxlength' => 100,
            '#default_value' => $this->returnDefault("show_header")
        );

        $form['header']['header_background_color'] = array(
            '#type' => 'textfield',
            '#title' => t('Header Background Color'),
            '#size' => 100,
            '#maxlength' => 100,
            '#default_value' => $this->returnDefault("header_background_color")
        );

        $form['header']['header_font_color'] = array(
            '#type' => 'textfield',
            '#title' => t('Header Font Color'),
            '#size' => 100,
            '#maxlength' => 100,
            '#default_value' => $this->returnDefault("header_font_color")
        );

        $form['header']['image_url'] = array(
            '#type' => 'textfield',
            '#title' => t('Header Image URL'),
            '#size' => 100,
            '#maxlength' => 100,
            '#default_value' => $this->returnDefault("image_url")
        );

        //////////////////////// Footer ////////////////////////////
        $form['footer'] = array(
            '#type' => 'fieldset',
            '#title' => t('Footer')
        );

        $form['footer']['show_footer'] = array(
            '#type' => 'textfield',
            '#title' => t('Show Footer'),
            '#size' => 100,
            '#maxlength' => 100,
            '#default_value' => $this->returnDefault("show_footer")
        );

        $form['footer']['footer_background_color'] = array(
            '#type' => 'textfield',
            '#title' => t('Footer Background Color'),
            '#size' => 100,
            '#maxlength' => 100,
            '#default_value' => $this->returnDefault("footer_background_color")
        );

        $form['footer']['footer_font_color'] = array(
            '#type' => 'textfield',
            '#title' => t('Footer Font Color'),
            '#size' => 100,
            '#maxlength' => 100,
            '#default_value' => $this->returnDefault("footer_font_color")
        );

        $form['footer']['logo_link'] = array(
            '#type' => 'textfield',
            '#title' => t('Footer Logo Destination Link'),
            '#size' => 100,
            '#maxlength' => 100,
            '#default_value' => $this->returnDefault("logo_link")
        );

        $form['footer']['logo_img_url'] = array(
            '#type' => 'textfield',
            '#title' => t('Footer Logo Image URL'),
            '#size' => 100,
            '#maxlength' => 100,
            '#default_value' => $this->returnDefault("logo_img_url")
        );

        $form['footer']['copyright'] = array(
            '#type' => 'textfield',
            '#title' => t('Copyright Text'),
            '#size' => 100,
            '#maxlength' => 100,
            '#default_value' => $this->returnDefault("copyright")
        );

        //////////////////////// Verify Email Settings ////////////////////////////
        $form['verify_email'] = array(
            '#type' => 'fieldset',
            '#title' => t('Verify Email Settings')
        );

        $form['verify_email']['verify_email_subject'] = array(
            '#type' => 'textfield',
            '#title' => t('Verify Email Subject'),
            '#size' => 100,
            '#maxlength' => 100,
            '#default_value' => $this->returnDefault("verify_email_subject")
        );

        $form['verify_email']['verify_email_message'] = array(
            '#type' => 'textfield',
            '#title' => t('Verify Email Text'),
            '#size' => 100,
            '#maxlength' => 100,
            '#default_value' => $this->returnDefault("verify_email_message")
        );

        $form['verify_email']['verify_email_link'] = array(
            '#type' => 'textfield',
            '#title' => t('Verify Email Link Text'),
            '#size' => 100,
            '#maxlength' => 100,
            '#default_value' => $this->returnDefault("verify_email_link")
        );

        //////////////////////// Reset Password Settings ////////////////////////////
        $form['reset_password'] = array(
            '#type' => 'fieldset',
            '#title' => t('Reset Password Settings')
        );

        $form['reset_password']['reset_pw_email_subject'] = array(
            '#type' => 'textfield',
            '#title' => t('Reset Password Subject'),
            '#size' => 100,
            '#maxlength' => 100,
            '#default_value' => $this->returnDefault("reset_pw_email_subject")
        );

        $form['reset_password']['reset_pw_email_message'] = array(
            '#type' => 'textfield',
            '#title' => t('Reset Password Text'),
            '#size' => 100,
            '#maxlength' => 100,
            '#default_value' => $this->returnDefault("reset_pw_email_message")
        );

        $form['reset_password']['reset_pw_email_link'] = array(
            '#type' => 'textfield',
            '#title' => t('Reset Email Link Text'),
            '#size' => 100,
            '#maxlength' => 100,
            '#default_value' => $this->returnDefault("reset_pw_email_link")
        );


        return parent::buildForm($form, $form_state);

    }

    public function submitForm(array &$form, FormStateInterface $form_state) {

        parent::submitForm($form, $form_state);

        $form_state->cleanValues();

        $this->state->set('email_options', $form_state->getValues());

    }

    private function returnDefault($value) {

        $ae_defaults = [
            'show_header' => "true",
            'show_footer' => "true",
            'reset_pw_email_subject' => 'Password Reset For ' . $this->state->get('app_name'),
            'reset_pw_email_message' => 'Click the following link to verify your email and reset your password',
            'reset_pw_email_link' => 'Reset Password',
            'verify_email_subject' => 'Please verify your email address for ' . $this->state->get('app_name'),
            'verify_email_message' => 'Click the following link to verify your email and continue with your registration',
            'verify_email_link' => 'Verify Email',
        ];

        if($this->selection[$value] == "") {
            if (array_key_exists($value, $ae_defaults)) {
                return $ae_defaults[$value];
            } else {
                return "";
            }
        }
        else
            return $this->selection[$value];
    }

}

