<?php
/**
  *
  * File created by: Justin Conabree
  * Created at: 2016-08-20 6:52 AM
  *
  * Controller for index page. This controller should grab ay
  */

namespace App\Controllers\Ventures;

use App\Controllers\Ventures\Ventures;
use Core\View;
use Helpers\Request;
use Helpers\Session;

class Index extends Ventures {
	private $Req = null;
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Controller for index page
	 */
	public function index() {
		$_airportModel = new \App\Models\Ventures\Airports();
		$this->_data['airports'] = $_airportModel->getAirports();
		
		//requesting flight data
		if($depart = Request::get('depart_from')) {
			$flightModel = new \App\Models\Ventures\Flights();
			$this->_data['flights'] = $flightModel->getFlights();
			$req = new \stdClass();
			$req->depart_from = $depart;
			if($destination = Request::get('destination')) {
				$req->destination = $destination;
			}
			$this->_data['request'] = $req;
		}
		
		$this->_data['title'] = 'Trip Builder';
		
		//Handle errors
		if(Session::exists('error')) {
			Session::destroy('error');
			$this->_data['error'] = true;
			$this->_data['errorMessage'] = Session::pull('error_message');
		}
		
		View::renderTemplate('header', $this->_getData());
		View::renderTemplate('index', $this->_getData());
		View::renderTemplate('footer', $this->_getData());
	}
}