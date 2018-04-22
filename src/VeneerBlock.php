<?php

/**
 * @file
 * Contains \Drupal\veneer/VeneerBlock.
 */

namespace Drupal\veneer;

use Drupal\block\Entity\Block;

/**
 * Defines a VeneerBlock class.
 *
 * @ingroup veneer
 */
class VeneerBlock implements VeneerBaseInterface {

  /**
   * The block loaded.
   *
   * @var integer
   */
  protected $block = FALSE;

  /**
   * {@inheritdoc}
   */
  public function load($id = 0) {
    $this->block = Block::load($id);

    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function render() {
    $rendered = FALSE;

    if ($this->block) {
      $rendered = \Drupal::entityTypeManager()
        ->getViewBuilder('block')
        ->view($this->block);
    }

    return $rendered;
  }

  /**
   * {@inheritdoc}
   */
  public function twig($name = '') {
    // If a name is not defined, create generic.
    if (empty($name) && $this->block) {
      $name = 'veneer_block_' . $this->block->id();
    }

    if (!empty($name)) {
      veneer_add_twig($name, $this->render());
    }
  }
}
