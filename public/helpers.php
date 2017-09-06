<?php

// Die and dump function
function dd($args)
{
    echo '<pre>'; echo json_encode($args, JSON_PRETTY_PRINT); echo '</pre>';
    die();
}

// Get the real path function, $path is the string to add to the app_path in config
function real_path($path = null)
{
    global $app;
    if(!empty($app->config['app_path']))
    {
        return $app->config['app_path'] . '/' . $path;
    } else {
        return __DIR__ . '/' . $path;
    }
}

// Get the path to the migrations folder. The app uses this path to run migrations
function getMigrationsPath()
{
    return real_path() . '../migrations';
}
