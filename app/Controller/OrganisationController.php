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

        if ($this->request->is('post')) 
        {
                 
            $this->Organisation->create();
            if ($this->Organisation->save($this->request->data)) 
            {
                $this->Session->setFlash(__('The organisation has been created'));
                $this->redirect(array('action' => 'index'));
            } 
            else 
            {
                $this->Session->setFlash(__('Sorry, something bad happened when trying to add a new organisation.'));
            }  
        }
    }
}