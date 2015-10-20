<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {

	public $uses = array('User', 'UserList');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('add', 'login', 'logout');
	}

	public function index() {
		$this->layout = "Normal";
		$this->display = "Users";

		$this->User->recursive = 0;
		$this->set('users', $this->paginate());

		$this->set("display",$this->display);
	}

	public function add() {
		$this->layout = "Normal";
		$this->display = "Users";
		$this->action = "add";

		$this->set("display",$this->display);
		$this->set("action",$this->action);

		if(!$this->request->is('post'))
			return;

		$this->log($this->request->data);

		$username = $this->request->data['User']['username'];

		if(empty($username))
			return;

		$userList = $this->UserList->find('first', array("conditions" => array("username" => $username)));

		if(empty($userList))
			return;

		$this->User->create();
		$this->User->save($this->request->data);
	}

	public function login() {
		$this->layout = "Normal";
		$this->display = "Users";
		$this->action = "login";

		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect($this->Auth->redirect());
			}
		}

		$this->set("display",$this->display);
		$this->set("action",$this->action);
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}

}
