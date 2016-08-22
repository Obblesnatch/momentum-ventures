<?php
/**
  *
  * File created by: Justin Conabree
  * Created at: 2016-08-20 9:15 AM
  *
  *
  */

namespace App\Models\Ventures;

use Core\Model;
use Helpers\Request;

class Flights extends Model {
	
	/**
	 * Flights constructor.
	 */
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * @param null $id
	 * @return array|bool
	 * Gets flight(s) from database
	 */
	public function getFlights($id = null) {
		$where = '';
		$joinSelect = '`departure_airport`.`id` AS depart_id, `departure_airport`.`name` AS depart_name, `departure_airport`.`code` AS depart_code, `arrival_airport`.`id` AS arrival_id, `arrival_airport`.`name` AS arrival_name, `arrival_airport`.`code` AS arrival_code';
		$sql = 'SELECT '.PREFIX.'flights.*, '.$joinSelect.'  FROM '.PREFIX.'flights INNER JOIN '.PREFIX.'airports AS departure_airport ON '.PREFIX.'flights.from_airport = departure_airport.id INNER JOIN '.PREFIX.'airports AS arrival_airport ON '.PREFIX.'flights.to_airport = arrival_airport.id';
		if($id) {
			$where = ' WHERE '.PREFIX.'flights.id = '.$id;
		} elseif($departFrom = Request::get('depart_from')) {
			$departFrom = Request::get('depart_from');
			$where = ' WHERE '.PREFIX.'flights.from_airport = '.$departFrom;
			
			if($arrivalAirport = Request::get('destination')) {
				if($arrivalAirport != '-1') {
					$where .= ' AND '.PREFIX.'flights.to_airport = '.$arrivalAirport;
				}
			}
			
			// Here is where we would apply filters for departure dates and/or arrival dates. As there are only one days worth of values in the DB, we can't do this
		}else {
			return false;
		}
		$sql .= $where;
		$sql .= ' ORDER BY '.PREFIX.'flights.departure ASC';
		
		if($id) {
			$res = $this->db->select($sql);
			if(count($res)) {
				return $res[0];
			}
			return array();
		}
		return $this->db->select($sql);
	}
}