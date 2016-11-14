<?php
return array(
    
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
                    
                    $a = hubert()->eventManager->trigger('do', null, ["test" => 2]);
                    print_r($a->last());
                }
            ),
        )
);
