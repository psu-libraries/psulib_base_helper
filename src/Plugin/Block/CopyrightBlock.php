<?php

declare(strict_types=1);

namespace Drupal\psulib_base_helper\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a copyright block block.
 *
 * @Block(
 *   id = "psulib_base_helper_copyright_block",
 *   admin_label = @Translation("Copyright Block"),
 *   category = @Translation("PSU Libraries"),
 * )
 */
final class CopyrightBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $build['content'] = [
      '#theme' => 'psulib_base_copyright',
    ];
    return $build;
  }

}
