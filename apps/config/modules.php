<?php
/**
 * Register application modules
 */
$application->registerModules(array(

    'api' => array(
        'className' => 'App\Modules\Api\Module',
        'path' => __DIR__ . '/../modules/api/Module.php'
    )
));
