<?php
/**
  *
  * File created by: Justin Conabree
  * Created at: 2016-08-20 7:09 AM
  *
  *
  */

namespace App\Controllers\Ventures;

use App\Core\Controller;
use Helpers\Session;
use Helpers\Url;
use Support\Facades\Response;

class Trip extends Controller {
	
	/**
	 * Get the session data for the trip
	 */
	public function get() {
		$tripModel = new \App\Models\Ventures\Trip();
		
		if(!$tripModel->get()) {
			Session::set('error', true);
			Session::set('error_message', 'No trip information available');
		}
		return Response::json($tripModel->get());
	}
	
	/**
	 * Insert/update the session data for the trip
	 */
	public function post() {
		
		$tripModel = new \App\Models\Ventures\Trip();
		if(!$tripModel->post()) {
			Session::set('error', true);
			Session::set('error_message', 'Could not update trip information');
		}
		Url::redirect('/');
	}
	
	/**
	 * @param null $id
	 * Deletes an index of the trip. If no id is set in the url and not supplied in the request, it will delete the whole trip
	 */
	public function delete($id = null) {
		$tripModel = new \App\Models\Ventures\Trip();
		if(!$tripModel->delete($id)) {
			Session::set('error', true);
			Session::set('error_message', 'Could not delete trip information');
		}
		Url::redirect('/');
	}
}