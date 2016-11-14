Hubert Event Extension
======

## Installation

Hubert is available via Composer:

```json
{
    "require": {
        "falkm/hubert-event": "1.*"
    }
}
```

## Usage

Create an index.php file with the following contents:

```php
<?php

require 'vendor/autoload.php';

$app = new hubert\app();

$config = array(
    "factories" => array(
         "eventManager" => array(hubert\extension\event\factory::class, 'get')
        ),
    "config" => array(
        "display_errors" => true,
        ),
    "routes" => array(
            "home" => array(
                "route" => "/", 
                "method" => "GET|POST", 
                "target" => function($request, $response, $args){
                     hubert()->eventManager->attach('do', function ($e) {
                        $event = $e->getName();
                        $params = $e->getParams();
                        printf(
                            'Handled event "%s", with parameters %s',
                            $event,
                            json_encode($params)
                        );
                        return "eventresult";
                    });
                    $a =  hubert()->eventManager->trigger('do', null, ["test" => 2]);
                    print_r($a->last());
                }
            ),
        )
);

hubert($config);
hubert()->core()->run();
```

For more see the example in this repository.

### components

- zend event manager [zendframework/zend-eventmanager](https://docs.zendframework.com/zend-eventmanager/

## License

The MIT License (MIT). Please see [License File](https://github.com/falkmueller/hubert/blob/master/LICENSE) for more information.