<?php

class OrganisationController extends AppController 
{
	public function index()
	{
		$this->paginate = array(
            'limit' => 6,
            'order' => array('Organisation.name' => 'asc' )
        );
        $users = $this->paginate('Organisation');
        $this->set(compact('organisations'));
	}
}