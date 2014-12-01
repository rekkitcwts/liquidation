<?php

class OrganisationController extends AppController 
{
	public function adminChecker()
	{
		if ($this->Session->check('Auth.User') === false || $this->Auth->user('role')!='admin') 
    	{
    		$this->Session->setFlash('Access is denied.');
            $this->redirect(array('action'=>'login'));
    	}
	}

	public function index()
	{
		$this->paginate = array(
            'limit' => 6,
            'order' => array('Organisation.name' => 'asc' )
        );
        $organisations = $this->paginate('Organisation');
        $this->set(compact('organisations'));
	}

	public function add() 
    {
    	$this->adminChecker();

        $this->loadModel('User');
        $adviser = $this->User->find('all', array('order' => 'User.lname ASC', 'conditions' => array('User.role' => 'adviser')));
        $this->set('adviser', $adviser);

        if ($this->request->is('post')) 
        {
                 
            $this->Organisation->create();
            if ($this->Organisation->save($this->request->data)) 
            {
                $this->Session->setFlash(__('The organisation has been created'), 'success_notification');
                $this->redirect(array('action' => 'index'));
            } 
            else 
            {
                $this->Session->setFlash(__('Sorry, something bad happened when trying to add a new organisation.'), 'error_notification');
            }  
        }
    }
}