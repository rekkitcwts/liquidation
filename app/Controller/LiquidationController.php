<?php

class LiquidationController extends AppController 
{
	public function index()
	{
        if ($this->Session->check('Auth.User') && $this->Auth->user('role')=='admin') 
        {
            $conditions = array('Liquidation.deleted' => 'false');
        }
        else
        {
            $conditions = array(
                'Liquidation.deleted' => 'false',
                'Liquidation.buficom' => $this->Auth->user('id')
            );
        }

		$this->paginate = array(
            'conditions' => $conditions,
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
                $this->Session->setFlash(__('Liquidation report filed. Please select it to add items for reimbursement.'), 'success_notification');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Unable to file a liquidation report, please try again later.'), 'error_notification');
            }  
        }
	}

	public function view($id = null)
	{
		if (!$id || !is_numeric($id)) 
		{
            $this->Session->setFlash('No valid data to display.', 'error_notification');
            $this->redirect(array('action'=>'index'));
        }

        $liquidation = $this->Liquidation->findById($id);
        if (!$liquidation) 
        {
        	$this->Session->setFlash('The liquidation report you specified was not found.', 'error_notification');
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
            $this->Session->setFlash('No valid data to display.', 'error_notification');
            $this->redirect(array('action'=>'index'));
        }

        $liquidation = $this->Liquidation->findById($id);
        if (!$liquidation) 
        {
            $this->Session->setFlash('The liquidation report you specified was not found.', 'error_notification');
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
                $this->Session->setFlash(__('Liquidation has been updated'), 'success_notification');
                $this->redirect(array('action' => 'index'));
            }
            else
            {
                $this->Session->setFlash(__('Unable to update the liquidation.'), 'error_notification');
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

    public function generatePDF($id = null)
    {
        if (!$id)
        {
            $this->Session->setFlash('Sorry, there was no property ID submitted.');
            $this->redirect(array('action'=>'index'), null, true);
        }
        Configure::write('debug',0); // Otherwise we cannot use this method while developing

        $id = intval($id);

        $liquidation = $this->Liquidation->findById($id);
        if (!$liquidation) 
        {
            $this->Session->setFlash('The liquidation report you specified was not found.', 'error_notification');
            $this->redirect(array('action'=>'index'));
        }
        else
        {
            $this->loadModel('Disbursement');
            $disbursements = $this->Disbursement->find('all', array('conditions' => array('Disbursement.liquidation_id' => $id, 'Disbursement.deleted' => 'false')));
            $this->set('liquidation', $liquidation);
            $this->set('disbursements', $disbursements);
        }
        
        $this->layout = 'pdf'; //this will use the pdf.ctp layout
        $this->render(); 
    }
}