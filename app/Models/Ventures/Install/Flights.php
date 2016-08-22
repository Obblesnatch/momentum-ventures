<?php
/**
  *
  * File created by: Justin Conabree
  * Created at: 2016-08-19 9:52 PM
  *
  * Creates flight database requirements
  *
  */

namespace App\Models\Ventures\Install;

use Helpers\Database;

class Flights {
    
    private $db = null;
	
	/**
	 * Flights constructor.
	 */
    public function __construct() {
		$this->db = Database::get();
    }
	
	/**
	 * @return bool
	 */
    public function install() {
        //Install table(s)
        $tableName = PREFIX.'flights';
		$airportTable = PREFIX.'airports';
        $sql = "CREATE TABLE $tableName (
                  `id` INT(11) NOT NULL AUTO_INCREMENT,
                  `number` VARCHAR(28) NOT NULL,
                  `from_airport` INT(11) NOT NULL,
                  `to_airport` INT(11) NOT NULL,
                  `airline` VARCHAR(90) NOT NULL,
                  `departure` DATETIME NOT NULL,
                  `duration` INT(5) NOT NULL,
                  `cost` DECIMAL(7, 2),
                  PRIMARY KEY (id), 
                  CONSTRAINT fk_flights_from_airports_id FOREIGN KEY (`from_airport`) REFERENCES `{$airportTable}` (`id`), 
                  CONSTRAINT fk_flights_to_airports_id FOREIGN KEY (`to_airport`) REFERENCES `{$airportTable}` (`id`)
                )";
	
		$create = $this->db->raw($sql);
		
		if($create !== false) {
			$airports = $this->db->select('SELECT * FROM '.PREFIX.'airports');
			$airportCount = count($airports);
			foreach($airports as $airport) {
				for($i = 0; $i < rand(0, 8); $i++) {
					$flight = array(
						'id' 			=> null,
						'number' 		=> $this->generateFlightNumber(),
						'from_airport' 	=> $airport->id,
						'to_airport' 	=> $this->getRandomAirport($airports, $airportCount),
						'airline'		=> $this->getRandomAirline(),
						'departure' 	=> $this->generateDateTime(),
						'duration' 		=> rand(1.5, 18),
						'cost'			=> rand(200, 3500)
					);
					
					$this->db->insert(PREFIX.'flights', $flight);
				}
			}
		}
	
		return $create !== false;
    }
	
	/**
	 * @return string
	 * This function serves to generate mock data
	 */
    public function generateFlightNumber() {
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$flightNumber = '';
		for ($i = 0; $i < 7; $i++) {
			$flightNumber .= $characters[rand(0, $charactersLength - 1)].($i == 1 ? '-' : '');
		}
		return $flightNumber;
	}
	
	/**
	 * @return bool|string
	 * This function serves to generate mock data
	 */
	public function generateDateTime() {
		$beginningOfDay = strtotime('midnight');
		$endOfDay = strtotime('tomorrow', $beginningOfDay) - 1;
		$addOn = rand($beginningOfDay, $endOfDay);
		$time = time()+(time() - $addOn);
		return date(DATE_ISO8601, $time);
	}
	
	/**
	 * @param $airports
	 * This function serves to generate mock data
	 */
	public function getRandomAirport($airports, $total) {
		return $airports[rand(0, $total-1)]->id;
	}
	
	public function getRandomAirline() {
		$airlines = array('WestJet', 'Sunwing', 'AirCanada', 'KLM');
		$index = rand(0, (count($airlines)-1));
		return $airlines[$index];
	}
}