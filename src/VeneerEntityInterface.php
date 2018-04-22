<?php

/**
 * @file
 * Contains \Drupal\veneer\VeneerEntityInterface.
 */

namespace Drupal\veneer;

/**
 * Defines an interface for interacting with an Entity.
 *
 * @ingroup veneer
 */
interface VeneerEntityInterface extends VeneerBaseInterface {
  /**
   * Set the field name to perform interactions on.
   *
   * @param mixed $param
   *   A differing set of params defined in class.
   *
   * @return \Drupal\veneer\VeneerEntityInterface
   *   $this.
   */
  public function load($param);

  /**
   * Set the field name to perform interactions on.
   *
   * @param $name
   *   The name of the field.
   *
   * @return \Drupal\veneer\VeneerEntityInterface
   *   $this.
   */
  public function field($name);

  /**
   * Get the value of the field.
   *
   * @return mixed
   *   Returns the value of the field.
   */
  public function value();

  /**
   * Set the value of the view mode for display.
   *
   * @param $display
   *
   *
   * @return void
   */
  public function display($display);
}