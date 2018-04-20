<?php

/**
 * @file
 * Contains \Drupal\veneer\VeneerBaseInterface.
 */

namespace Drupal\veneer;

/**
 * Defines an interface class for a veneer service.
 *
 * @ingroup veneer
 */
interface VeneerBaseInterface {
  /**
   * Return the rendered object.
   *
   * @return mixed
   */
  public function render();


  /**
   * Set the rendered item to be an available variable in twig.
   *
   * @param string $name
   *   The name of the variable to be set or set to a default.
   *
   * @return void
   */
  public function twig($name = '');
}
