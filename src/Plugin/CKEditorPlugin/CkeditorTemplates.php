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
  public function getFile() {
    return $this->getTemplatesPluginPath() . 'plugin.js';
  }

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    return [
      'Templates' => [
        'label' => t('Templates'),
        'image' => $this->getTemplatesPluginPath() . 'icons/templates.png',
      ]
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getConfig(Editor $editor) {
    $config = array();
    $settings = $editor->getSettings();
    if (isset($settings['plugins']['templates']['replace_content'])) {
      $config['templates_replaceContent'] = $settings['plugins']['templates']['replace_content'];
    }
    if (isset($settings['plugins']['templates']['template_path']) && !empty($settings['plugins']['templates']['template_path'])) {
      $config['templates_files'] = array($settings['plugins']['templates']['template_path']);
    }
    else {
      $config['templates_files'] = $this->getTemplatesDefaultPath();
    }
    //this gives access to the module path in the ckeditor_templates.js file
    $config['templates_module_path'] = drupal_get_path('module', 'ckeditor_templates');
    return $config;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state, Editor $editor) {
    // Defaults.
    $config = array(
      'replace_content' => false,
      'template_path' => ''
    );

    $settings = $editor->getSettings();

    if (isset($settings['plugins']['templates'])) {
      $config = $settings['plugins']['templates'];
    }

    $form['template_path'] = array(
      '#title' => t('Template definition file'),
      '#type' => 'textfield',
      '#default_value' => $config['template_path'],
      '#description' => t('Path to the javascript file defining the templates, relative to drupal root (starting with "/")'),
    );

    $form['replace_content'] = array(
      '#title' => t('Replace content default value'),
      '#type' => 'checkbox',
      '#default_value' => $config['replace_content'],
      '#description' => t('Whether the "Replace actual contents" checkbox is checked by default in the Templates dialog'),
    );

    return $form;
  }

  private function getTemplatesPluginPath() {
    return base_path() . 'libraries/templates/';
  }

  public function getTemplatesDefaultPath() {
    //default to module folder
    $defaultPath = base_path() . drupal_get_path('module', 'ckeditor_templates') . '/templates/ckeditor_templates.js';

    //get site default theme name
    $themeConfiguration = \Drupal::config('system.theme');
    $defaultThemeName = $themeConfiguration->get('default');

    $defaultThemeFileAbsolutePath = \Drupal::service('file_system')->realpath() . '/' . drupal_get_path('theme', $defaultThemeName) . '/templates/ckeditor_templates.js';
    if (file_exists($defaultThemeFileAbsolutePath)) {
      $defaultPath = base_path() . drupal_get_path('theme', $defaultThemeName) . '/templates/ckeditor_templates.js';
    }

    return array($defaultPath);
  }

}
