Veneer
=======================

What Is This?
-------------

This is a Drupal 8 module for site building development purposes. It does not 
do anything on it's own when enabled. It provides several utility
functions to a developer through the Services container.

These examples are meant to show what is available.


How To Use The Examples
-----------------------

The module allows for chainable functions to get output desired. 

The render() function will return FALSE if during the course of chaining
a parameter or object required did not pass validation for that service. 
This module is not set to throw Exceptions and will not kill an site. 
It is responsibility of developer to perform necessary validations.  

Examples for Developers
-----------------------

Below are variables syntax examples for the available services.

### Node
```
/** @var \Drupal\veneer\VeneerNode $veneer_node */
$veneer_node = \Drupal::service('veneer.node');

// Or directly access the functions.
\Drupal::service('veneer.node')->load($id)->render()
```

Render the current node with default "full" display.
```php 
$veneer_node->render();
```

Add the current node with default "full" display to twig as a generic Veneer variable.

Syntax for Twig: ```{{ veneer.nodes.[id].view }}```
```php 
$veneer_node->twig();

```

Render the current node and open a variable name "veneer_node" up to Twig.
```php 
$veneer_node->twig(‘veneer_node');
```

Render a node by id with default "full" display and assure it's an "article".
```php 
$veneer_node->load($id, 'article')->render();
```

Render a node's teaser using a node id.
```php 
$veneer_node->load($id)->display(’teaser')->render();
```

Render the field of current node.
```php 
$veneer_node->field(‘body')->render();
```

Roadmap
-----------------------

1. Place Veneer service functions into its own wrapper: 

```
use Drupal\veneer\Veneer

Veneer::node($id)->render();
```

2. Add unit tests.

3. Add more functions to access PITA data to retrieve. 
