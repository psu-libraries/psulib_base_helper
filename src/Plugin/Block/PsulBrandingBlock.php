<?php

declare(strict_types=1);

namespace Drupal\psulib_base_helper\Plugin\Block;

use Drupal\Core\Form\FormStateInterface;
use Drupal\system\Plugin\Block\SystemBrandingBlock;

/**
 * Extend the System Branding Block to add additional controls.
 *
 * @Block(
 *   id = "psulib_base_helper_branding_block",
 *   admin_label = @Translation("PSUL Branding Block"),
 *   category = @Translation("PSU Libraries"),
 * )
 */
final class PsulBrandingBlock extends SystemBrandingBlock {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    $defaults = parent::defaultConfiguration();

    $defaults['hide_site_name'] = TRUE;
    $defaults['use_site_slogan'] = FALSE;
    $defaults['logo_title'] = 'Home';
    $defaults['logo_path'] = '';

    return $defaults;
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    $form['block_branding']['hide_site_name'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Hide Site name and slogan'),
      '#description' => $this->t('Hide the site name and slogan with css.'),
      '#default_value' => $this->configuration['hide_site_name'],
    ];

    $form['block_branding']['logo_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Logo title'),
      '#description' => $this->t('Set the logo title and alt.'),
      '#default_value' => $this->configuration['logo_title'],
    ];

    $form['block_branding']['logo_path'] = [
      '#type' => 'url',
      '#title' => $this->t('Logo link URL'),
      '#description' => $this->t('Update the logo so it links to another site.'),
      '#default_value' => $this->configuration['logo_path'],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $block_branding = $form_state->getValue('block_branding');
    $this->configuration['use_site_logo'] = $block_branding['use_site_logo'];
    $this->configuration['use_site_name'] = $block_branding['use_site_name'];
    $this->configuration['use_site_slogan'] = $block_branding['use_site_slogan'];
    $this->configuration['hide_site_name'] = $block_branding['hide_site_name'];
    $this->configuration['logo_title'] = $block_branding['logo_title'];
    $this->configuration['logo_path'] = $block_branding['logo_path'];

  }

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $site_config = $this->configFactory->get('system.site');

    // Create the header_mark response.
    return [
      '#type' => 'component',
      '#component' => 'psulib_base:header_mark',
      '#props' => [
        'site_name' => $this->configuration['use_site_name'] ? $site_config->get('name') : '',
        'site_logo' => $this->configuration['use_site_logo'] ? theme_get_setting('logo.url') : '',
        'site_slogan' => $this->configuration['use_site_slogan'] ? $site_config->get('slogan') : '',
        'hide_site_name' => $this->configuration['hide_site_name'],
        'logo_title' => $this->configuration['logo_title'],
        'logo_path' => $this->configuration['logo_path'],
      ],
    ];

  }

}
