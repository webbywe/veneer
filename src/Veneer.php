<?php

/**
 * @file
 * Contains \Drupal\veneer\Veneer.
 */

namespace Drupal\veneer;

/**
 * Defines a Veneer class.
 *
 *
 *
 * @ingroup veneer
 */
class Veneer {

  /**
   * Wrapper for the node service.
   *
   * @param mixed $param
   *
   * @return $this|\Drupal\veneer\VeneerEntityInterface
   */
  public static function node($param) {
    /** @var \Drupal\veneer\VeneerNode $veneer_node */
    $veneer_node = \Drupal::service('veneer.node');
    return $veneer_node->load($param);
  }

  /**
   * Wrapper for the block service.
   *
   * @param mixed $param
   *
   * @return $this|\Drupal\veneer\VeneerBlock
   */
  public static function block($param) {
    /** @var \Drupal\veneer\VeneerBlock $veneer_block */
    $veneer_block = \Drupal::service('veneer.block');
    return $veneer_block->load($param);
  }
}
