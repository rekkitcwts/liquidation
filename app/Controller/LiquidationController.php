<?php

class LiquidationController extends AppController 
{
	public function index()
	{
		$this->paginate = array(
            'conditions' => array('Liquidation.deleted' => 'false'),
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
            $this->loadModel('Disbursement');
            $disbursements = $this->Disbursement->find('all', array('conditions' => array('Disbursement.liquidation_id' => $id, 'Disbursement.deleted' => 'false')));
        	$this->set('liquidation', $liquidation);
            $this->set('disbursements', $disbursements);
        }
	}

    public function edit($id = null)
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
            $this->loadModel('Organisation');
            $orgs = $this->Organisation->find('all', array('order' => 'Organisation.name ASC'));
            $this->set('orgs', $orgs);
            $this->set('liquidation', $liquidation);
        }

        if ($this->request->is('post') || $this->request->is('put')) 
        {
            $this->Liquidation->id = $id;
            if ($this->Liquidation->save($this->request->data)) 
            {
                $this->Session->setFlash(__('Liquidation has been updated'));
                $this->redirect(array('action' => 'index'));
            }
            else
            {
                $this->Session->setFlash(__('Unable to update the liquidation.'));
            }
        }
    }

    public function delete($id = null)
    {
        if (!$id || !is_numeric($id)) 
        {
            $this->Session->setFlash('Liquidation not found.');
            $this->redirect($this->referer());
        }

        $this->Liquidation->id = $id;
        $liquidation = $this->Liquidation->findById($id);
        if (!$this->Liquidation->exists()) {
            $this->Session->setFlash('Invalid liquidation provided');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Liquidation->saveField('deleted', 'true')) {
            $this->Session->setFlash(__('Liquidation deleted'));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__('Liquidation was not deleted'));
        $this->redirect(array('action'=>'index'));
    }
}