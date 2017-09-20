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

        $form['socials'] = array(
            '#type' => 'checkboxes',
            '#options' => $options,
            '#title' => $this->t('Select the social logins that you want to add'),
        );

        $form['email_signup'] = array(
            '#type' => 'radios',
            '#title' => $this->t('Do you want email registration?'),
            '#default_value' => 1,
            '#options' => array(0 => $this->t('Yes'), 1 => $this->t('No')),
          );

        return $form;
      }

    public function blockSubmit($form, FormStateInterface $form_state) {

        $socials = $this->getSelectedSocials($form_state);
        $want_email = $form_state->getValue('email_signup');
        $this->state->set('socials', $socials);
        $this->state->set('email_signup', $want_email);
    }

    public function build() {
        //return \Drupal::formBuilder()->getForm('Drupal\ae\Form\SignupForm');

        $socials = $this->state->get('socials');
        $urls = explode("|", $socials);

        return [
            '#theme' => 'signup',
            '#socials' => $urls,
            '#want_email' => $this->state->get('email_signup'),
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
}
?>