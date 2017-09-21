<?php

namespace Drupal\ae\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "hello_block",
 *   admin_label = @Translation("Sign Up"),
 *   category = @Translation("Hello World"),
 * )
 */
class HelloBlock extends BlockBase {

    public function __construct()
    {
        $this->state = \Drupal::state();
    }

    public function blockForm($form, FormStateInterface $form_state) {
        $form = parent::blockForm($form, $form_state);
        
        $socials = $this->getSocialsFromConfig();    
        
        $options = [];
        foreach($socials as $social) {
            $options[$social] = $social;
        }

        $fields = [
            'email' => "Email",
            'dob' => "Date Of Birth",
            'add1' => "Address Line 1",
            'add2' => "Address Line 2",
            'city' => "City",
            'mobile' => "Mobile Number",
            'firstname' => "First Name",
            'lastname' => "Last Name",
            'zip' => "Zipcode",
            'country' => "Country"
        ];

        $form['socials'] = array(
            '#type' => 'checkboxes',
            '#options' => $options,
            '#title' => $this->t('Select the social logins that you want to add'),
        );

        $form['flow_css'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Enter the URL for the css')
        ];

        $form['extra_fields'] = array(
            '#type' => 'checkboxes',
            '#options' => $fields,
            '#title' => $this->t('Required Fields'),
            '#description' => $this->t('Define fields you require to be collected.')
        );

        $form['auth_window'] = array(
            '#type' => 'radios',
            '#title' => $this->t('Open modal pop-up?'),
            '#default_value' => 0,
            '#options' => array(0 => $this->t('Yes'), 1 => $this->t('No')),
        );

        $form['email_signup'] = array(
            '#type' => 'radios',
            '#title' => $this->t('Do you want email registration?'),
            '#default_value' => 1,
            '#options' => array(0 => $this->t('Yes'), 1 => $this->t('No')),
        );

        $form['sso'] = array(
            '#type' => 'radios',
            '#title' => $this->t('Do you want to enable single sign on?'),
            '#default_value' => 1,
            '#options' => array(0 => $this->t('Yes'), 1 => $this->t('No')),
        );

        return $form;
      }

    public function blockSubmit($form, FormStateInterface $form_state) {

        $socials = $this->getSelectedSocials($form_state);
        $fields = $this->getSelectedFields($form_state);
        $auth_window = $form_state->getValue('auth_window'); 
        $want_email = $form_state->getValue('email_signup');
        $sso = $form_state->getValue('sso');
        $flow_css = $form_state->getValue('flow_css');

        $this->state->set('socials', $socials);
        $this->state->set('fields', $fields);
        $this->state->set('email_signup', $want_email);
        $this->state->set('auth_window', $auth_window);
        $this->state->set('sso', $sso);
        $this->state->set('flow_css', $flow_css);
        
    }

    public function build() {
        //return \Drupal::formBuilder()->getForm('Drupal\ae\Form\SignupForm');

        $urls = explode("|", $this->state->get('socials'));
        $fields = explode("|", $this->state->get('fields'));

        return [
            '#theme' => 'signup',
            '#socials' => $urls,
            '#fields' => $fields,
            '#want_email' => $this->state->get('email_signup'),
            '#auth_window' => $this->state->get('auth_window'),
            '#sso' => $this->state->get('sso'),
            '#flow_css' => $this->state->get('flow_css'),
            '#attached' => array(
                'library' => array(
                  'ae/script',
                ),
              ),
          ];
    }

    public function getSocialsFromConfig() {
        $config = json_decode($this->state->get('config'));
        $urls = $config->Urls;
        $socials = [];
        foreach($urls as $url) {
            $socials[] = $url->Name;
        }
        $socials[] = "linkedin";
        return $socials;
    }

    public function getSelectedSocials(FormStateInterface $form_state) {
        $socials = $form_state->getValue('socials');
        $socials = array_diff($socials, [0]);
        $value = implode("|", $socials);
        return $value;
    }

    public function getSelectedFields(FormStateInterface $form_state) {
        $fields = $form_state->getValue('extra_fields');
        $fields = array_diff($fields, [0]);
        $value = implode("|", $fields);
        return $value;
    }
}
?>