<?php

//Check if url has "admin" in it
if (strpos($_SERVER['REQUEST_URI'], "admin") == false) {
    $dashboard = 'AccountHandler@dashboard';
} else {
    //AdminHandler
    $dashboard = 'AdminHandler@dashboard';
}

$routes = [
    '' => 'HomeHandler@index',

    //AccountHandler
    'login' => 'AccountHandler@login',
    'register' => 'AccountHandler@register',
    'logout' => 'AccountHandler@logout',

    'activate' => 'AccountHandler@activate',
    'reset_password' => 'AccountHandler@reset_password',
    'create_new_password' => 'AccountHandler@create_new_password',

    //Changing dashboard between user or admin
    'dashboard' => $dashboard,

    //Admin routes
    'add_availability' => 'AvailabilityHandler@add',

];
