<?php

//Check if url has "admin" in it
if (strpos($_SERVER['REQUEST_URI'], "admin") == false) {
    $dashboard = 'UserHandler@dashboard';
    $history = 'UserHandler@history';
} else {
    //AdminHandler
    $dashboard = 'AdminHandler@dashboard';
    $history = 'AdminHandler@history';
}

$routes = [
    '' => 'HomeHandler@index',

    //Account routes
    'login' => 'AccountHandler@login',
    'register' => 'AccountHandler@register',
    'logout' => 'AccountHandler@logout',

    'activate' => 'AccountHandler@activate',
    'reset_password' => 'AccountHandler@reset_password',
    'create_new_password' => 'AccountHandler@create_new_password',

    //Changing dashboard between user or admin
    'dashboard' => $dashboard,

    //Changing reservations history between user or admin
    'history' => $history,

    //Admin routes
    'add_availability' => 'AvailabilityHandler@add',
    'delete_availability' => 'AvailabilityHandler@delete',
    'edit_availability' => 'AvailabilityHandler@edit',
    'complete' => 'AvailabilityHandler@complete',


    //User routes
    'add_child' => 'UserHandler@add_child',
    'delete_child' => 'UserHandler@delete_child',
    'edit_child' => 'UserHandler@edit_child',

    //Calender routes
    'calendar' => 'CalendarHandler@index',
    'book' => 'CalendarHandler@book',


];
