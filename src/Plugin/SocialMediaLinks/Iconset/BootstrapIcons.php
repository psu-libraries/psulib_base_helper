<?php

namespace Drupal\psulib_base_helper\Plugin\SocialMediaLinks\Iconset;

use Drupal\social_media_links\IconsetBase;
use Drupal\social_media_links\IconsetInterface;

/**
 * Provides 'bootstrap_icons' iconset.
 *
 * The icon assets are current in the psulib_base theme and the font size
 * styles are also defined there.
 *
 * @Iconset(
 *   id = "bootstrap_icons",
 *   name = "Bootstrap Icons",
 *   publisher = "Elegant Themes",
 *   publisherUrl = "https://icons.getbootstrap.com/",
 *   downloadUrl = "https://icons.getbootstrap.com/#install",
 * )
 */
class BootstrapIcons extends IconsetBase implements IconsetInterface {

  /**
   * {@inheritdoc}
   */
  public function setPath($iconset_id) {
    $this->path = $this->finder->getPath($iconset_id) ? $this->finder->getPath($iconset_id) : 'library';
  }

  /**
   * {@inheritdoc}
   */
  public function getStyle() {
    return [
      'font-size-xl' => 'Extra Large',
      '' => 'Default',
      'font-size-sm' => 'Small',
      'font-size-l' => 'Large',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getIconElement($platform, $style) {
    /** @var \Drupal\social_media_links\PlatformInterface $platform */
    $icon_name = $platform->getIconName();

    switch ($icon_name) {
      case 'twitter':
      case 'x-twitter':
        $icon_name = 'twitter-x';
        break;

      case 'email':
        $icon_name = 'envelope';
        break;

      case 'website':
        $icon_name = 'house';
        break;

      case 'googleplay':
        $icon_name = 'google-play';
        break;
    }

    $icon = [
      '#type' => 'markup',
      '#markup' => "<i class='bi bi-$icon_name $style' style='font-size: 2rem;'></i>",
    ];

    return $icon;
  }

  /**
   * {@inheritdoc}
   */
  public function getLibrary() {
    return [
      'psulib_base/bootstrap-icons',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getIconPath($icon_name, $style) {
    return NULL;
  }

}
