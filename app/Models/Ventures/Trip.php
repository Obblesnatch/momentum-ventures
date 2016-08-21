<?php
/**
  *
  * File created by: Justin Conabree
  * Created at: 2016-08-20 8:26 AM
  *
  *
  */
namespace App\Models\Ventures;

use Core\Model;
use Helpers\Session;
use Helpers\Request;

class Trip extends Model {
	/**
	 * @return array|mixed|null
	 * Gets the full trip value. If it doesn't exist it returns an empty array
	 */
	public function get() {
		if($trip = Session::get('trip')) {
			return $trip;
		}
		return array();
	}
	
	/**
	 * @return array|mixed|null
	 * Adds to the trip in session
	 */
	public function post() {
		$trip = Session::get('trip');
		if(!$trip) {
			$trip = array(
				'total' => 0,
				'flights' => array()
			);
		}
		
		//Get flight information from ID rather than passing all of the information into the controller
		$flightModel = new \App\Models\Ventures\Flights();
		$flight = $flightModel->getFlights(Request::post('id'));
		
		array_push($trip['flights'], $flight);
		$trip['total'] += $flight->cost;
		
		Session::set('trip', $trip);
		return $trip;
	}
	
	/**
	 * @param null $id
	 * @return bool|mixed|null
	 * Deletes the flight from the trip if ID is provided. Otherwise it clears the whole trip
	 */
	public function delete($id = null) {
		if(!Session::exists('trip')){
			return true;
		}
		//ID can either be supplied in get information or in the url structure
		if(!$id) {
			$id = Request::post('flight_id');
		}
		
		//If id isn't supplied anywhere in the request, delete the full trip
		if(!$id) {
			Session::destroy('trip');
			return true;
		}
		
		$trip = Session::get('trip');
		
		//Remove flight from the trip and reduce the total price
		if($trip) {
			foreach($trip['flights'] as $index => $flight) {
				if($flight->id == $id) {
					$trip['total'] -= $flight->cost;
					unset($trip['flights'][$index]);
					if(!count($trip['flights'])) {
						Session::destroy('trip');
						return true;
					}
					break;
				}
			}
		}
		
		Session::set('trip', $trip);
		return $trip;
	}
}