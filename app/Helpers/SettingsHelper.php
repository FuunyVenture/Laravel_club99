<?php

function getSetting($key = '')
{
    $setting = \App\Setting::whereKeyCd(strtoupper($key))->first();

    if ($setting) {
        return $setting->value;
    } else {
        return '';
    }
}

function getSettingValue($key = '') {
    $setting = \App\Setting::whereKeyCd(strtoupper($key))->first();

    if ($setting) {
        return $setting->display_value;
    } else {
        return '';
    }
}

function getNamedRoutes()
{
    $routeCollection = Route::getRoutes();

    $routes = [];

    foreach ($routeCollection as $route) {
        if ($route->getName()) {
            $routes[$route->getName()] = $route->getName();
        }
    }

    return $routes;
}

function getMenuItems($location = '')
{
    $menu_items = \App\Menu::whereLocation($location)->whereStatus(1)->orderBy('item_order')->get();

    return $menu_items;
}