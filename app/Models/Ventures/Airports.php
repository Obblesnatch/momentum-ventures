<?php
/**
  *
  * File created by: Justin Conabree
  * Created at: 2016-08-19 9:01 PM
  *
  *
  */

namespace App\Models\Ventures;

use Core\Model;

class Airports extends Model {
	/**
	 *
	 * @param null $id
	 * @param string $sort
	 * @return mixed
	 * Gets resulting airports
	 *
	 */
    public function getAirports($id = null) {
		/**
		 * Should change this to check for destinations.
		 * User would select departure airport and then the arrival airport list would be fetched, looking at all the flights leaving from the departure and where they're going to
		 */
    	if($id) {
			return $this->db->select('SELECT * FROM '.PREFIX.'airports WHERE id = '.$id);
		}else {
			//Should change the sort order to look at passed in variables so we can change the sort order. Would also be cool to search by nearest
			return $this->db->select('SELECT * FROM '.PREFIX.'airports ORDER BY `name` ASC');
		}
	}
}
