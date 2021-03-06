<?php

class UsersController extends AppController 
{
   // var $components = array('Security');

	public function isAuthorized($user)
	{
    	return parent::isAuthorized($user);
	}

	public function adminChecker()
	{
		if ($this->Session->check('Auth.User') === false || $this->Auth->user('role')!='admin') 
    	{
    		$this->Session->setFlash('Access is denied.');
            $this->redirect(array('action'=>'login'));
    	}
	}

    public $paginate = array(
        'limit' => 25,
        'conditions' => array('deleted' => 'false'),
        'order' => array('User.username' => 'asc' )
    );
     
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','logout');
    }
     
 
 
    public function login() {
         
        //if already logged-in, redirect
        if($this->Session->check('Auth.User')){
            $this->redirect(array('action' => 'index'));     
        }

        $this->layout = 'login';
         
        // if we get the post information, try to authenticate
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->Session->setFlash(__('Welcome, '. $this->Auth->user('fname') . ' ' . $this->Auth->user('lname') . ' (Role: '. $this->Auth->user('role') .')'), 'success_notification');
               $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->setFlash(__('Invalid username or password'), 'error_notification');
            }
        }
    }
 
    public function logout() {
        $this->redirect($this->Auth->logout());
    }
 
    public function index() 
    {
    	$this->adminChecker();

        $this->paginate = array(
            'limit' => 6,
            'order' => array('User.username' => 'asc' )
        );
        $users = $this->paginate('User');
        $this->set(compact('users'));
    }
 
 
    public function add() 
    {
    	$this->adminChecker();
        $this->loadModel('Organisation');
        $testing = $this->Organisation->find('all');
        $this->set('testing', $testing);

        if ($this->request->is('post')) {
                 
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been created'), 'success_notification');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be created. Please fix the errors below.'), 'error_notification');
            }
        }
    }
 
    public function edit($id = null) 
    {
    	$this->adminChecker();
 
            if (!$id) {
                $this->Session->setFlash('Please provide a user id');
                $this->redirect(array('action'=>'index'));
            }
 
            $user = $this->User->findById($id);
            if (!$user) {
                $this->Session->setFlash('Invalid User ID Provided');
                $this->redirect(array('action'=>'index'));
            }
 
            if ($this->request->is('post') || $this->request->is('put')) {
                $this->User->id = $id;
                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash(__('The user has been updated'));
                    $this->redirect(array('action' => 'index'));
                }else{
                    $this->Session->setFlash(__('Unable to update your user.'));
                }
            }
 
            if (!$this->request->data) {
                $this->request->data = $user;
            }
    }
 
    public function delete($id = null) 
    {
    	$this->adminChecker();
         
        if (!$id) {
            $this->Session->setFlash('Please provide a user id', 'error_notification');
            $this->redirect(array('action'=>'index'));
        }
         
        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash('Invalid user id provided', 'error_notification');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->User->saveField('deleted', 'true')) {
            $this->Session->setFlash(__('User deleted'), 'success_notification');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted', 'error_notification'));
        $this->redirect(array('action' => 'index'));
    }
     
    public function activate($id = null) 
    {
    	$this->adminChecker();
         
        if (!$id) {
            $this->Session->setFlash('Please provide a user id', 'error_notification');
            $this->redirect(array('action'=>'index'));
        }
         
        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash('Invalid user id provided', 'error_notification');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->User->saveField('deleted', 'false')) {
            $this->Session->setFlash(__('User re-activated'), 'success_notification');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not re-activated', 'error_notification'));
        $this->redirect(array('action' => 'index'));
    }

    public function view($id = null)
    {
        $this->adminChecker();
         
        if (!$id || !is_numeric($id)) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'index'));
        }

        $user = $this->User->findById($id);
        if (!$user) 
        {
            $this->Session->setFlash('The user specified was not found.');
            $this->redirect(array('action'=>'index'));
        }
        else
        {
            $this->loadModel('UserOrganisation');
            $orgs = $this->UserOrganisation->find('all', array('conditions' => array('UserOrganisation.user_id' => $id)));
            $this->set('user', $user);
            $this->set('orgs', $orgs);
        }
    }
}