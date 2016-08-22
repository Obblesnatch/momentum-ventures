<?php
/**
  *
  * File created by: Justin Conabree
  * Created at: 2016-08-19 8:35 PM
  *
  * This controller serves as the end point for managing airports. Functions such as get and post would be accessible here
  *
  */
namespace App\Controllers\Ventures;

use Core\Controller;
use Support\Facades\Response;

class Airports extends Controller {
	/**
	 * Airports constructor.
	 */
    public function __construct() {
        parent::__construct();
    }
	
	/**
	 * Return json on the airports that match the query
	 */
    public function get() {
		$_airportModel = new \App\Models\Ventures\Airports();
		return Response::json($_airportModel->getAirports());
    }
}