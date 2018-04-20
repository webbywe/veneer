<?php

/**
 * @file
 * Contains \Drupal\veneer/VeneerNode.
 */

namespace Drupal\veneer;

use Drupal\node\Entity\Node;
use Drupal\node\NodeInterface as NodeInterface;

/**
 * Defines a VeneerNode class.
 *
 * @ingroup veneer
 */
class VeneerNode implements VeneerEntityInterface {

  /**
   * The node object to be processed.
   *
   * @var \Drupal\node\Entity\Node
   */
  protected $node = FALSE;

  /**
   * The id for the node loaded requested.
   *
   * @var integer
   */
  protected $requested_id = FALSE;

  /**
   * The field name being processed.
   *
   * @var string
   */
  protected $field = FALSE;

  /**
   * The view mode to render.
   *
   * @var string
   */
  protected $display = 'full';

  /**
   * {@inheritdoc}
   */
  public function load($id = 0, $type = '') {
    // Set to current node if $id is not set otherwise
    if ($id === 0) {
      $node = \Drupal::routeMatch()->getParameter('node');
    }
    else {
      $this->requested_id = $id;
      $node = Node::load($id);
    }

    // Assure that the node is loaded and if not throw an exception.
    if ($node instanceof NodeInterface) {
      $this->node = $node;
    }

    // Verify node is of right type.
    if (!empty($type) && $node->bundle() == $type) {
      $this->node = FALSE;
    }

    return $this;
  }

  /**
   * Check to assure the node is a proper node and created.
   *
   * @return bool
   */
  private function checkNode() {
    // Load the current menu path node if one is not loaded yet.
    if (!$this->node && empty($this->requested_id)) {
      $this->load();
    }

    return ($this->node instanceof NodeInterface);
  }

  /**
   * {@inheritdoc}
   */
  public function display($display) {
    $this->display = $display;

    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function field($name) {
    $this->checkNode();

    if (!$this->node->hasField($name)) {
      return FALSE;
    }

    $this->field = $name;

    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function render() {
    $this->checkNode();
    $rendered = FALSE;
    $view_builder = \Drupal::entityTypeManager()->getViewBuilder('node');

    if ($this->node && $this->field) {
      // Render the field if one is defined.
      $view = $view_builder->viewField($this->node->get('body'));
      $rendered = render($view);
    }
    else {
      if ($this->node) {
        // Render the node itself.
        $build = $view_builder->view($this->node, $this->display);
        $rendered = render($build);
      }
    }

    return $rendered;
  }

  /**
   * {@inheritdoc}
   */
  public function twig($name = '') {
    $node = $this->node;

    // If a name is not defined, create generic.
    if (empty($name) && $node && !$this->field) {
      $name = 'veneer_node_' . $node->id();
    } elseif (empty($name) && $this->field != FALSE) {
      $name = 'veneer_node_' . $node->id() . '_' . $this->field;
    }

    if (!empty($name)) {
      veneer_add_twig($name, $this->render());
    }
  }

  public function output() {
    echo 'test';
  }

  /**
   * {@inheritdoc}
   */
  public function value() {
    $this->checkNode();

    return $this->node->get($this->field)->value;
  }
}
