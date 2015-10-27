<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * @link		  http://cakephp.org CakePHP(tm) Project
 * @package	   app.Controller
 * @since		 CakePHP(tm) v 0.2.9
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $components = array(
		//'Flash',
		'Auth' => array(
				'loginRedirect' => array(
						'controller' => 'homes',
						'action' => 'index'
				),
				'logoutRedirect' => array(
						'controller' => 'homes',
						'action' => 'index',
						'home'
				),
				'authenticate' => array(
					'Form' => array(
						'passwordHasher' => 'Blowfish'
					)
		)

		)
	);

	public function beforeFilter() {
		$this->Auth->allow('index');
		$this->set('auth',$this->Auth);
	}


	public function authCheck(){
		$user = $this->Auth->user();
		if(is_null($user))
			$this->redirect(array('controller' => 'Users', 'action'=>'login'));
	}
}
