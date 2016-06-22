<?php

namespace Drupal\ckeditor_templates\Plugin\CKEditorPlugin;

use Drupal\ckeditor\Annotation\CKEditorPlugin;
use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\ckeditor\CKEditorPluginConfigurableInterface;
use Drupal\ckeditor\CKEditorPluginContextualInterface;
use Drupal\Core\Annotation\Translation;
use Drupal\Core\Form\FormStateInterface;
use Drupal\editor\Entity\Editor;

/**
 * Defines the "Templates" plugin.
 *
 * @CKEditorPlugin(
 *   id = "templates",
 *   label = @Translation("Templates")
 * )
 */
class CkeditorTemplates extends CKEditorPluginBase implements CKEditorPluginConfigurableInterface {

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    return [
      'Templates' => [
        'label' => t('Templates'),
        'image' => base_path() . 'libraries/templates/icons/templates.png',
      ]
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getConfig(Editor $editor) {
    $config = array();
    $settings = $editor->getSettings();
    if (!isset($settings['plugins']['templates']['replace_content'])) {
      return $config;
    }
    $config['templates_replaceContent'] = $settings['plugins']['templates']['replace_content'];
    return $config;
  }

  /**
   * {@inheritdoc}
   */
  public function getFile() {
    return base_path() . 'libraries/templates/plugin.js';
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state, Editor $editor) {
    // Defaults.
    $config = array('replace_content' => false);
    $settings = $editor->getSettings();
    if (isset($settings['plugins']['templates'])) {
      $config = $settings['plugins']['templates'];
    }

    $form['replace_content'] = array(
      '#title' => t('Replace content default value'),
      '#type' => 'checkbox',
      '#default_value' => $config['replace_content'],
      '#description' => t('Whether the "Replace actual contents" checkbox is checked by default in the Templates dialog'),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  function getLibraries(Editor $editor) {
    return array(
      'ckeditor_templates/templatesSettings'
    );
  }

}
