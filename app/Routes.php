<?php
/**
 * Routes - all standard Routes are defined here.
 *
 * @author David Carr - dave@daveismyname.com
 * @author Virgil-Adrian Teaca - virgil@giulianaeassociati.com
 * @version 3.0
 */


use \Support\Facades\Router;

Router::any('/', 'App\Controllers\Ventures\Index@index');

Router::any('/install', 'App\Controllers\Ventures\Install@index');

//Router for testing
Router::any('/test', 'App\Controllers\Ventures\Index@test');
/**
 * Gets airports. Optional ID filter to get specific airport information.
 */
Router::group(array('prefix' => 'airports', 'namespace' => 'App\Controllers\Ventures'), function() {
	Router::get('get', 'Airports@get');
});

/**
 * Gets all flights or only those associated with an airport. Also takes optional filter for date and time
 */
Router::group(array('prefix' => 'flights', 'namespace' => 'App\Controllers\Ventures'), function() {
	Router::get('get', 'Flights@get');
});

/**
 * Gets or sets current trip information
 */
Router::group(array('prefix' => 'trip', 'namespace' => 'App\Controllers\Ventures'), function() {
    /**
     * Gets all trips or specific trip
     */
	Router::get('/', 'Trip@get');
	Router::post('post', 'Trip@post');
	Router::post('delete', 'Trip@delete');
});

