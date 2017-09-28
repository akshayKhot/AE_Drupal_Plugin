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

        $form['socials'] = array(
            '#type' => 'checkboxes',
            '#options' => $options,
            '#title' => $this->t('Select the social logins that you want to add'),
        );


        $form['extra_fields'] = array(
            '#type' => 'checkboxes',
            '#options' => $fields,
            '#title' => $this->t('Required Fields'),
            '#description' => $this->t('Define fields you require to be collected.')
        );

        return $form;
      }

    public function blockSubmit($form, FormStateInterface $form_state) {

        $socials = $this->getSelectedSocials($form_state);
        $fields = $this->getSelectedFields($form_state);

        $this->state->set('socials', $socials);
        $this->state->set('fields', $fields);
        
    }

    public function build() {
        //return \Drupal::formBuilder()->getForm('Drupal\ae\Form\SignupForm');


        return [
            '#theme' => 'signup',
            '#socials' => $this->state->get('socials'),
            '#fields' => $this->state->get('fields'),
            '#want_email' => $this->state->get('email_signup'),
            '#auth_window' => $this->state->get('auth_window'),
            '#sso' => $this->state->get('sso'),
            '#new_user' => $this->state->get('new_user'),
            '#flow_css' => $this->state->get('flow_css'),
            '#extra_info' => $this->state->get('extra_info'),
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
        //$value = implode("|", $socials);
        return $socials;
    }

    public function getSelectedFields(FormStateInterface $form_state) {
        $fields = $form_state->getValue('extra_fields');
        $fields = array_diff($fields, [0]);
        //$value = implode("|", $fields);
        return $fields;
    }
}
?>