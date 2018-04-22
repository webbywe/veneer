Veneer /vəˈnir/
=======================

An attractive appearance that covers or disguises something's true nature.

What Is This?
-------------

This is a Drupal 8 module for site building development purposes that is loosely
based on the idea of a Facade pattern for Drupal. It does not do anything on 
it's own when enabled. It provides several utility functions to a developer 
through the Services container.

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
use Drupal\veneer\Veneer;

Veneer::node($id)->render();

// Or access directly through Drupal Services.

/** @var \Drupal\veneer\VeneerNode $veneer_node */
$veneer_node = \Drupal::service('veneer.node');
$veneer_node->load($id)->render();
```

Render the current node with default "full" display.
```php 
Veneer::node()->render();
```

Add the current node with "default" display to twig as a generic Veneer variable.

Syntax for Twig: ```{{ veneer.nodes.[id].view }}```
```php 
Veneer::node()->twig();

```

Render the current node and open a variable name "veneer_node" up to Twig.
```php 
Veneer::node()->twig('veneer_node');
```

Render a node by id with default "full" display and assure it's an "article".
```php 
Veneer::node([id => $id, type => 'article'])->render();
```

Render a node's teaser using a node id.
```php 
Veneer::node($id)->display(’teaser')->render();
```

Render the field of current node.
```php 
Veneer::node()->field(‘body')->render();
```

TODO
-----------------------

1. Add unit tests.

2. Add more functions to access PITA data to retrieve. 
