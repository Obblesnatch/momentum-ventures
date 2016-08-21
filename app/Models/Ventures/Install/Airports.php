<?php
/**
  *
  * File created by: Justin Conabree
  * Created at: 2016-08-19 9:03 PM
  *
  * Creates airport database requirements
  *
  */

namespace App\Models\Ventures\Install;

use Helpers\Database;
use Helpers\SimpleCurl;

class Airports {

    private $_aeroApiKey = 'f9691500fd8e249c00d6d251e2eab8f2';
	/**
	 * @var string
	 * They also have an endpoint for grabbing the nearest airports given a lat and long which would be very useful
	 */
	private $_aeroApiUrl = 'https://airport.api.aero/airport';
	
	public function __construct() {
		$this->db = Database::get();
	}
	
	/**
	 * @return bool
	 * Installs airport table and data
	 */
    public function install() {
        //Install table(s)
        $tableName = PREFIX.'airports';
        $sql = "CREATE TABLE $tableName (
                  `id` INT(11) NOT NULL AUTO_INCREMENT,
                  `code` VARCHAR(28) NOT NULL UNIQUE,
                  `name` VARCHAR(90) NOT NULL,
                  `country` VARCHAR(90) NOT NULL,
                  `lat` DECIMAL(8,6) NOT NULL,
                  `lon` DECIMAL(8,6) NOT NULL,
                  PRIMARY KEY (id)
                )";

        $create = $this->db->raw($sql);
		if($create != false) {
			// Add airport data to database
			$airports = $this->_getAirports();
			foreach($airports['airports'] as $airport) {
				if($airport['name'] && $airport['code'] && $airport['country']) {
					$this->db->insert(PREFIX.'airports', array(
						'id' => null,
						'code' => $airport['code'],
						'name' => $airport['name'],
						'country' => $airport['country'],
						'lat' => $airport['lat'],
						'lon' => $airport['lng']
					));
				}
			}
		}
		//should be changed to return if data was entered into the database correctly as well
        return $create !== false;
    }
    
    private function _getAirports() {
    	try {
    		$return = SimpleCurl::get($this->_aeroApiUrl, array('user_key' => $this->_aeroApiKey));
			//api returns 'callback({data})' need to grab out only json
			$removeLength = 9;
			$return = substr($return, $removeLength, -1);
			return json_decode($return, true);
		} catch(Exception $e) {
			return array('airports'=>array());
		}
	}
    
    
}