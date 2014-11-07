<?php

class LiquidationController extends AppController 
{
	public function index()
	{
		$this->paginate = array(
            'limit' => 6,
            'order' => array('Liquidation.created' => 'desc' )
        );
        $liquidations = $this->paginate('Liquidation');
        $this->set(compact('liquidations'));
	}

	public function add()
	{
        $this->loadModel('Organisation');
        $orgs = $this->Organisation->find('all', array('order' => 'Organisation.name ASC'));
        $this->set('orgs', $orgs);

		if ($this->request->is('post'))
        {
            $this->Liquidation->create();
            if ($this->Liquidation->save($this->request->data)) {
                $this->Session->setFlash(__('Liquidation report filed. Please select it to add items for reimbursement.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Unable to file a liquidation report, please try again later.'));
            }  
        }
	}

	public function view($id = null)
	{
		if (!$id || !is_numeric($id)) 
		{
            $this->Session->setFlash('No valid data to display.');
            $this->redirect(array('action'=>'index'));
        }

        $liquidation = $this->Liquidation->findById($id);
        if (!$liquidation) 
        {
        	$this->Session->setFlash('The liquidation report you specified was not found.');
            $this->redirect(array('action'=>'index'));
        }
        else
        {
        	$this->set('liquidation', $liquidation);
        }
	}
}