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

class Airports extends Controller {

    private $_airports;
    private $_sortField = 'namee';
    private $_sortDir = 'ASC';
    private $_sortOrder = '';

    private $_availableSortFields = array('id', 'code', 'name', 'city', 'country');
    private $_availableSortDirs = array('ASC', 'DESC');

    public function __construct() {
        parent::__constuct();

        $this->_airports = new \App\Models\Ventures\Airports();
    }

    public function get($id = null, $sort = null, $dir = null) {
        
        if($sort && in_array($sort, $this->_availableSortFields)) {
            $this->_sortField = $sort;
        }
        
        if($dir && in_array($dir, $this->_availableSortDirs)) {
            $this->_sortDir = $dir;
        }
        
        $this->_sortOrder = $this->_sortField.' '.$this->_sortDir;
		
        $data['airports'] = $this->_airports->getAirports($id);
    }
}