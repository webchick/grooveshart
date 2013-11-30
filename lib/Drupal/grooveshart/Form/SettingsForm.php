<?php

/**
 * @file
 * Contains \Drupal\grooveshart\Form\SettingsForm.
 */

namespace Drupal\grooveshart\Form;
use Drupal\Core\Form\FormBase;

/**
 * Settings form for GrooveShart module.
 */
class SettingsForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'grooveshart_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, array &$form_state) {
    $config = \Drupal::config('grooveshart.settings');

    $form['api_key'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('API key'),
      '#default_value' => $config->get('api_key'),
      '#description' => $this->t('Enter your <a href="@url">Tinysong API key</a>.', array('@url' => 'http://tinysong.com/api')),
    );

    $songs = (array) $config->get('songs');
    $form['songs'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Horrible songs'),
      '#default_value' => implode("\n", $songs),
      '#description' => $this->t('Customize the list of horrible songs to stream.'),
    );

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    );

    return $form;
  }


  /**
   * {@inheritdoc}
   */
  function submitForm(array &$form, array &$form_state) {
    $config = \Drupal::config('grooveshart.settings');
    $config->set('api_key', $form_state['values']['api_key']);
    $songs = $form_state['values']['songs'];
    $config->set('songs', explode("\n", $songs));
    $config->save();
    drupal_set_message($this->t('Settings saved successfully.'));
  }
}
