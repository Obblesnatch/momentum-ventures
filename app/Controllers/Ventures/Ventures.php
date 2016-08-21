<?php
/**
  *
  * File created by: Justin Conabree
  * Created at: 2016-08-20 6:54 AM
  *
  * This class has the core controller functions needed for Views.
  * Such as getting session. All frontend controllers (controllers
  * that represent and actual page) should extend this. If there was
  * a login system, this would check that the user was logged in on each page
  *
  */

namespace App\Controllers\Ventures;

use App\Core\Controller;
use Helpers\Session;

class Ventures extends Controller {
	/**
	 * Ventures constructor.
	 * Performs tasks that are common among all pages
	 */
	protected $_data = array();
	
	public function __construct() {
		parent::__construct();
		
		//Get session data about trip. This is a good place to get search settings as well so user doesn't need to keep filling in data
		$this->_data['trip'] = Session::get('trip');
		
		//Handle errors
		if(Session::exists('error')) {
			Session::destroy('error');
			$this->_data['error'] = true;
			$this->_data['errorMessage'] = Session::pull('error_message');
		}
	}
	
	protected function _getData() {
		return $this->_data;
	}
}