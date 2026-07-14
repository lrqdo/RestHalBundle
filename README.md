#  RestHalBundle

Bundle to manage [Hal API](http://stateless.co/hal_specification.html) with Symfony.

## Installation

Add the bundle to your composer.json:

    composer require alterway/rest-hal-bundle

Enable your bundle in your `AppKernel.php`:

```php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Alterway\Bundle\RestHalBundle\AwRestHalBundle(),
    );
}
```

## Usage

### Resource

A resource is a PHP class who represents informations about elements of your applications.

For example:

```php
// src/Alterway/DemoBundle/ApiResource/UserResource.php

namespace Alterway\DemoBundle\ApiResource;

use Alterway\Bundle\RestHalBundle\ApiResource\Resource;

class UserResource extends Resource
{
    public function __construct(RouterInterface $router, User $user)
    {
        parent::__construct($router);
        $this->user = $user;
    }

    protected function prepare()
    {
        $this->addLink('next', '/users?page=2');
        $this->addLink('search', '/users?id={user_id}');
    }

    protected function generateUri()
    {
        return $this->router->generate('demo.user', array('id' => 1));
    }
}
```

### Controller

#### With the `#[Hal]` attribute:

```php
// some controller or yours

use Alterway\Bundle\RestHalBundle\Controller\Annotations\Hal;
use Alterway\DemoBundle\ApiResource\UserResource;

#[Hal(code: 200)]
public function userWithAttributeAction(Request $request)
{
    $user = new User;
    return new UserResource($this->get('router'), $user);
}
```

#### Without the attribute:

```php
// some controller or yours

use Alterway\Bundle\HalRestBundle\Response\HalResponse;
use Alterway\DemoBundle\ApiResource\UserResource;

public function userWithoutAnnotateAction(Request $request)
{
    $user = new User;
    $resource = new UserResource($this->get('router'), $user);
    return new HalResponse($resource, 200);
}
```

## Contribute

Install dev dependencies:

    php composer.phar update

Run Behat:

    ./vendor/bin/behat @AwRestHalBundle

## Copyright

Copyright (c) 2021 La Ruche Qui Dit Oui!. See LICENSE for details.

##  Contributors

+ Jean-François Lépine (Halleck45)
+ Benoît Merlet (trompette)
+ Antoine Lévêque (gh0stonio)

## Sponsors

+ [Alter Way](http://www.alterway.fr)
+ [La Ruche Qui Dit Oui !](http://www.laruchequiditoui.fr)
