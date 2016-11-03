<?php

namespace hubert\extension\event;

use Zend\EventManager\EventManager;

class factory {
    public static function get($container){
        return new EventManager();
    }
}
