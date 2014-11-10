<?php

class DisbursementsController extends AppController 
{
	public function view($id = null)
	{
		$this->loadModel('Liquidation');

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
            
            $this->loadModel('Item');
            $disbursements = $this->Disbursement->find('all', array('conditions' => array('Disbursement.liquidation_id' => $id)));
            $items = $this->Item->find('all', array('order' => 'Item.item_name ASC'));
            $this->set('liquidation', $liquidation);
            $this->set('disbursements', $disbursements);
            $this->set('items', $items);

            
        }

        if ($this->request->is('post'))
        {
            $this->Disbursement->create();
            if ($this->Disbursement->save($this->request->data)) 
            {
                $this->Session->setFlash(__('Disbursement added.'));
                $this->redirect(array('action'=>'view', $liquidation['Liquidation']['id']));
            } 
            else 
            {
                $this->Session->setFlash(__('Unable to add disbursement.'));
            }  
        }
	}
}