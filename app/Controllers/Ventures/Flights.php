<?php
/**
  *
  * File created by: Justin Conabree
  * Created at: 2016-08-20 7:45 AM
  *
  *
  */

namespace App\Controllers\Ventures;


use Support\Facades\Response;

class Flights extends Ventures {
	/**
	 * @return \Http\JsonResponse
	 * Gets flight(s) data
	 */
	public function get() {
		$flightModel = new \App\Models\Ventures\Flights();
		$result = $flightModel->getFlights();
		return Response::json($result, 200, array('header' => 'value'));
	}
}