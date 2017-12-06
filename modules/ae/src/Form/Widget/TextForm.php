<?php
/**
 * Created by PhpStorm.
 * User: aksha
 * Date: 2017-10-06
 * Time: 5:24 PM
 */

namespace Drupal\ae\Form\Widget;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class TextForm extends ConfigFormBase {

    protected function getEditableConfigNames() {
        return [
            'ae.generalSettings'
        ];
    }

    public function getFormId() {
        return 'ae_general_settings_form';
    }

    function __construct()
    {
        $this->state = \Drupal::state();
        $this->selection = [];
    }

    public function buildForm(array $form, FormStateInterface $form_state) {

        $selection = $this->state->get('text_options');
        $this->selection = $selection;
        ksm($this->selection);

        $form['header'] = array(
            '#type' => 'textarea',
            '#title' => $this->t('Header(text or html)'),
            '#default_value' => $this->returnDefault("header")
        );

        $form['footer'] = array(
            '#type' => 'textarea',
            '#title' => $this->t('Footer(text or html)'),
            '#default_value' => $this->returnDefault("footer")
        );

        $form['labels'] = array(
            '#type' => 'fieldset',
            '#title' => t('Labels and Messages'),
        );

        $form['labels']['error_header'] = array(
            '#type' => 'textfield',
            '#title' => t('Error Screen title'),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("error_header")
        );

        $form['labels']['login_header'] = array(
            '#type' => 'textfield',
            '#title' => t('Login Screen Title'),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("login_header")
        );

        $form['labels']['login_button'] = array(
            '#type' => 'textfield',
            '#title' => t('Email Login Button Text'),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("login_button")
        );

        $form['labels']['login_with_button'] = array(
            '#type' => 'textfield',
            '#title' => t('Social Login Button Text'),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("login_with_button")
        );

        $form['labels']['register_header'] = array(
            '#type' => 'textfield',
            '#title' => t('Register Screen title'),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("register_header")
        );

        $form['labels']['register_button'] = array(
            '#type' => 'textfield',
            '#title' => t('Email Register Button Text'),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("register_button")
        );

        $form['labels']['register_with_button'] = array(
            '#type' => 'textfield',
            '#title' => t('Social Register Button Text'),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("register_with_button")

        );$form['labels']['add_info_header'] = array(
            '#type' => 'textfield',
            '#title' => t('Additional Data Screen Header'),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("add_info_header")
        );

        $form['labels']['add_info_button'] = array(
            '#type' => 'textfield',
            '#title' => t('Additional Data Submit Button'),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("add_info_button")
        );

        $form['labels']['reset_pw_header'] = array(
            '#type' => 'textfield',
            '#title' => t('Reset Password Send Screen Header'),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("reset_pw_header")

        );$form['labels']['reset_pw_sent'] = array(
            '#type' => 'textfield',
            '#title' => t('Reset Password Send Screen Message'),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("reset_pw_sent")
        );

        $form['labels']['reset_pw_instructions'] = array(
            '#type' => 'textfield',
            '#title' => t('Reset Password Send Screen Instructions'),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("reset_pw_instructions")
        );

        $form['labels']['reset_pw_button'] = array(
            '#type' => 'textfield',
            '#title' => t('Reset Password Send Button Text'),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("reset_pw_button")
        );

        $form['labels']['reset_pw_confirm_header'] = array(
            '#type' => 'textfield',
            '#title' => t('Reset Password Confirm Screen Header '),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("reset_pw_confirm_header")
        );

        $form['labels']['reset_pw_confirm_button'] = array(
            '#type' => 'textfield',
            '#title' => t('Reset Password Confirm button Text '),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("reset_pw_confirm_button")
        );

        $form['labels']['reset_pw_confirm_instructions'] = array(
            '#type' => 'textfield',
            '#title' => t('Reset Password Confirm Screen Instructions'),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("reset_pw_confirm_instructions")
        );

        $form['labels']['reset_pw_done_header'] = array(
            '#type' => 'textfield',
            '#title' => t('Reset Password Success Screen Header'),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("reset_pw_done_header")
        );

        $form['labels']['reset_pw_done_message'] = array(
            '#type' => 'textfield',
            '#title' => t('Reset Password Success Screen Message'),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("reset_pw_done_message")
        );

        $form['labels']['reset_pw_done_button'] = array(
            '#type' => 'textfield',
            '#title' => t('Reset Password Success OK Button '),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("reset_pw_done_button")
        );

        $form['labels']['verify_email_header'] = array(
            '#type' => 'textfield',
            '#title' => t('Verify Email Screen Header'),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("verify_email_header")
        );

        $form['labels']['verify_email_sent'] = array(
            '#type' => 'textfield',
            '#title' => t('Verify Email Screen Message'),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("verify_email_sent")
        );

        $form['labels']['verify_email_instructions'] = array(
            '#type' => 'textfield',
            '#title' => t('Verify Email Screen Instructions'),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("verify_email_instructions")
        );

        $form['labels']['verify_email_retry_button'] = array(
            '#type' => 'textfield',
            '#title' => t('Verify Email Screen Retry Button'),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("verify_email_retry_button")
        );

        $form['labels']['verify_email_success_message'] = array(
            '#type' => 'textfield',
            '#title' => t('Verify Email Success Screen Message'),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("verify_email_success_message")
        );

        $form['labels']['verify_email_success_button'] = array(
            '#type' => 'textfield',
            '#title' => t('Verify Email Success OK Button'),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("verify_email_success_button")
        );

        $form['labels']['verify_email_error_header'] = array(
            '#type' => 'textfield',
            '#title' => t('Verify Email Error Screen Header'),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("verify_email_error_header")
        );

        $form['labels']['verify_email_error_message'] = array(
            '#type' => 'textfield',
            '#title' => t('Verify Email Error Screen Message'),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("verify_email_error_message")
        );

        $form['labels']['forgot_password_link'] = array(
            '#type' => 'textfield',
            '#title' => t('Forgot Password Link Text'),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("forgot_password_link")
        );

        $form['labels']['optins_title'] = array(
            '#type' => 'textfield',
            '#title' => t('Opt-in Title Text'),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("optins_title")
        );

        $form['labels']['have_account_link'] = array(
            '#type' => 'textfield',
            '#title' => t('Existing Account Link Text'),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("have_account_link")
        );

        $form['labels']['need_help_link'] = array(
            '#type' => 'textfield',
            '#title' => t('Help Link Text'),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("need_help_link")
        );

        $form['labels']['create_account_link'] = array(
            '#type' => 'textfield',
            '#title' => t('Create Account Link Text'),
            '#size' => 150,
            '#maxlength' => 150,
            '#default_value' => $this->returnDefault("create_account_link")
        );

        return parent::buildForm($form, $form_state);
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {

        parent::submitForm($form, $form_state);

        $form_state->cleanValues();

        $this->state->set('text_options', $form_state->getValues());

    }

    private function returnDefault($value) {
        $ae_defaults = [
            'error_header' => 'Sorry, there seems to be a problem',
            'login_header' => 'Sign In',
            'login_button' => 'Sign In',
            'login_with_button' => 'Sign in with',
            'register_header' => 'Sign Up',
            'register_button' => 'Sign Up',
            'register_with_button' => 'Sign up with',
            'add_info_header' => 'Additional Information',
            'add_info_button' => 'Submit',
            'reset_pw_header' => 'Reset Password',
            'reset_pw_sent' => 'A verification email will be sent to',
            'reset_pw_instructions' => 'Please click the link in the email to confirm your address and reset your password.',
            'reset_pw_button' => 'Verify Email',
            'reset_pw_confirm_header' => 'Reset Password - Confirm',
            'reset_pw_confirm_button' => 'Confirm',
            'reset_pw_confirm_instructions' => 'Please enter a new password',
            'reset_pw_done_header' => 'Reset Password - Done!',
            'reset_pw_done_message' => 'Your password has been reset.',
            'reset_pw_done_button' => 'OK',
            'verify_email_header' => 'Verify Email',
            'verify_email_sent' => 'A verification email will be sent to',
            'verify_email_instructions' => 'Please click the link in the email to confirm your address and continue.',
            'verify_email_retry_button' => 'Retry',
            'verify_email_success_header' => 'Success.',
            'verify_email_success_message' => 'Your email was successfully verified.',
            'verify_email_success_button' => 'OK',
            'verify_email_error_header' => 'Sorry.',
            'verify_email_error_message' => 'That is not a valid activation url, or the url has expired. Please double check your email, or trigger a new activation email.',
            'forgot_password_link' => 'forgot password?',
            'recover_password_link' => 'Recover Password',
            'optins_title' => 'Subscribe to these mailing lists',
            'have_account_link' => 'Have an account?',
            'need_help_link' => 'need help?',
            'create_account_link' => 'create an account'
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
