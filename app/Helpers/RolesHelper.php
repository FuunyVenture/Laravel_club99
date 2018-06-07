<?php

function hasAccess($route = '')
{
    if (\Auth::user()->role->name == 'Admin') {
        return true;
    }
    $routes = json_decode(\Auth::user()->role->routes);

    if (isset($routes)) {
        return in_array($route, $routes);
    }
    return false;
}

function hasPackage($id = '')
{
	if(!\Auth::guest()){
		if ($id == getSetting('DEFAULT_PACKAGE_ID') && (\Auth::user()->package->id == $id)) {
			return true;
		} elseif ((\Auth::user()->package->id == $id) && (\Auth::user()->subscribed('MEMBERSHIP'))) {
			return true;
		} else {
			return false;
		}
	}
	return false;
}
/*
 *
 * simple use of hasAccess helper
 *
    if (hasAccess('admin.users.index')) {
        return 'Yes';
    }
    return 'Oops';
*/