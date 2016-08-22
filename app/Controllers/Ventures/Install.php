<?php
/**
  *
  * File created by: Justin Conabree
  * Created at: 2016-08-19 8:58 PM
  *
  * This controller is an easy way to install any data necessary for the application to run. It will delegate to the models to run their installations
  *
  */

namespace App\Controllers\Ventures;

use App\Core\Controller;
use Helpers\Session;
use Helpers\Url;

class Install extends Controller {
	
	/**
	 * This endpoint serves to launch all installation necessary to run this app. Then redirects to home
	 */
    public function index() {
        $i = 0;

        $models = array('Airports', 'Flights');
        foreach($models as $class) {
            $i++;
            $fullClass = 'App\Models\Ventures\Install\\'.$class;
            $model = new $fullClass();
            if(!$model->install()) {
                break;
            }
        }
        if($i === count($models)) {
            // print out success
			//Would need to remove the message so users don't see this if they're the ones that trigger the install
			Session::set('error', true);
			Session::set('errorMessage', 'Installation Successful!');
			Url::redirect('/');
        }else {
            // print out failure + step
			Session::set('error', true);
			Session::set('errorMessage', 'Something went wrong with installation. Step: '.$i);
			Url::redirect('/');
        }
    }
}