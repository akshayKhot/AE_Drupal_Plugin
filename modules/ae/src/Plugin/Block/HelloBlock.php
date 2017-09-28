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

        return $form;
      }

    public function blockSubmit($form, FormStateInterface $form_state) {

        $socials = $this->getSelectedSocials($form_state);


        $this->state->set('socials', $socials);

        
    }

    public function build() {

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
            '#attached' => [
                'library' => [
                  'ae/script',
                ],
              ],
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

}
?>