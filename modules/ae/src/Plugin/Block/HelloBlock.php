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



        //// Extra Info ////

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
        
        //ksm($extra_info);

        $this->state->set('socials', $socials);
        $this->state->set('fields', $fields);
        $this->state->set('extra_info', $extra_info);

        //ksm($this->state->get('extra_info'));
        
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